@extends('main')

@section('custom-script')
    <script type="text/javascript">
        $(function () {
            $('#refresh-captcha').on('click', function (e) {
                e.preventDefault();

                refreshCaptcha();
            })
        });
        function refreshCaptcha() {
            axios.get('/cap_str')
                .then(res => {
                    $('#captcha').attr('src', '/captcha?q=' + res.data);
                });
        }
    </script>
@endsection

@section('custom-style')
    <style media="screen">
        .feature-image {
            background-image: url('/img/logo_grey.png');
            background-position: center;
            background-size: cover;
            padding-bottom: 41.6%;
        }
        .feature-content {
           
        }
        .feature-content p{
            line-height: 2em;
            text-indent : 2em;
        }
    </style>
@endsection

@section('content')
<div class="sub-page-banner" style="background-image: url('/img/sub-banner.jpg');">
    <div>
        <h2>{{ trans('string.about4') }}</h2>
        @if (App::getLocale() !== 'en')
        <h4>Contact Us</h4>    
        @endif
        
        <hr>
        <h5>{{ trans('string.contact_banner_desc') }}</h5>
    </div>
</div>
<div class="mg-site-thumbnail">
    <div class="container">
        <div class="col-md-12">
            <a href="/">{{ trans('string.home') }}</a>
            &nbsp;&nbsp;<a>></a>&nbsp;&nbsp;
            {{ trans('string.about4') }}
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-9 mx-auto site-contact-container">
            <form action="{{route('sendForm')}}" method="POST">
                {{ csrf_field() }}
                <div class="col-md-11 mx-auto contact-form-header">
                    <h1>{{ trans('string.about4') }}</h1>
                    <hr>
                    <p>{{ trans('string.contact_banner_desc') }}</p>
                </div>
                <div class="col-md-10 mx-auto contact-form-body">
                    <div class="row">
                        <div class="col-md-4 column important" data-title="{{ trans('string.form_required') }}">
                            <p>{{ trans('string.contact1') }}</p>
                        </div>
                        <div class="col-md-8 column">
                            <input class="form-control" type="text" name="name" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 column important" data-title="{{ trans('string.form_required') }}">
                            <p>{{ trans('string.contact2') }}</p>
                        </div>
                        <div class="col-md-8 column">
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="gender" value="{{trans('string.male')}}" required>{{trans('string.male')}}
                                </label>
                            </div>
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="gender" value="{{trans('string.female')}}" required>{{trans('string.female')}}
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 column important" data-title="{{ trans('string.form_required') }}">
                            <p>{{ trans('string.contact3') }}</p>
                        </div>
                        <div class="col-md-8 column">
                            <input class="form-control" type="email" name="email" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 column important" data-title="{{ trans('string.form_required') }}">
                            <p>{{ trans('string.contact4') }}</p>
                        </div>
                        <div class="col-md-8 column">
                            <input class="form-control" type="phone" name="phone" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 column important" data-title="{{ trans('string.form_required') }}">
                            <p>{{ trans('string.contact5') }}</p>
                        </div>
                        <div class="col-md-8 column">
                            <select name="type" class="form-control" required>
                                <option disabled>--{{ trans('string.inquery_type') }}--</option>
                                <option value="{{ trans('string.inquery_type1') }}">{{ trans('string.inquery_type1') }}</option>
                                <option value="{{ trans('string.inquery_type2') }}">{{ trans('string.inquery_type2') }}</option>
                                <option value="{{ trans('string.inquery_type3') }}">{{ trans('string.inquery_type3') }}</option>
                                <option value="{{ trans('string.inquery_type4') }}">{{ trans('string.inquery_type4') }}</option>
                                <option value="{{ trans('string.inquery_type5') }}">{{ trans('string.inquery_type5') }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 column important" data-title="{{ trans('string.form_required') }}">
                            <p>{{ trans('string.contact6') }}</p>
                            <p class="text">{{ trans('string.comment_remind') }}</p>
                        </div>
                        <div class="col-md-8 column">
                            <textarea name="content" class="form-control content" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-md-10 mx-auto contact-form-footer">
                    <p class="info">{!! trans('string.contact_remind1') !!}</p>
                    <p class="info">{!! trans('string.contact_remind2') !!}</p>
                    <div class="captcha-section">
                        <strong>{{ trans('string.captcha') }}</strong>
                        <img src="/captcha" id="captcha" alt="">
                        <a href="#" id="refresh-captcha">{{ trans('string.captcha_refresh') }}</a>
                        <input type="text" class="form-control captcha" name="captcha" placeholder="{{trans('string.captcha_enter')}}" required title="{{trans('string.captcha_enter')}}">
                        @if ($errors->has('captcha_error'))
                            <span class="help-block">
                                <strong>{{ trans('string.captcha_error') }}</strong>
                            </span>
                        @endif
                        <button class="submit-btn" type="submit">{{ trans('string.contact_submit') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
