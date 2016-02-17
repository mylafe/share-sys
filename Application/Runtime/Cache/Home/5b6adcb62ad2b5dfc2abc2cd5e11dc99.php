<?php if (!defined('THINK_PATH')) exit();?> <!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="作品展示,个人分享"/>
    <meta name="description" content="个人文章博客分享" />

    <title>作品分享</title>
    
    <link rel="icon" type="image/png" href="/Public/img/toplogo.png" />

    <link href="/Public/css/amazeui.min.css" rel="stylesheet">
    <link href="/Public/css/admin.css" rel="stylesheet">
    <link href="/Public/css/animate.css" rel="stylesheet">
    <link href="/Public/css/style.css" rel="stylesheet">
    
    <script src="/Public/js/jquery-2.1.1.js"></script>
    <script src="/Public/js/amazeui.min.js"></script>
    
<style>
    .header {
      padding-top: 80px;
      text-align: center;
    }
    .header h1 {
      font-size: 200%;
      color:#fff;
      margin-top: 30px;
      padding-bottom:20px;
    }
    .header p {
      font-size: 14px;
    }
    .sub{
      width: 100px;
      float: right;
    }
    .clear{
      clear: both;
    }
</style>
    

<script language="JavaScript">

  function keyLogin(){
    if (event.keyCode==13) //回车键的键值为13
    document.getElementById("login").click(); //调用登录按钮的登录事件
  }
</script>

</head>

<body class="gray-bg" onkeyup="keyLogin();">
    <div class="header" style="background-color:rgb(14,144,210);">
    <h1 data-am-scrollspy="{animation:'slide-left', delay: 500}"
        class="am-scrollspy-init am-scrollspy-inview am-animation-slide-left">欢迎访问作品分享</h1>
    <h1 data-am-scrollspy="{animation:'slide-right', delay: 500}"
        class="am-scrollspy-init am-scrollspy-inview am-animation-slide-right">登录</h1>
    </div>

    <div class="am-g">
      <div class="am-u-lg-6 am-u-md-8 am-u-sm-centered">
        <form action="/home/login/login" method="post" class="am-form" id="myform">
          <label for="username">用户:</label>
          <input type="text" name="userid" id="userid" required="">
          <br>
          <label for="password">密码:</label>
          <input type="password" name="password" id="password" required="">
          <br>
          <div class="sub">
          <input type="submit" name="login" id="login" value="登 录" class="am-btn am-btn-primary am-btn-sm am-fl">
          </div>
          <p class="text-muted text-center"><small>没有账号?</small></p>
          <a class="btn btn-sm btn-white btn-block" href="<?php echo U('register/index');?>">注册</a>
        </form>
        <div class="clear"></div>
        <hr>
        <p>© 2016 作品分享</p>
      </div>
    </div>

</body>
</html>