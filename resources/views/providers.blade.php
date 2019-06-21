@extends('layout.master')

@section('page_styles')
<!--Table-->
<style type="text/css">
	.custab{
    border: 1px solid #ccc;
    padding: 5px;
    margin: 5% 0;
    box-shadow: 3px 3px 2px #ccc;
    transition: 0.5s;
    }
.custab:hover{
    box-shadow: 3px 3px 0px transparent;
    transition: 0.5s;
    }
</style>
@endsection

@section('page_scripts')

@endsection

@section('page_heading')
<div class="sub-title">
    <h2>RSS Providers</h2>
    <a href="contact.html"><i class="icon-envelope"></i></a>
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

<!-- !>
	Collapse menue
	>-->
@endsection