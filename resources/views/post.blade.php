<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Wb Summar 2019</title>
        <!-- Bootstrap core CSS -->
        <link href="{{asset('public/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
        <!-- Custom fonts for this template -->
        <link href="{{asset('public/css/all.min.css')}}" rel="stylesheet" type="text/css">
        <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
        <!-- Custom styles for this template -->
        <link href="{{asset('public/css/clean-blog.min.css')}}" rel="stylesheet" type="text/css">

    </head>

    <body>

        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand" href="{{route('home')}}">Wb-Summar-2019</a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('home')}}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about.html">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="post.html">Sample Post</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact.html">Contact</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Page Header -->
        <header class="masthead" style="background-image: url('<?php echo $post->image; ?>')">
            <div class="overlay"></div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-10 mx-auto">
                        <div class="post-heading">
                            <h1>{{$post->title}}</h1>
                            <h2 class="subheading">{{$post->description}}</h2>
                            <span class="meta">Posted on
                                <a href="{{$post->link}}"></a>
                                {{date("l jS \of F", strtotime($post->pubDate))}}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <script src="{{asset('public/js/jquery.min.js')}}"></script>
        <script src="{{asset('public/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('public/js/clean-blog.min.js')}}"></script>
    </body>

</html>
