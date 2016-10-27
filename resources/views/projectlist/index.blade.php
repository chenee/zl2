<!DOCTYPE html>
<!-- saved from url=(0062)http://localhost:63342/src/tmp/%E7%88%B1%E4%B8%AA%E8%B4%AD.htm -->
<html slick-uniqueid="3" style="font-size: 50px;">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">


    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport">
    <meta content="yes" name="apple-mobile-web-app-capable">
    <meta content="black" name="apple-mobile-web-app-status-bar-style">
    <meta content="telephone=no" name="format-detection">
    <title>project list</title>
    <link rel="stylesheet" href="/static/build_index_o2o.min.css">
    <link href="/static/wap-stylev2.css" rel="stylesheet" type="text/css">
</head>

<body>
<div class="content">


    <!--分类-->
    <div class="nlt new" style="height: 4px"><h4></h4></div>
    <ul class="type">

        @foreach($lists as $list)
            <li>
                <div>wx_openid:{{$list->wx_openid}}</div>
                @foreach($list->pay->history as $p)
                    <div>pay:{{$p->name}}</div>
                @endforeach
            </li><p/>
        @endforeach
    </ul>
</div>
</body>
</html>