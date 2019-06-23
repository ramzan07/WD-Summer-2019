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
        $channel = file_get_contents('http://localhost/wb-summar/api/feeds/channels');
        $data['channels'] = json_decode($channel, TRUE);

        $feed_channel = $data['channels']['data'];
        return view('providers', compact('feed_channel'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function viewProvider(Request $request) {
        $id     = request('provider_id');
        $channel = file_get_contents('http://localhost/wb-summar/api/feeds/channels?provider_id=' . $id);
        $data = json_decode($channel, TRUE);
        $feed_posts = $data['data'][0];
        $str = '';

        $str .="<div class=\"col-sm-12 custom-pad-2\">
                    <div class=\"table-responsive\">
                        <table class=\"table table-bordered\">
                         <tbody>
                        <tr>
                          <td><b>Adress Url</b></td>
                          <td><a target= \"_blank\" href=\"{$feed_posts['channel_source']}\">{$feed_posts['channel_source']}</td>
                       </tr>

                        <tr>
                          <td><b>Date of Last Update</b></td>";
                          $last_update_date  = ucfirst(date('Y-m-d H:i:s A', strtotime(isset($feed_posts['last_update_date']) ? $feed_posts['last_update_date'] : 'Not Found')));
        $str .="<td>{$last_update_date}</td>
                       </tr>

                        <tr>
                          <td><b>Date of Latest Record</b></td>
                          <td>$5000</td>
                       </tr>

                        <tr>
                          <td><b>Date of last attempt</b></td>";

                          $last_update_attempt  = ucfirst(date('Y-m-d H:i:s A', strtotime($feed_posts['last_attempt_date'])));
        $str .="<td>{$last_update_attempt}</td>
                       </tr>

                      </tbody>
                      </table>
                    </div>
                </div>";

        return $str;

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
    public function updateProvider(Request $request) {
        $id     = $request->input('id');
        $status = $request->input('status');

        $provider=\App\RssChannel::where('id',$id)->first();
        $provider->status = $status;
        $provider->save();
        return 'success';
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
