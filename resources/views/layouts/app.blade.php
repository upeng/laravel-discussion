<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>blog分享区</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-default navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/home"><i class="fa fa-home" aria-hidden="true"></i></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="/">首 页</a></li> 
          </ul>
          <ul class="nav navbar-nav navbar-right">
              @if (Auth::guest())                  
                  <li><a href="{{ url('/login') }}">登录</a></li>
                  <li><a href="{{ url('/register') }}">注册</a></li>
              @else
                  <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                          {{ Auth::user()->name }}<span class="caret"></span> <img src="{{Auth::user()->avatar}}" width="30px" alt="">
                      </a>

                      <ul class="dropdown-menu" role="menu">
                          <li><a href="/avatar"><i class="fa fa-cogs" aria-hidden="true">&nbsp</i>修改头像</a></li> 
                          <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out">&nbsp</i>退出</a></li> 
                      </ul>
                  </li>
              @endif 
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
    @yield('content') 
</body>

</html>