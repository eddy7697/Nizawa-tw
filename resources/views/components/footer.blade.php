@php
    $language = '';

    foreach (Config::get('languages') as $key => $value) {
        if ($key == App::getLocale()) {
            $language = $value;
        }
    }
@endphp

<section class="site-footer">
    <div class="container-fluid site-footer-content">
        {{-- footer-section --}}
        <div class="col-md-12 footer-section">
            <div class="footer-logo">
                <img src="/img/site-logo/logo_footer.png" alt="">
            </div>
            <div class="dropdown footer-language-bar">
                <a href="#" data-toggle="dropdown"><i class="fa fa-globe" aria-hidden="true"></i>&nbsp;{{$language}}&nbsp;<i class="fa fa-caret-down" aria-hidden="true"></i></a>
                <div class="dropdown-menu">
                    @foreach (Config::get('languages') as $lang => $language)
                        @if ($lang != App::getLocale())
                            <a class="dropdown-item" style="color: #aaa; font-weight: light; margin-top: 5px; text-decoration: none; padding: 5px 10px;" href="{{ route('lang.switch', $lang) }}">{{$language}}</a>
                        @else
                            <a class="dropdown-item" style="color: #004471; font-weight: bolder; margin-top: 5px; text-decoration: none; padding: 5px 10px;" href="{{ route('lang.switch', $lang) }}">{{$language}}</a>
                        @endif
                    @endforeach
                </div>
            </div>

            {{-- footer-info --}}
            <div class="row footer-info">
                <div class="col-md-12">
                    <div class="left-col">
                        <ul class="info">
                            <li>{{ trans('string.phone') }}：+886-3-4935921 / +886-3-4935900</li>
                            <li>{{ trans('string.fax') }}：+886-3-4928654</li>
                            <li>{{ trans('string.email') }}：info@nizawa-int.com.tw</li>
                            <li>{{ trans('string.address') }}：{{ trans('string.fullAddress') }}</li>
                            <li>{{ trans('string.postcode') }}：32047</li>
                            <li>{{ trans('string.working') }}：09:00 ~ 18:00 (Mon - Fri)</li>
                        </ul>
                    </div>
                    <div class="right-col">
                        <div class="row">
                            <div class="col-sm-6 col-md-3 site-map-container">
                                <h3>{{ trans('string.about') }}</h3>
                                <ul class="site-map">
                                    <li><a href="/about">{{ trans('string.company_profile') }}</a></li>
                                    <li><a href="/about/responsibility">{{ trans('string.responsibility') }}</a></li>
                                    <li><a href="/about/career">{{ trans('string.recruiting') }}</a></li>
                                    <li><a href="/contact">{{ trans('string.about4') }}</a></li>
                                </ul>
                            </div>
                            <div class="col-sm-6 col-md-3 site-map-container">
                                <h3>{{ trans('string.support') }}</h3>
                                <ul class="site-map">
                                    <li><a href="/service">{{ trans('string.service') }}</a></li>
                                    <li><a href="/qna">{{ trans('string.faq') }}</a></li>
                                    <li><a href="/download">{{ trans('string.download') }}</a></li>
                                </ul>
                            </div>
                            <div class="col-md-6 sub-form-container">
                                <h3>{{ trans('string.subscription') }}</h3>
                                <form id="subscribes-form">
                                    {{ csrf_field() }}
                                    <table class="sub-form">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <input class="sub-input" name="name" type="text" placeholder="{{trans('string.placeholder_sub1')}}" required>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input class="sub-input" name="email" type="email" placeholder="{{trans('string.placeholder_sub2')}}" required>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <button class="sub-btn" type="submit">{{ trans('string.submit') }}</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div style="c​​lear:both"></div>
                </div>
            </div>
            {{-- footer-info --}}

            {{-- copyright --}}
            <div class="row copyright">
                <div class="col-md-4" style="text-align: left; padding-left: 50px;">
                    <a href="/about/privacy">{{ trans('string.privacy') }}</a>&nbsp;|&nbsp;<a href="/about/notice">{{ trans('string.notice') }}</a>
                </div>
                <div class="col-md-4" style="text-align: center">
                    
                </div>
                <div class="col-md-4" style="text-align: right; color: rgba(255,255,255, 0.4); padding-right: 50px;">
                    Copyright &copy; NIZAWA INTERNATIONAL HI-TECH CORP. All Right Reserved.
                </div>
            </div>
        </div> 
        {{-- footer-section --}}

    </div>
</section>