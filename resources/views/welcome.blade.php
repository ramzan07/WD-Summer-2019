@extends('layout.master')
@section('title')

 <title>RSS Posts</title>

@endsection

@section('page_styles')
<link href="{{asset('public/css/posts.css')}}" rel="stylesheet" type="text/css">
@endsection

@section('page_scripts')
<script src="{{asset('public/js/counter.js')}}"></script>

<script type="text/javascript">
    function loadPost(id)
    {
        $("#preloader").modal('show');
        $.ajax({
            url: 'feed/post/'+ id,
            type: "GET",
            success: function(result) {
                $('#tbody-data').html(result);
                $("#modal-db-details").modal('show');
                $("#preloader").modal('hide');
            }
        });
    }
</script>

<script type="text/javascript">
    $("#searchChannel").click(function(){
        if($('#channel').val() == ""){
            alert("Please Select a Channel");
            return false;
        }
    });
</script>

<script type="text/javascript">
    setTimeout(function() {
    $('#message').fadeOut('slow');
}, 3000); // <-- time in milliseconds
</script>>

@endsection

@section('sidebarCards')
<div class="my-detail col"  style="margin-bottom: 0px;">
    <div class="white-spacing">
      <i class="icon-envelope fa-2x"></i>
      <h1 class="timer count-title count-number" data-to="{{$providersCount}}" data-speed="1500"></h2>
      <h1>Providers</h1>
    </div>
      </div>
<div class="my-detail col"  style="margin-bottom: 0px;">
    <div class="white-spacing">
      <i class="icon-support fa-2x"></i>
      <h1 class="timer count-title count-number" data-to="{{$postsCount}}" data-speed="1500"></h2>
      <h1>Posts</h1>
    </div>
</div>
@endsection

@section('page_heading')
<div class="sub-title">
    <h2>RSS Feeds</h2>
    <a href="{{route('home')}}"><i class="icon-envelope"></i></a>
</div>
@endsection

@section('action_buttons')
@if(Session::has('success_message'))
    <div class="alert alert-success" id="message">
        <center><strong>Success!</strong> {{Session::get('success_message')}} </center>
    </div>
    @endif
    @if(Session::has('warning_message'))
    <div class="alert alert-warning" id="message">
        <strong>Warning!</strong> {{Session::get('warning_message')}}
    </div>   
    @endif
    @if(Session::has('error_message'))
    <div class="alert alert-danger" id="message">
        <strong>Danger!</strong> {{Session::get('error_message')}}
    </div>
@endif
<form action="{{route('home')}}" method="GET">

        <div class="col-sm-6">
            <select name="channel_id" id="channel" class="form-control" id="exampleFormControlSelect1">
                <option value="">Select a channel</option>
                @foreach($feed_channel as $channel)
                @php
                    $provider = isset($_GET['channel_id']) ? $_GET['channel_id'] : '';
                    $val = isset($channel['id']) && $channel['id'] == $provider ? 'selected' : '';
                @endphp
                <option value="{{$channel['id']}}" {{$val}}>{{$channel['channel_name']}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-3">
            <input class="btn btn-primary form-group form-control" id="searchChannel"  type="submit" value="Search">
        </div>
</form>
<form action="{{route('refreshFeed')}}" method="GET">
<div class="col-sm-3">
    <input class="btn btn-primary form-group form-control"  type="submit" value="Refresh Feed &nbsp; &#8634;">
</div>
</form>
@endsection

@section('content')

    <!-- Blog Post Start -->
    @foreach($feed_posts as $item)
        <div class="col-md-12 blog-post">
            <div class="post-title">
              <a href="single.html"><h1>{{$item['title']}}</h1></a>
            </div>
            <div class="post-info">
                <span>Posted On {{ucfirst(date('Y-m-d H:i:s A', strtotime($item['pubDate'])))}}&nbsp;&nbsp;<a href="#" target="_blank">Alex Parker</a></span>
            </div>  
            <p>{{strip_tags($item['description'])}}</p>
            <p class="post-meta">Link : 
                    <a style=" font-size: 12px;" href="{{$item['link']}}" target="_blank">{{substr($item['link'], 0, 100)}}</a>
            </p>
            <div class="row">
                <div class="col-sm-8">
                    <a href="javascript:;" onclick="loadPost({{$item['id']}})" class="button button-style button-anim fa fa-long-arrow-right"><span>View Post</span></a>
                </div>
                <div class="col-sm-4">
                    <span class="badge badge-success" style="margin-top: 20px;">Created at {{ucfirst(date('Y-m-d H:i:s A', strtotime($item['created_at'])))}}</span>
                </div>
            </div>
            <!-- <span class="badge badge-success" style="">Posted 2012-08-02 20:47:04</span> -->
        </div>
    <!-- Blog Post End -->
    @endforeach

    @section('loadPosts')
    <div class="col-md-12 text-center">
        <a href="javascript:void(0)" id="load-more-post" class="load-more-button">Load</a>
        <div id="post-end-message"></div>
    </div>
    @endsection
<div class="modal fade" id="modal-db-details" tabindex="-1" role="dialog" aria-hidden="true" style="overflow-y">
    <div class="vertical-alignment-helper">
        <div class="modal-dialog vertical-align-center" style="width: 700px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span>

                    </button>
                     <h4 class="modal-title" id="myModalLabel">Post Details</h4>

                </div>
                <div class="modal-body"><div id ="tbody-data"></div></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection