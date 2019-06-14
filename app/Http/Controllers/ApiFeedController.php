<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

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
            $feeds = \App\RssPost::where('channel_id', $request_params['id'])->get();
        } else {
            $feeds = \App\RssPost::all();
        }

        return $this->jsonSuccessResponse('Process is processed success', $feeds);
    }

    /**
     * channels method 
     * responsible for getting channels
     * @return \Illuminate\Http\Response
     */
    public function channels() {
        $channels = \App\RssChannel::all();
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
