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

    <div>wx_openid:{{$item['wx_openid']}}</div>
    <div>wx_openid:{{$item['requirement']}}</div>
    <div>wx_openid:{{$item['number']}}</div>

    <br/>
    <div class=""><h4>付款</h4></div>
    <ui>
        @foreach($item['pay']['history'] as $p)
            <li>
                <div>name:{{$p['name']}}</div>
                <div>cash:{{$p['cash']}}</div>
                <div>payed:{{$p['payed']}}</div>
            </li>
            <br/>
        @endforeach
    </ui>

    <br/>

    <div class="" ><h4>沟通</h4></div>
    <ui>
        @foreach($item['沟通'] as $p)
            <li>
                <div>from:{{$p['from']}}</div>
                <div>time:{{$p['time']}}</div>
                <div>msg:{{$p['msg']}}</div>
            </li>
            <br/>
        @endforeach
    </ui>
    <form action="/detail/communication" method="POST" class="form-horizontal">
        {{ csrf_field() }}
                <!-- Registration form starts -->
        <input type="hidden" name="wx_openid" value={{$item['wx_openid']}}/>
        <input type="hidden" name="id" value={{$item['_id']->{'$id'} }} />
        <!-- 物流需求-->
        <div class="form-group">
            <label class="control-label col-lg-3" for="msg">回复</label>

            <div class="col-lg-9">
                <textarea type="text" class="form-control" id="msg" name="msg"></textarea>
            </div>
        </div>
        <!-- Accept box and button s-->
        <div class="form-group">
            <div class="col-lg-9 col-lg-offset-3">
                <br>
                <button type="submit" class="btn btn-danger">Apply</button>
            </div>
        </div>
        <br>
    </form>

</div>
</body>
</html>