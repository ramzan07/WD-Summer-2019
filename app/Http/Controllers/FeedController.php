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
                
        $xmlStr = file_get_contents('https://foreignpolicy.com/feed');
        $xml = simplexml_load_string($xmlStr, "SimpleXMLElement", LIBXML_NOCDATA);
        $json = json_encode($xml);
        $array = json_decode($json, TRUE);
        $channel = \App\RssChannel::where('channel_source', $array['channel']['link'])->first();
        if (empty($channel)) {
            $channel = $this->saveNewChannel($array['channel']);
        }
        return $this->processRssFeed($array, $channel);
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
     * saveNewChannel method
     * responsible for saving new channel
     * @param type $channel
     * @return type
     */
    public function saveNewChannel($channel) {

        $channel_array = [];
        $channel_array['channel_name'] = $channel['title'];
        $channel_array['channel_source'] = $channel['link'];
        $channel_array['channel_description'] = $channel['title'];
        $channel_array['channel_image'] = $channel['image'][0]['url'];
        return \App\RssChannel::firstOrCreate($channel_array);
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

        return redirect()->route('home')->with('success_message', 'Feed has been update successfully');
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
        $rss['image'] = $item['enclosure']['@attributes']['url'];
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
        return View('post', compact('post'));
    }

}
