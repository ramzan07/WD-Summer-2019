<?php

namespace App\Http\Controllers;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class FeedController extends Controller {

    /**
     * refresh method 
     * this method is responsible for refreshing
     * rss feed
     */
    public function refresh() {

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
        if (!empty($data)) {
            foreach ($data['channel']['item'] as $key => $item) {
                $rss['channel_id'] = $channel->id;
                $rss['title'] = $item['title'];
                $rss['description'] = $item['description'];
                $rss['link'] = $item['link'];
                $rss['pubDate'] = date('Y-m-d H:i:s', strtotime($item['pubDate']));
                $post = \App\RssPost::where('link', $item['link'])->first();
                if (empty($post)) {
                    $post = \App\RssPost::create($rss);
                }
            }
        }

        return redirect()->route('home');
    }

    /**
     * index method
     * this method is responsible for showing feeds
     * return type view
     */
    public function index() {
        $json = file_get_contents('http://localhost/wb-summar/api/feeds/get');
        $data = json_decode($json, TRUE);
        return view('welcome', compact('data'));
    }

}
