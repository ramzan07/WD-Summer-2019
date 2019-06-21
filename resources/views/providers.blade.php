@extends('layout.master')

@section('page_styles')
<link href="{{asset('public/css/posts.css')}}" rel="stylesheet" type="text/css">
@endsection

@section('page_scripts')
<script src="{{asset('public/js/counter.js')}}"></script>
@endsection

@section('page_heading')
<div class="sub-title">
    <h2>RSS Providers</h2>
    <a href="contact.html"><i class="icon-envelope"></i></a>
</div>
@endsection

@section('sidebarCards')
<div class="my-detail col"  style="margin-bottom: 0px;">
    <div class="white-spacing">
      <i class="fa fa-code fa-2x"></i>
      <h1 class="timer count-title count-number" data-to="100" data-speed="1500"></h2>
      <h1>News Count</h1>
    </div>
      </div>
<div class="my-detail col"  style="margin-bottom: 0px;">
    <div class="white-spacing">
      <i class="fa fa-code fa-2x"></i>
      <h1 class="timer count-title count-number" data-to="200" data-speed="1500"></h2>
      <h1>News Count</h1>
    </div>
</div>
@endsection

@section('content')
    <table class="table table-striped custab">
    <thead>
    <!-- <a href="#" class="btn btn-primary btn-xs pull-right"><b>+</b> Add new categories</a> -->
        <tr>
            <th>Sr.</th>
            <th>Name</th>
            <th>Source</th>
            <th class="text-center">Action</th>
        </tr>
    </thead>
            @foreach($feed_channel as $key=>$channel)
            <tr>
                <td style="width: 2px;">{{++$key}}</td>
                <td>{{$channel['channel_name']}}</td>
                <td><a>{{$channel['channel_source']}}</a></td>
                <td class="text-center"><a class='btn btn-info btn-xs btn btn-primary btn-sm hidden-xs' href="#" data-toggle="collapse" data-target="#feature-1"><span class="icon-eye"></span> Edit</a></td>
         	</tr>
            @endforeach
    </table>

@endsection