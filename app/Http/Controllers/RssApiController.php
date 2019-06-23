<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
Use DB;

class RssApiController  extends Controller {

    use \App\Http\Traits\CommonService;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $request_params = Input::all();

        $rss  = DB::table('rss_posts')->join('rss_channels', 'rss_channels.id', '=' , 'rss_posts.channel_id')
            ->select('rss_posts.*', 'rss_channels.status', 'rss_channels.channel_name');

        if (isset($request_params['provider_id'])) {

            $rss->where('channel_id', $request_params['provider_id']);
        } elseif(isset($request_params['post_id'])){

            $rss->where('rss_posts.id', $request_params['post_id']);
        }else {
            $rss;
        }

        $feeds = $rss->get();

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

}
