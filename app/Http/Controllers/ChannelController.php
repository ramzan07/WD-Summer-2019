<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use DB;

class ChannelController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

        return view('channel');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $channel_data['channel_source']  = $request->input('url');
        $channel_data['channel_name']     = $request->input('name');

        $channel = \App\RssChannel::where('channel_source', '=', $request->input('url'))->first();
        if(Input::get('save_only') && $channel === null) {
            \App\RssChannel::firstOrCreate($channel_data);
            return redirect()->route('home')->with('success_message', 'Channel has been created successfully.');
        } elseif(Input::get('save_import') && $channel === null){

            $statement = DB::select("SHOW TABLE STATUS LIKE 'rss_channels'");
            $nextChannelId = $statement[0]->Auto_increment;

            $xmlStr  = file_get_contents($request->input('url'));
            $xml     = simplexml_load_string($xmlStr, "SimpleXMLElement", LIBXML_NOCDATA);
            $json    = json_encode($xml);
            $array   = json_decode($json, TRUE);

            if(isset($array['channel']['item'])) {
                foreach ($array['channel']['item'] as $item) {
                    $this->createPost($item, $nextChannelId);
                }
                \App\RssChannel::firstOrCreate($channel_data);
                return redirect()->route('home')->with('success_message', 'Created successfully.');
            } else {
                return redirect()->back()->with('error_message', 'Broken Url');
            }
        } else {
            return redirect()->back()->with('error_message', 'Chennel already Exists');
        }

    }

    public function createPost($item, $id) {

        $rss['channel_id']  = $id;
        $rss['title']       = $item['title'];
        $rss['description'] = $item['description'];
        $rss['link']        = $item['link'];
        $rss['pubDate']     = date('Y-m-d H:i:s', strtotime($item['pubDate']));
        \App\RssPost::create($rss);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

}
