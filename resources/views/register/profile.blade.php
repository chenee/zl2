<!DOCTYPE html>
<!-- saved from url=(0051)http://www.js-css.cn/divcss/admin/mac/register.html -->
<html lang="en" slick-uniqueid="3">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">


    <!-- Title and other stuffs -->
    <title>用户注册页面</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="">
    <!-- Stylesheets -->
    <link href="static_register/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="static_register/font-awesome.css">
    <link href="static_register/style.css" rel="stylesheet">
    <link href="static_register/bootstrap-responsive.css" rel="stylesheet">


    <!-- Favicon -->
</head>

<body>

<div class="admin-form">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- Widget starts -->
                <div class="widget wred">
                    <div class="widget-head">
                        <i class="icon-lock"></i> Register
                    </div>
                    <div class="widget-content">
                        <div class="padd">

                            <form action="/editprofile" method="POST" class="form-horizontal">
                                {{ csrf_field() }}
                                <!-- Registration form starts -->
                                <!-- Name -->
                                <input type="hidden" name="wx_openid" value={{$item['wx_openid']}} />
                                <input type="hidden" name="wx_nickname" value={{$item['wx_nickname']}} />
                                <input type="hidden" name="wx_headimgurl" value={{$item['wx_headimgurl']}} />
                                <div class="form-group">
                                    <label class="control-label col-lg-3" for="name">姓名</label>

                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" id="name" name="name" value={{$item['name'] }}>
                                    </div>
                                </div>
                                <!-- Sex-->
                                <div class="form-group">
                                    <label class="control-label col-lg-3" for="gender">性别</label>
                                    <div class="rows" id="gender">
                                        <div class="col-md-4">
                                            <div class="col-lg-6">
                                                <div class="radio">
                                                    <label><input <?php if($item['sex']){echo "checked";} ?> id="optionsRadios2" name="sex" type="radio" value=1>男</label>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="radio">
                                                    <label><input  <?php if( ! $item['sex']){echo "checked";} ?> id="optionsRadios1" name="sex" type="radio" value=0>女</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Birthday-->
                                <div class="form-group">
                                    <label class="control-label col-lg-3" for="birthday">出生年月</label>

                                    <div class="col-lg-9">
                                        <select class="form-control" id="birthday" name="birthday">
                                            <option>&nbsp;</option>
                                            <?php
                                            $years = range(2020, 1900);
                                            foreach ($years as $yr) {
                                                if($yr == $item['birthday']) {
                                                    echo '<option selected value='.$yr.'>'.$yr.'</option>';
                                                }else{
                                                    echo '<option value='.$yr.'>'.$yr.'</option>';
                                                }
                                            }

                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <!-- CellPhone-->
                                <div class="form-group">
                                    <label class="control-label col-lg-3" for="cellphone">电话号码</label>

                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" id="cellphone" name="cellphone" value={{$item['cellphone'] }}>
                                    </div>
                                </div>
                                <!-- Email -->
                                <div class="form-group">
                                    <label class="control-label col-lg-3" for="email">Email</label>

                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" id="email" name="email" value={{$item['email'] }}>
                                    </div>
                                </div>
                                <!-- CompanyName-->
                                <div class="form-group">
                                    <label class="control-label col-lg-3" for="company_name">公司名称</label>

                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" id="company_name" name="company_name" value={{$item['company_name'] }}>
                                    </div>
                                </div>
                                <!-- CompanyAddress-->
                                <div class="form-group">
                                    <label class="control-label col-lg-3" for="company_address">公司地址</label>

                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" id="company_address" name="company_address" value={{$item['company_address'] }}>
                                    </div>
                                </div>
                                <!-- Experience-->
                                <div class="form-group">
                                    <label class="control-label col-lg-3" for="experience">工作经历</label>

                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" id="experience" name="experience" value={{$item['experience'] }}>
                                    </div>
                                </div>
                                <!-- ProductInfo-->
                                <div class="form-group">
                                    <label class="control-label col-lg-3" for="product_info">产品简介</label>

                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" id="product_info" name="product_info" value={{$item['product_info'] }}>
                                    </div>
                                </div>
                                <!-- SourceInfo-->
                                <div class="form-group">
                                    <label class="control-label col-lg-3" for="source_info">所缺资源说明</label>

                                    <div class="col-lg-9">
                                        <input type="text" class="form-control" id="source_info" name="source_info" value={{$item['source_info'] }}>
                                    </div>
                                </div>

                                <!-- Accept box and button s-->
                                <div class="form-group">
                                    <div class="col-lg-9 col-lg-offset-3">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox"> 本人接受合作协议<a href="www.baidu.com">《合作协议内容》</a>
                                            </label>
                                        </div>
                                        <br>
                                        <button type="submit" class="btn btn-danger">update</button>
                                        <button type="reset" class="btn btn-success">Reset</button>
                                    </div>
                                </div>
                                <br>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- JS -->
<script src="static_register/jquery.js"></script>
<script src="static_register/bootstrap.js"></script>

</body>
</html>
