<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
Use DB;

class ApiFeedController extends Controller {

    use \App\Http\Traits\CommonService;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $request_params = Input::all();

        if (isset($request_params['id'])) {

            $feeds = DB::table('rss_posts')->join('rss_channels', 'rss_channels.id', '=' , 'rss_posts.channel_id')
            ->select('rss_posts.*', 'rss_channels.status', 'rss_channels.channel_name')
            ->where('channel_id', $request_params['id'])
            ->get();
        } elseif(isset($request_params['post_id'])){

            $feeds = DB::table('rss_posts')->join('rss_channels', 'rss_channels.id', '=' , 'rss_posts.channel_id')
            ->select('rss_posts.*', 'rss_channels.status', 'rss_channels.channel_name')
            ->where('rss_posts.id', $request_params['post_id'])
            ->get();

        }else {
            $feeds = DB::table('rss_posts')->join('rss_channels', 'rss_channels.id', '=' , 'rss_posts.channel_id')
            ->select('rss_posts.*', 'rss_channels.status', 'rss_channels.channel_name')
            ->get();

        }

        return $this->jsonSuccessResponse('Process is processed success', $feeds);
    }

    /**
     * channels method 
     * responsible for getting channels
     * @return \Illuminate\Http\Response
     */
    public function channels() {

        $request_params = Input::all();
        if (isset($request_params['provider_id'])) {
            $channels = \App\RssChannel::where('id', $request_params['provider_id'])->get();
        } else {
            $channels = \App\RssChannel::all();
        }
        return $this->jsonSuccessResponse('Process is processed success', $channels);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
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
