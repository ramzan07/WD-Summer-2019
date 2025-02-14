<?php

namespace App\Http\Controllers;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use DateTime;
use Illuminate\Support\Facades\Input;

class RssController extends Controller {

    /**
     * refresh method 
     * this method is responsible for refreshing
     * rss feed
     */
    public function refresh() {

        $provider_id = request('provider_id');

        /*lates request time*/
        \DB::table('providers')->where('id', $provider_id)->update(['last_attempt_date' => date('Y-m-d H:i:s')]);

        $settings = \DB::table('settings')->where('type', 'update')->where('provider_id', $provider_id)->first();
        $flag = $this->calculateTimeDiffToUpdate($settings->time);


        if (!$flag) {
            return "time_issue";
        }

        $channel = \DB::table('providers')->where('id', $provider_id)->first();
        if($channel->feed_type == 'atom'){
            $xmlStr = file_get_contents($channel->feed_source);
            $xml = simplexml_load_string($xmlStr, "SimpleXMLElement", LIBXML_NOCDATA);
            $json = json_encode($xml);
            $array = json_decode($json, TRUE);
            $this->processAtomFeed($array, $channel);

        } else{

            $xmlStr = file_get_contents($channel->feed_source);
            $xml = simplexml_load_string($xmlStr, "SimpleXMLElement", LIBXML_NOCDATA);
            $json = json_encode($xml);
            $array = json_decode($json, TRUE);

            $this->processRssFeed($array, $channel);
        }

        return "success";

    }

    /**
     * calculateTimeDiff method 
     * responsible for telling system to updated feed or not
     * @param type $time
     * @return boolean
     */
    public function calculateTimeDiffToUpdate($time) {
        $start_date = new DateTime($time);
        $since_start = $start_date->diff(new DateTime(date('Y-m-d H:i:s')));
        $minutes = $since_start->days * 24 * 60;
        $minutes += $since_start->h * 60;
        $minutes += $since_start->i;

        if ($minutes < 10) {
            return false;
        }
        return true;
    }

    /**
     * processRssFeed method
     * check record uniqueness 
     * save new record
     * @param type $data
     * @param type $channel
     * @return type
     */
    public function processRssFeed($data, $channel) {

        foreach ($data['channel']['item'] as $item) {
            $post = \App\Models\Feeds::where('link', $item['link'])->first();
            if (!empty($post)) {
                $settings = \DB::table('settings')->where('type', 'delete')->first();
                $time = $this->calculateTimeDiffToDelete($post->created_at);
                if ($time > $settings->time) {
                    $post->delete();
                }
            }
            if (empty($post)) {
                $this->createPost($item, $channel);
            }
        }

        $updateSetting = \DB::table('settings')->where('type', 'update')->where('provider_id' , $channel->id)->first();
        if(empty($updateSetting)){
            $setting['provider_id'] = $channel->id;
            $setting['type'] = 'update';
            $setting['time'] = date('Y-m-d H:i:s');
            \App\Models\Configration::create($setting);
        } else{
            $settings = \DB::table('settings')->where('type', 'update')->where('provider_id', $channel->id)->update(['time' => date('Y-m-d H:i:s')]);
        }
    }

    /**
     * processRssFeed method
     * check record uniqueness 
     * save new record
     * @param type $data
     * @param type $channel
     * @return type
     */
    public function processAtomFeed($data, $channel) {

        foreach ($data['entry'] as $item) {
            $post = \App\Models\Feeds::where('link', $item['id'])->first();
            if (!empty($post)) {
                $settings = \DB::table('settings')->where('type', 'delete')->first();
                $time = $this->calculateTimeDiffToDelete($post->created_at);
                if ($time > $settings->time) {
                    $post->delete();
                }
            }
            if (empty($post)) {
                $this->createAtomPost($item, $channel);
            }
        }

        $updateSetting = \DB::table('settings')->where('type', 'update')->where('provider_id' , $channel->id)->first();
        if(empty($updateSetting)){
            $setting['provider_id'] = $channel->id;
            $setting['type'] = 'update';
            $setting['time'] = date('Y-m-d H:i:s');
            \App\Models\Configration::create($setting);
        } else{
            $settings = \DB::table('settings')->where('type', 'update')->where('provider_id', $channel->id)->update(['time' => date('Y-m-d H:i:s')]);
        }
    }

    /**
     * createPost method
     * responsible for creating post
     * @param type $item
     * @param type $channel
     */
    public function createAtomPost($item, $channel) {

        $atom['provider_id'] = $channel->id;
        $atom['title'] = $item['title'];
        $atom['description'] = '';
        $atom['link'] = $item['id'];
        $atom['pubDate'] = date('Y-m-d H:i:s', strtotime($item['published']));
        \App\Models\Feeds::create($atom);

        \DB::table('providers')->where('id', $channel->id)->update(['last_update_date' => date('Y-m-d H:i:s')]);
    }

    /**
     * createPost method
     * responsible for creating post
     * @param type $item
     * @param type $channel
     */
    public function createPost($item, $channel) {

        $rss['provider_id'] = $channel->id;
        $rss['title'] = $item['title'];
        $rss['description'] = $item['description'];
        $rss['link'] = $item['link'];
        $rss['pubDate'] = date('Y-m-d H:i:s', strtotime($item['pubDate']));
        \App\Models\Feeds::create($rss);

        \DB::table('providers')->where('id', $channel->id)->update(['last_update_date' => date('Y-m-d H:i:s')]);
    }

    /**
     * calculateTimeDiffToDelete method
     * responsible for time calculation to delete
     * @param type $time
     * @return type
     */
    public function calculateTimeDiffToDelete($time) {
        $start_date = new DateTime($time);
        $since_start = $start_date->diff(new DateTime(date('Y-m-d H:i:s')));
        $minutes = $since_start->days * 24 * 60;
        $minutes += $since_start->h * 60;
        $minutes += $since_start->i;
        return $minutes;
    }

    /**
     * index method
     * this method is responsible for showing feeds
     * return type view
     */
    public function index() {

        $request_params = Input::all();

        if (!empty($request_params) && isset($request_params['channel_id'])) {
            $post = file_get_contents('http://localhost/wdb-newsfeed/api/rssfeeds?provider_id=' . $request_params['channel_id']);
        } else {
            $post = file_get_contents('http://localhost/wdb-newsfeed/api/rssfeeds');
        }


        $channel = file_get_contents('http://localhost/wdb-newsfeed/api/rssproviders');
        $data['posts'] = json_decode($post, TRUE);
        $data['channels'] = json_decode($channel, TRUE);
        $feed_posts = $data['posts']['data'];
        $feed_channel = $data['channels']['data'];

        $postsCount = count($feed_posts);
        $providersCount = count($feed_channel);

        return view('index', compact('feed_posts', 'feed_channel', 'postsCount', 'providersCount'));
    }

    public function show($id) {

        $post = file_get_contents('http://localhost/wdb-newsfeed/api/rssfeeds?post_id=' . $id);

        $data = json_decode($post , TRUE);

        $feed_posts = $data['data'][0];

        $str = '';

        $str .="<div class=\"post-title\">
                    Title : {$feed_posts['title']}
                </div>";

        $str .="<br/>";

        $str .="<div class=\"post-title\">
                    Description : {$feed_posts['description']}
                </div>";

        $str .="<br/>";

        $str .="<p class=\"post-meta\">Link : 
                            <a style=\"font-size: 12px;\" href=\"{$feed_posts['link']}\">{$feed_posts['link']}</a>
                        </p>";
        $posted_date = date('Y-m-d H:i:s a', strtotime($feed_posts['pubDate']));
        $str .="<p class=\"post-meta\">Posted on {$posted_date}
                        </p>";
        $str .="<p class=\"post-meta\">Created at 2019-06-23 21:59:29 pm
                        </p>";

        return $str;
    }

    public function refreshAll() {

        $settings = \DB::table('settings')->where('type', 'update')->first();
        $flag = $this->calculateTimeDiffToUpdate($settings->time);

        if (!$flag) {
            return "time_issue";
        }
        $channels = \App\Models\Provider::where('feed_type' , 'rss')->get();

        foreach ($channels as $channel) {
            $xmlStr = file_get_contents($channel->feed_source);
            $xml = simplexml_load_string($xmlStr, "SimpleXMLElement", LIBXML_NOCDATA);
            $json = json_encode($xml);
            $array = json_decode($json, TRUE);

            $this->processAllRssFeed($array, $channel);
        }
        session()->flash('success_message', trans('Feeds SuccessFully Updated'));
        return 'success';
    }

    /**
     * processRssFeed method
     * check record uniqueness
     * save new record
     * @param type $data
     * @param type $channel
     * @return type
     */
    public function processAllRssFeed($data, $channel) {

        foreach ($data['channel']['item'] as $item) {
            $post = \App\Models\Feeds::where('link', $item['link'])->first();
            if (!empty($post)) {
                $settings = \DB::table('settings')->where('type', 'delete')->first();
                $time = $this->calculateTimeDiffToDelete($post->created_at);
                if ($time > $settings->time) {
                    $post->delete();
                }
            }
            if (empty($post)) {
                $this->createPost($item, $channel);
            }
        }
        \DB::table('settings')->where('type', 'update')->where('id', 1)->update(['time' => date('Y-m-d H:i:s')]);
        \DB::table('settings')->where('type', 'update')->where('provider_id', $channel->id)->update(['time' => date('Y-m-d H:i:s')]);
    }

}
