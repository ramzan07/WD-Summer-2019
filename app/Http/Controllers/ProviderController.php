<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use DB;

class ProviderController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $channel = file_get_contents('http://localhost/wdb-newsfeed/api/feeds/channels');
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
        $channel = file_get_contents('http://localhost/wdb-newsfeed/api/feeds/channels?provider_id=' . $id);
        $data = json_decode($channel, TRUE);
        $feed_posts = $data['data'][0];
        $str = '';

        $str .="<div class=\"col-sm-12 custom-pad-2\">
                    <div class=\"table-responsive\">
                        <table class=\"table table-bordered\">
                         <tbody>
                        <tr>
                          <td><b>Adress Url</b></td>
                          <td><a target= \"_blank\" href=\"{$feed_posts['feed_source']}\">{$feed_posts['feed_source']}</td>
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

    public function createPost($item, $id) {

        $rss['provider_id'] = $id;
        $rss['title']       = $item['title'];
        $rss['description'] = $item['description'];
        $rss['link']        = $item['link'];
        $rss['pubDate']     = date('Y-m-d H:i:s', strtotime($item['pubDate']));
        \App\Models\Feeds::create($rss);
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

        $provider= \App\Models\Provider::where('id',$id)->first();
        $provider->status = $status;
        $provider->save();
        return 'success';
    }

}
