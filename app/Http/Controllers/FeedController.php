<?php

namespace App\Http\Controllers;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use DateTime;
use Illuminate\Support\Facades\Input;

class FeedController extends Controller {

    /**
     * refresh method 
     * this method is responsible for refreshing
     * rss feed
     */
    public function refresh() {

        $settings = \DB::table('settings')->where('type', 'update')->first();
        $flag = $this->calculateTimeDiffToUpdate($settings->time);

        if (!$flag) {
            return redirect()->back()->with('warning_message', 'Update request time is not proper');
        }
        $channels = \App\RssChannel::all();

        foreach ($channels as $channel) {
            $xmlStr = file_get_contents($channel->channel_source);
            $xml = simplexml_load_string($xmlStr, "SimpleXMLElement", LIBXML_NOCDATA);           
            $json = json_encode($xml);
            $array = json_decode($json, TRUE);

            $this->processRssFeed($array, $channel);
        }

        return redirect()->route('home')->with('success_message', 'Feed has been update successfully');
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
            $post = \App\RssPost::where('link', $item['link'])->first();
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
        $settings = \DB::table('settings')->where('type', 'update')->update(['time' => date('Y-m-d H:i:s')]);
    }

    /**
     * createPost method
     * responsible for creating post
     * @param type $item
     * @param type $channel
     */
    public function createPost($item, $channel) {

        $rss['channel_id'] = $channel->id;
        $rss['title'] = $item['title'];
        $rss['description'] = $item['description'];
        $rss['link'] = $item['link'];
        $rss['pubDate'] = date('Y-m-d H:i:s', strtotime($item['pubDate']));
        \App\RssPost::create($rss);
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
            $post = file_get_contents('http://localhost/wb-summar/api/feeds/get?id=' . $request_params['channel_id']);
        } else {
            $post = file_get_contents('http://localhost/wb-summar/api/feeds/get');
        }
        $channel = file_get_contents('http://localhost/wb-summar/api/feeds/channels');
        $data['posts'] = json_decode($post, TRUE);
        $data['channels'] = json_decode($channel, TRUE);
        $feed_posts = $data['posts']['data'];
        $feed_channel = $data['channels']['data'];

        return view('welcome', compact('feed_posts', 'feed_channel'));
    }

    public function show($id) {
        $post = \App\RssPost::where('id', $id)->first();

        $str = '';

        $str .="<div class=\"post-title\">
                    Title : {$post->title}
                </div>";

        $str .="<br/>";

        $str .="<div class=\"post-title\">
                    Description : {$post->description}
                </div>";

        $str .="<br/>";

        $str .="<p class=\"post-meta\">Link : 
                            <a style=\"font-size: 12px;\" href=\"{$post->link}\">{$post->link}</a>
                        </p>";
        $posted_date = date('Y-m-d H:i:s a', strtotime($post->pubDate));
        $str .="<p class=\"post-meta\">Posted on {$posted_date}
                        </p>";

        return $str;
    }

}
