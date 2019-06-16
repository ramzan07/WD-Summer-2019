<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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


        $create_channel = \App\RssChannel::firstOrCreate($channel_data);
        if ($create_channel) {
            return redirect()->route('home')->with('success_message', 'Channel has been created successfully.');
        }
        //$xmlStr = file_get_contents($reques_params);
        //$xml = simplexml_load_string($xmlStr, "SimpleXMLElement", LIBXML_NOCDATA);
        //$json = json_encode($xml);
        //$array = json_decode($json, TRUE);
        //$channel = \App\RssChannel::where('channel_source', $array['channel']['link'])->first();
        //if (empty($channel)) {
          //  return $this->createNewChannel($array['channel']);
        //$create_channel = \App\RssChannel::firstOrCreate($channel_array);
        //}
        //return redirect()->back()->with('error_message', 'Channel has already been created');
    }

    /**
     * createNewChannel method
     * @param type $channel
     * @return type
     */
    public function createNewChannel($channel) {
       
        $channel_array = [];
        $channel_array['channel_name'] = $channel['title'];
        $channel_array['channel_source'] = $channel['link'];
        $channel_array['channel_description'] = $channel['title'];
        $channel_array['channel_image'] =!empty( $channel['image'][0]['url']) ?  $channel['image'][0]['url'] : NULL;
        $create_channel = \App\RssChannel::firstOrCreate($channel_array);
        if ($create_channel) {
            return redirect()->route('home')->with('Channel has been created successfully.');
        }
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
