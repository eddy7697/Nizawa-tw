@extends('main')

@section('content')
    <div class="container mg-site-thumbnail">
        <div class="col-md-12">
            <a href="/">{{ trans('string.home') }}</a>
            &nbsp;&nbsp;<a>></a>&nbsp;&nbsp;
            {{ trans('string.forget_password') }}
        </div>
    </div>
    <div class="container" style="margin-bottom: 30px">
        <div class="row">
            <div class="col-md-6 col-md-offset-3 member-auth-form-table">
                <form class="form-horizontal" action="{{ route('sendResetPasswordMail') }}" method="post">
                    {{ csrf_field() }}
                    <h3>{{ trans('string.forget_password_q') }}</h3>
                    <p>{{ trans('string.forget_password_remind') }}</p>
                    <hr>
                    <table class="sign-form">
                        <tr>
                            <td><label for="login-mail">E-mail</label></td>
                        </tr>
                        <tr>
                            <td>
                                <input id="login-mail" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
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
                                        <strong>{{ trans('string.not_validate') }}</strong>
                                    </span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 5px;">
                                <button type="submit" class="btn btn-primary">{{ trans('string.send_valid_letter') }}</button>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>

@endsection
