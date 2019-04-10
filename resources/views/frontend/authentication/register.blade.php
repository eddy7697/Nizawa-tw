@extends('main')

@section('content')
    <div class="container mg-site-thumbnail">
        <div class="col-md-12">
            <a href="/">首頁</a>
            &nbsp;&nbsp;>&nbsp;&nbsp;
            會員註冊
        </div>
    </div>
    <div class="container" style="margin-bottom: 30px">
        <div class="row">
            <div class="col-md-6 col-md-offset-3 member-auth-form-table">
                {{-- {{Route::getCurrentRoute()->getActionName()}} --}}
                <form class="form-horizontal" method="POST" action="/registerNormalUser">
                    {{-- <div class="center-hr xl">
                        <span>
                            社群登入
                        </span>
                    </div> --}}
                    <div style="text-align: center" class="social-login-section">
                        <div class="row">
                            <div class="col-sm-6">
                                <a class="btn btn-primary" href="{{ url('auth/facebook') }}" style="background:#3B5998; border:#3B5998; font-size: 16px">
                                    <i class="fa fa-facebook"></i>&nbsp;&nbsp;Facebook 登入
                                </a>
                            </div>
                            <div class="col-sm-6">
                                <a class="btn btn-primary" href="{{ url('auth/google') }}" style="background:#c9302c; border:#c9302c; font-size: 16px">
                                    <i class="fa fa-google"></i>&nbsp;&nbsp;Google 登入
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="center-hr xl">
                        <span>
                            一般註冊
                        </span>
                    </div>
                    {{ csrf_field() }}

                    <p>請詳細的逐項填寫下列相關之資料，以方便我們為您提供更貼切之服務。您所填寫的相關資料係僅作為我們提供會員購物服務之使用，本公司依據「個人資料保護法」第八條規定將盡妥善保管之責任。</p>
                    <table class="sign-form">
                        <tr>
                            <td><label for="signup-mail">姓名</label></td>
                        </tr>
                        <tr>
                            <td>
                                {{-- <input type="text" name="signup-mail" id="signup-mail" value=""> --}}
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><label for="signup-mail">E-mail</label></td>
                        </tr>
                        <tr>
                            <td>
                                {{-- <input type="text" name="signup-mail" id="signup-mail" value=""> --}}
                                <input id="signup-mail" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span style="color: red">
                                        <strong>電子郵件帳號已被註冊。</strong>
                                    </span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><label for="signup-password">密碼</label></td>
                        </tr>
                        <tr>
                            <td>
                                {{-- <input type="text" name="signup-password" id="signup-password" value=""> --}}
                                <input id="signup-password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><label for="signup-password-confirmed">確認密碼</label></td>
                        </tr>
                        <tr>
                            <td>
                                <input id="signup-password-confirmed" type="password" class="form-control" name="password_confirmation" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                {!! NoCaptcha::renderJs() !!}
                                <div class="checkbox">
                                    {!! NoCaptcha::display() !!}
                                </div>
                                @if ($errors->has('g-recaptcha-response'))
                                    <span class="help-block">
                                        <strong>登入必須通過驗證</strong>
                                    </span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 20px 5px;">
                                <button type="submit" class="btn btn-primary">註冊</button>
                                @if (false)
                                    <input type="checkbox" id="subscriptable" name="subscriptable" value="true">
                                    <label for="subscriptable">訂閱電子報，享有不定期優惠代碼</label>
                                @endif
                                
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>

@endsection
