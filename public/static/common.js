if (typeof AGG == "undefined") {
    var AGG = {};
}

AGG.dynamic_url = ApiUrl + "/index.php?act=home&op=get_dynamic_url_agg&url=";

function GetQueryString(name) {
    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)");
    var r = window.location.search.substr(1).match(reg);
    if (r != null) return unescape(r[2]);
    return null;
}

function addcookie(name, value, expireHours) {
    var cookieString = name + "=" + escape(value) + "; path=/";
    //判断是否设置过期时间
    if (expireHours > 0) {
        var date = new Date();
        date.setTime(date.getTime + expireHours * 3600 * 1000);
        cookieString = cookieString + "; expire=" + date.toGMTString();
    }
    document.cookie = cookieString;
}

function getcookie(name) {
    var strcookie = document.cookie;
    var arrcookie = strcookie.split("; ");
    for (var i = 0; i < arrcookie.length; i++) {
        var arr = arrcookie[i].split("=");
        if (arr[0] == name)return arr[1];
    }
    return "";
}

function delCookie(name) {//删除cookie
    var exp = new Date();
    exp.setTime(exp.getTime() - 1);
    var cval = getcookie(name);
    if (cval != null) document.cookie = name + "=" + cval + "; path=/;expires=" + exp.toGMTString();
}

function checklogin(state) {
    if (state == 0) {
        location.href = WapSiteUrl + '/tmpl/member/login.html';
        return false;
    } else {
        return true;
    }
}

function contains(arr, str) {
    var i = arr.length;
    while (i--) {
        if (arr[i] === str) {
            return true;
        }
    }
    return false;
}

function buildUrl(type, data) {
    switch (type) {
        case 'keyword':
            return WapSiteUrl + '/tmpl/product_list.html?keyword=' + encodeURIComponent(data);
        case 'special':
            return WapSiteUrl + '/special.html?special_id=' + data;
        case 'goods':
            return WapSiteUrl + '/tmpl/product_detail.html?goods_id=' + data;
        case 'url':
            return data;
        case '':
            return data;
        case 'undefined':
            return data;
    }
    return WapSiteUrl;
}

//获取url参数
function request(paras) {
    var url = location.href;
    url = decodeURI(url);
    var paraString = url.substring(url.indexOf("?") + 1, url.length).split("&");
    var paraObj = {};
    for (var i = 0; j = paraString[i]; i++) {
        paraObj[j.substring(0, j.indexOf("=")).toLowerCase()] = j.substring(j.indexOf("=") + 1, j.length);
    }
    var returnValue = paraObj[paras.toLowerCase()];
    if (typeof(returnValue) == "undefined") {
        return "";
    } else {
        return returnValue;
    }
}

//设置url参数值，ref参数名,value新的参数值
function changeURLPar(url, ref, value) {
    var str = "";
    if (url.indexOf('?') != -1)
        str = url.substr(url.indexOf('?') + 1);
    else
        return url + "?" + ref + "=" + value;
    var returnurl = "";
    var setparam = "";
    var arr;
    var modify = "0";
    if (str.indexOf('&') != -1) {
        arr = str.split('&');
        for (i in arr) {
            if (arr[i].split('=')[0] == ref) {
                setparam = value;
                modify = "1";
            }
            else {
                setparam = arr[i].split('=')[1];
            }
            returnurl = returnurl + arr[i].split('=')[0] + "=" + setparam + "&";
        }
        returnurl = returnurl.substr(0, returnurl.length - 1);
        if (modify == "0")
            if (returnurl == str)
                returnurl = returnurl + "&" + ref + "=" + value;
    }
    else {
        if (str.indexOf('=') != -1) {
            arr = str.split('=');
            if (arr[0] == ref) {
                setparam = value;
                modify = "1";
            }
            else {
                setparam = arr[1];
            }
            returnurl = arr[0] + "=" + setparam;
            if (modify == "0")
                if (returnurl == str)
                    returnurl = returnurl + "&" + ref + "=" + value;
        }
        else
            returnurl = ref + "=" + value;
    }
    return url.substr(0, url.indexOf('?')) + "?" + returnurl;
}

//删除参数值
function delQueStr(url, ref) {
    var str = "";
    if (url.indexOf('?') != -1) {
        str = url.substr(url.indexOf('?') + 1);
    }
    else {
        return url;
    }
    var arr = "";
    var returnurl = "";
    var setparam = "";
    if (str.indexOf('&') != -1) {
        arr = str.split('&');
        for (i in arr) {
            if (arr[i].split('=')[0] != ref) {
                returnurl = returnurl + arr[i].split('=')[0] + "=" + arr[i].split('=')[1] + "&";
            }
        }
        return url.substr(0, url.indexOf('?')) + "?" + returnurl.substr(0, returnurl.length - 1);
    }
    else {
        arr = str.split('=');
        if (arr[0] == ref) {
            return url.substr(0, url.indexOf('?'));
        }
        else {
            return url;
        }
    }
}


AGG.isWeixin = function () {
    var ua = navigator.userAgent.toLowerCase();
    if (ua.match(/MicroMessenger/i) != "micromessenger") {

        var html = [
            '<div id="MustWeichat" style="display: none;position:absolute;top:0;left: 0; width: 100%;height:100%; z-index: 1000000;text-align: center;background:#fff;">',
            '<div style="display:inline-block;width:60%;margin-top:25%;text-align: center;"><img src="images/pretty_girl.png" style="width:100%;"></div>',
            '<div style="display:inline-block;width:80%;margin-top:10px;text-align: center;">对不起，此页面无法用浏览器打开，请返回微信页面。<br/>',
            '<br/>您可以添加微信公众号<span style="color:red;">aigegou51</span>进入商城首页</div></div>'].join('');
        $("body").html(html);
        $("#MustWeichat").show();
        return false;
    } else {
        return true;
    }
};

AGG.client = {
    type: function () {
        var clientType = request("client_type").toLowerCase() || getcookie("client_type").toLowerCase();
        if (getcookie("client_type") == '') {
            addcookie('client_type', clientType);
        }
        return clientType;
    },
    isApp: function () {
        if (this.type() == "ios" || this.type() == "android") {
            return true;
        } else {
            return false;
        }
    }
};
AGG.optimize = new optimizeFun();
var that = this;
function optimizeFun() {
    this.lazyLoad = function (imgarr, specialObj) {
        (function (root, factory) {
            if (typeof define === 'function' && define.amd) {
                define(function () {
                    return factory(root);
                });
            } else if (typeof exports === 'object') {
                module.exports = factory;
            } else {
                root.echo = factory(root);
            }
        })(that, function (root) {

            'use strict';

            var echo = {};

            var callback = function () {
            };

            var offset, poll, delay, useDebounce, unload;

            var isHidden = function (element) {
                return (element.offsetParent === null);
            };

            var inView = function (element, view) {
                if (isHidden(element)) {
                    return false;
                }

                var box = element.getBoundingClientRect();
                return (box.right >= view.l && box.bottom >= view.t && box.left <= view.r && box.top <= view.b);
            };

            var debounceOrThrottle = function () {
                if (!useDebounce && !!poll) {
                    return;
                }
                clearTimeout(poll);
                poll = setTimeout(function () {
                    echo.render();
                    poll = null;
                }, delay);
            };

            echo.init = function (opts) {
                opts = opts || {};
                var offsetAll = opts.offset || 0;
                var offsetVertical = opts.offsetVertical || offsetAll;
                var offsetHorizontal = opts.offsetHorizontal || offsetAll;
                var optionToInt = function (opt, fallback) {
                    return parseInt(opt || fallback, 10);
                };
                offset = {
                    t: optionToInt(opts.offsetTop, offsetVertical),
                    b: optionToInt(opts.offsetBottom, offsetVertical),
                    l: optionToInt(opts.offsetLeft, offsetHorizontal),
                    r: optionToInt(opts.offsetRight, offsetHorizontal)
                };
                delay = optionToInt(opts.throttle, 250);
                useDebounce = opts.debounce !== false;
                unload = !!opts.unload;
                callback = opts.callback || callback;
                echo.render();
                if (document.addEventListener) {
                    root.addEventListener('scroll', debounceOrThrottle, false);
                    root.addEventListener('load', debounceOrThrottle, false);
                } else {
                    root.attachEvent('onscroll', debounceOrThrottle);
                    root.attachEvent('onload', debounceOrThrottle);
                }
            };

            echo.render = function () {
                var nodes = document.querySelectorAll('img[data-echo], [data-echo-background]');
                var length = nodes.length;
                var src, elem;
                var view = {
                    l: 0 - offset.l,
                    t: 0 - offset.t,
                    b: (root.innerHeight || document.documentElement.clientHeight) + offset.b,
                    r: (root.innerWidth || document.documentElement.clientWidth) + offset.r
                };
                for (var i = 0; i < length; i++) {
                    elem = nodes[i];
                    if (inView(elem, view)) {

                        if (unload) {
                            elem.setAttribute('data-echo-placeholder', elem.src);
                        }

                        if (elem.getAttribute('data-echo-background') !== null) {
                            elem.style.backgroundImage = "url(" + elem.getAttribute('data-echo-background') + ")";
                        }
                        else {
                            elem.src = elem.getAttribute('data-echo');
                        }

                        if (!unload) {
                            elem.removeAttribute('data-echo');
                            elem.removeAttribute('data-echo-background');
                        }

                        callback(elem, 'load');
                    }
                    else if (unload && !!(src = elem.getAttribute('data-echo-placeholder'))) {

                        if (elem.getAttribute('data-echo-background') !== null) {
                            elem.style.backgroundImage = "url(" + src + ")";
                        }
                        else {
                            elem.src = src;
                        }

                        elem.removeAttribute('data-echo-placeholder');
                        callback(elem, 'unload');
                    }
                }
                if (!length) {
                    echo.detach();
                }
            };

            echo.detach = function () {
                if (document.removeEventListener) {
                    root.removeEventListener('scroll', debounceOrThrottle, false);
                } else {
                    root.detachEvent('onscroll', debounceOrThrottle);
                }
                clearTimeout(poll);
            };

            return echo;

        });

    };
    this.lazyLoadSelf = function (imgarr) {
        var mobile = this, height = document.documentElement.clientHeight;
        bottom = document.body.scrollTop + height;
        loadImg();
        document.querySelector("body").addEventListener("touchmove", movefun, false);
        function movefun() {
            bottom = document.body.scrollTop + height;
            loadImg();
        }

        function loadImg() {
            for (var i = 0; i < imgarr.length; i++) {
                if ($(imgarr[i]).offset().top <= bottom) {
                    imgarr[i].src = imgarr[i].getAttribute("data-src");
                    imgarr[i].setAttribute("haveLoaded", '1');
                    imgarr.splice(i, 1);
                    i--;
                }
            }
            if (imgarr.length == 0) {
                document.querySelector("body").removeEventListener("touchmove", movefun, false);
            }
        }
    };
    this.autoChange = function (maxWidth, originSize) {
        var width = document.documentElement.clientWidth;
        var Standard = originSize / (maxWidth * 1.0 / width);
        Standard = Standard > 100 ? 100 : Standard;
        document.querySelector("html").style.fontSize = Standard + "px";
        AGG.font_size = Standard;
        return;
    };
}
AGG.optimize.lazyLoad();


function Win() {
}

Win.prototype = {
    newalert: function (content, callback) {
        $('.alertBox').remove();
        var alertBox = $('<div class="alertBox"></div>');
        alertBox.appendTo('body');
        alertBox.html('<span>' + content + '</span>').show().css('bottom', '60px');
        setTimeout(function () {
            alertBox.css('opacity', '0');
        }, 2000);
        setTimeout(function () {
            alertBox.remove();
            if (typeof callback == 'function') {
                callback();
            }
        }, 2500);
    },
    newalert2: function (content, callback) {
        $('.alertBox2').remove();
        var alertBox = $('<div class="alertBox2"></div>');
        alertBox.appendTo('body');
        alertBox.html('<div class="alertContent"><span>' + content + '</span></div>').show().css('opacity', '1');
        setTimeout(function () {
            alertBox.css('opacity', '0');
        }, 2000);
        setTimeout(function () {
            alertBox.remove();
            if (typeof callback == 'function') {
                callback();
            }
        }, 2200);
    },
    newconfirm: function (title, content, ack, cancel) {
        $('body').css('overflow', 'hidden');
        var confirmBox = $('<div class="confirmBox"></div>');
        confirmBox.appendTo('body');
        var confirmHtml = '<div class="confirm-con">'
            + '<h4>' + title + '</h4>'
            + '<p>' + content + '</p>'
            + '<div class="confirmBtn">'
            + '<a class="ackBtn">确定</a>'
            + '<a class="cancelBtn"><span>取消</span></a>'
            + '</div>'
            + '</div>';
        confirmBox.html(confirmHtml);
        $('.ackBtn').on('click', function () {
            $('body').css('overflow', 'auto');
            confirmBox.remove();
            if (typeof ack == 'function') {
                ack();
            }
        });
        $('.cancelBtn').on('click', function () {
            $('body').css('overflow', 'auto');
            confirmBox.remove();
            if (typeof cancel == 'function') {
                cancel();
            }
        });

    }
};

// 微信的登录
AGG.loginWX = {
    url: 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxa0641282049ed265&redirect_uri=http%3A%2F%2F51aigegou.cn%2Faigegou%2Fagg%2Flocation.html%3Fweb_url%3D{{weburl}}&response_type=code&scope=snsapi_base&state=123#wechat_redirect',
    openWX: function (callURL) {
        var url = this.url;
        var debug = localStorage.getItem("AGG.debug");
        var urlGp = (window.location.href + '').split('#');
        if (callURL) {
            var link = callURL;
        } else {
            var link = urlGp[0].replace(/(code=|state=)\w+&?/g, '');
            link = changeURLPar(link, 'client_type', 'wap');
            link = link.replace(/&/g, '*');
            AGG.removeLoginInfo();
        }

        if (AGG.isWX && !debug) {
            window.location.href = url.replace('{{weburl}}', window.encodeURIComponent(link));
        } else {
            // layer.open({
            //     content: '请在微信中使用',
            //     time: 2
            // });
            window.location.href = WapSiteUrl + "tmpl/member/login.html";
        }
    },
    callWX: function (success, error) {
        var url = ApiUrl + '/index.php?act=member_login&op=wx_auth_login&client_type=wap&register_from=2';
        if (request('code')) {
            layer.open({type: 2});
            if (request('invitation')) {
                url = url + '&code=' + request('code') + '&invitation_code=' + request('invitation');
            } else {
                url = url + '&code=' + request('code');
            }

            $.ajax({
                url: url,
                type: "GET",
                dataType: "jsonp",
                jsonp: "callback",
                success: function (data) {
                    if (data.code === 200) {
                        AGG.storeLoginInfo(data, "wx");
                        if (typeof success == "function") {
                            success();
                        } else {
                            window.location.href = WapSiteUrl + '/index_o2o.html?mustLocation=yes';
                        }
                    } else {
                        if (typeof error == "function") {
                            error();
                        }
                    }
                },
                error: function () {
                    if (typeof error == "function") {
                        error();
                    }
                }
            });
        }
    }
};

// WeiChat Login
AGG.isWX = (function isWX() {
    var ua = navigator.userAgent.toLowerCase();
    return (/micromessenger/.test(ua)) ? true : false;
})();

AGG.storeLoginInfo = function (result, accType) {
    localStorage.setItem("key", result.data.token);
    localStorage.setItem('token', result.data.token);
    localStorage.setItem("invitation", result.data.invitation);
    localStorage.setItem("mobile", result.data.member_mobile);
    if (accType) {
        localStorage.setItem("acc_type", accType);
    }
    addcookie('key', result.data.token);
    addcookie('mobile', result.data.member_mobile);
    addcookie('user_id', result.data.user_id);
    addcookie('is_distribution', result.data.is_distribution);
    addcookie('invitation', result.data.invitation);
};

AGG.removeLoginInfo = function(){
    localStorage.removeItem("key");
    localStorage.removeItem('token');
    localStorage.removeItem("invitation");
    localStorage.removeItem("mobile");
    localStorage.removeItem('free_password');
    delCookie('key');
    delCookie('mobile');
    delCookie('user_id');
    delCookie('is_distribution');
    delCookie('invitation');
};


//  默认使用微信登陆:在非微信／已经登陆／登录页面不发起微信登陆

var NOloginWX = /register.html|login.html|register_step1.html|sharecode_extends_page.html/.test(window.location.href);

$(function () {
    if(!NOloginWX){
        if (AGG.isWX && !localStorage.getItem("key") && !request("code")) {
            AGG.loginWX.openWX();
        }
        if (request("code") && !localStorage.getItem("key")) {
            AGG.loginWX.callWX(function () {
                // 微信登陆成功
                var link = window.location.href.replace(/[&|\?](code=|isWxLogin=|isWxLoginQR=)\w+/g, '');
                if ((new RegExp("index_o2o.html")).test(window.location.href)) {
                    link = changeURLPar(link, 'mustLocation', 'yes');
                }
                window.location.href = link;
                layer.closeAll();
            }, function () {
                // 微信登陆失败
                layer.open({
                    content: '微信登陆失败，请使用帐号登陆',
                    time: 1,
                    end: function () {
                        window.location.href = WapSiteUrl + "/tmpl/member/login.html";
                    }
                });
            });
        }
    }
});

// 友盟统计
(function(){
})();

/*8进制加密*/
AGG.encipher = function (text) {
    var monyer = [];
    if (text) {
        var i;
        for (i = 0; i < text.length; i++) {
            monyer += "//" + text.charCodeAt(i).toString(8);
        }
    }
    return monyer;
};
/*8进制解密*/
AGG.decipher = function (text) {
    var monyer = [];
    if (text) {
        var i;
        var s = text.split("//");
        for (i = 1; i < s.length; i++) {
            monyer += String.fromCharCode(parseInt(s[i], 8));
        }
    }
    return monyer;
};
