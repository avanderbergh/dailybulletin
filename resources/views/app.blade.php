<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daily Bulletin</title>
    <link href='https://fonts.googleapis.com/css?family=UnifrakturCook:700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="/css/app.css"/>
</head>
<body>
    @if(Helper::canPost())
        <ul class="nav nav-pills pull-right">
            <li role="presentation"><a href="{{url('api/announcements/create')}}">Create Announcement</a></li>
        </ul>
        <ul class="nav nav-pills">
            <li role="presentation" class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    Grade <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    @for($i=6; $i<=12; $i++)
                        <li><a href="{{url('api/announcements/grade/'.$i)}}">{{$i}}</a></li>
                    @endfor
                    <li><a href="{{url('api/announcements')}}">All</a></li>
                </ul>
            </li>
        </ul>
    @endif
    <div class="container" id="main">
        <div class="header">
            <span class="titlefont">The Daily Bulletin</span><br/>
            <small>
                {{date('l, F j, Y') }}
            </small>
            <hr/>
        </div>
        @yield('content')
    </div>
    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
</body>
</html>