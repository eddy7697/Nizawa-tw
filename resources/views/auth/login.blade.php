<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ SiteMetaView::title() }}</title>

    <link rel="shortcut icon" href="{{SiteMetaView::shortcut()}}" type="image/x-icon">

    <!-- Styles -->
    <link href="{{ asset('css/all.css') }}" rel="stylesheet">
    <link href="{{ asset('js/plugins/jquery-ui/jquery-ui.min.css') }}" rel="stylesheet">
    <link href="{{ asset('js/plugins/jquery.fancytree/dist/skin-themeroller/ui.fancytree.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style media="screen">
        .login_content h1 {
            font-family: Microsoft JhengHei !important;
        }
        .g-recaptcha div {
            margin: 0 auto;
        }
        .loading-bar {
            position: fixed;
            display: block;
            z-index: 999999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255,255,255,0);
        }
        .loading-bar img.loading-icon {
            width: 100px;
            position: absolute;
            left: 50%;
            top: 50%;
            margin-top: -50px;
            margin-left: -50px;
        }
    </style>
</head>

 <body class="login">
    <div>
        <a class="hiddenanchor" id="signup"></a>
        <a class="hiddenanchor" id="signin"></a>

        <div class="login_wrapper">
            <div class="animate form login_form">
                <section class="login_content">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        <h1>系統登入</h1>
                        <div>
                            <input id="email" type="email" class="form-control" name="email" placeholder="電子郵件" value="{{ old('email') }}" required autofocus>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div>
                            <input id="password" type="password" class="form-control" placeholder="密碼" name="password" required>

                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div>
                            {!! NoCaptcha::renderJs() !!}
                            <div class="checkbox">
                                {!! NoCaptcha::display() !!}
                            </div>
                            @if ($errors->has('g-recaptcha-response'))
                                <span class="help-block">
                                    <strong>登入必須通過驗證</strong>
                                </span>
                            @endif
                        </div>
                        <div>
                            <br>
                            <button type="submit" class="btn btn-default">
                                登入
                            </button>
                        </div>
                        <div>
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                忘記密碼? 請點我
                            </a>
                        </div>

                        <div class="clearfix"></div>

                        <div class="separator">

                            <div class="clearfix"></div>
                            <br />

                            <div>
                                <img src="/img/LanuchCenter_v2.png" width="100%" alt="碩果數位有限公司" title="碩果數位有限公司">
                            </div>
                        </div>
                    </form>
                    
                    
                </section>
            </div>
        </div>
    </div>
</body>

</html>


