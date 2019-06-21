@extends('layout.master')
@section('title')

 <title>RSS Posts</title>

@endsection
@section('page_styles')
<style type="text/css">
.modal {
}
.vertical-alignment-helper {
    display:table;
    height: 100%;
    width: 100%;
}
.vertical-align-center {
    /* To center vertically */
    display: table-cell;
    vertical-align: middle;
}
.modal-content {
    /* Bootstrap sets the size of the modal in the modal-dialog class, we need to inherit it */
    width:inherit;
    height:inherit;
    /* To center horizontally */
    margin: 0 auto;
}
</style>

<!---------------------------->
<style type="text/css">
    .counter {
    background-color:#f5f5f5;
    padding: 20px 0;
    border-radius: 5px;
}

.count-title {
    font-size: 40px;
    font-weight: normal;
    margin-top: 10px;
    margin-bottom: 0;
    text-align: center;
}

.count-text {
    font-size: 13px;
    font-weight: normal;
    margin-top: 10px;
    margin-bottom: 0;
    text-align: center;
}

.fa-2x {
    margin: 0 auto;
    float: none;
    display: table;
    color: #4ad1e5;
}
</style>

<!-- Modal -->
<style type="text/css">
    .modal-body {
    max-height: calc(100vh - 210px);
    overflow-y: auto;
}
</style>
@endsection

@section('page_scripts')
<script type="text/javascript">
    (function ($) {
    $.fn.countTo = function (options) {
        options = options || {};
        
        return $(this).each(function () {
            // set options for current element
            var settings = $.extend({}, $.fn.countTo.defaults, {
                from:            $(this).data('from'),
                to:              $(this).data('to'),
                speed:           $(this).data('speed'),
                refreshInterval: $(this).data('refresh-interval'),
                decimals:        $(this).data('decimals')
            }, options);
            
            // how many times to update the value, and how much to increment the value on each update
            var loops = Math.ceil(settings.speed / settings.refreshInterval),
                increment = (settings.to - settings.from) / loops;
            
            // references & variables that will change with each update
            var self = this,
                $self = $(this),
                loopCount = 0,
                value = settings.from,
                data = $self.data('countTo') || {};
            
            $self.data('countTo', data);
            
            // if an existing interval can be found, clear it first
            if (data.interval) {
                clearInterval(data.interval);
            }
            data.interval = setInterval(updateTimer, settings.refreshInterval);
            
            // initialize the element with the starting value
            render(value);
            
            function updateTimer() {
                value += increment;
                loopCount++;
                
                render(value);
                
                if (typeof(settings.onUpdate) == 'function') {
                    settings.onUpdate.call(self, value);
                }
                
                if (loopCount >= loops) {
                    // remove the interval
                    $self.removeData('countTo');
                    clearInterval(data.interval);
                    value = settings.to;
                    
                    if (typeof(settings.onComplete) == 'function') {
                        settings.onComplete.call(self, value);
                    }
                }
            }
            
            function render(value) {
                var formattedValue = settings.formatter.call(self, value, settings);
                $self.html(formattedValue);
            }
        });
    };
    
    $.fn.countTo.defaults = {
        from: 0,               // the number the element should start at
        to: 0,                 // the number the element should end at
        speed: 1000,           // how long it should take to count between the target numbers
        refreshInterval: 100,  // how often the element should be updated
        decimals: 0,           // the number of decimal places to show
        formatter: formatter,  // handler for formatting the value before rendering
        onUpdate: null,        // callback method for every time the element is updated
        onComplete: null       // callback method for when the element finishes updating
    };
    
    function formatter(value, settings) {
        return value.toFixed(settings.decimals);
    }
}(jQuery));

jQuery(function ($) {
  // custom formatting example
  $('.count-number').data('countToOptions', {
    formatter: function (value, options) {
      return value.toFixed(options.decimals).replace(/\B(?=(?:\d{3})+(?!\d))/g, ',');
    }
  });
  
  // start all the timers
  $('.timer').each(count);  
  
  function count(options) {
    var $this = $(this);
    options = $.extend({}, options || {}, $this.data('countToOptions') || {});
    $this.countTo(options);
  }
});
</script>

<script type="text/javascript">
    function loadDatbaseDetails(id)
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
</script>>

@endsection

@section('page_heading')
<div class="sub-title">
    <h2>RSS Feeds</h2>
    <a href="contact.html"><i class="icon-envelope"></i></a>
</div>
@endsection

@section('action_buttons')
@if(Session::has('success_message'))
    <div class="alert alert-success">
        <strong>Success!</strong> {{Session::get('success_message')}}
    </div>
    @endif
    @if(Session::has('warning_message'))
    <div class="alert alert-warning">
        <strong>Warning!</strong> {{Session::get('warning_message')}}
    </div>   
    @endif
    @if(Session::has('error_message'))
    <div class="alert alert-danger">
        <strong>Danger!</strong> {{Session::get('error_message')}}
    </div>
@endif
<form action="{{route('home')}}" method="GET">

        <div class="col-sm-6">
            <select name="channel_id" id="channel" class="form-control" id="exampleFormControlSelect1">
                <option value="">Select a channel</option>
                @foreach($feed_channel as $channel)
                <option value="{{$channel['id']}}">{{$channel['channel_name']}}</option>
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
                <span>Posted on {{date('Y-m-d H:i:s a', strtotime($item['pubDate']))}}&nbsp;&nbsp;<a href="#" target="_blank">Alex Parker</a></span>
            </div>  
            <p>{{strip_tags($item['description'])}}</p>
            <p class="post-meta">Link : 
                    <a style=" font-size: 12px;" href="{{$item['link']}}" target="_blank">{{substr($item['link'], 0, 50)}}</a>
            </p>
            <a href="javascript:;" onclick="loadDatbaseDetails({{$item['id']}})" class="button button-style button-anim fa fa-long-arrow-right"><span>Read More</span></a>
        </div>
    <!-- Blog Post End -->
    @endforeach
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
<!---Loader -->
<div class="preloader" id="preloader">
       <div class="rounder"></div>
</div>
@endsection