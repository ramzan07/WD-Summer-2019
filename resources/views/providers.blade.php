@extends('layout.master')

@section('page_styles')
<link href="{{asset('public/css/posts.css')}}" rel="stylesheet" type="text/css">
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.4.0/css/bootstrap4-toggle.min.css" rel="stylesheet">

<style type="text/css">
  .btn-group-xs>.btn, .btn-xs {
    padding: .70rem .6rem .32rem !important;
    font-size: .875rem;
    line-height: .5;
    border-radius: .2rem;
</style>
@endsection

@section('page_scripts')
<script src="{{asset('public/js/counter.js')}}"></script>

<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.4.0/js/bootstrap4-toggle.min.js"></script>

<script type="text/javascript">
    $("#providerStatus").on("change", function(event) {
     if($(this).is(":checked")) {
        alert("on");
     } else {
        alert("off");
     }
    });
</script>

@endsection

@section('page_heading')
<div class="sub-title">
    <h2>RSS Providers</h2>
    <a href="{{route('getProviders')}}"><i class="icon-support"></i></a>
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
                <td class="text-center" style="width: 150px;"><a class='btn btn-info btn-xs' href="#"><span class="icon-eye"></span> View</a>
                <input type="checkbox" id="providerStatus" checked data-toggle="toggle" data-size="xs">
                </td>
         	</tr>
            @endforeach
    </table>

@endsection