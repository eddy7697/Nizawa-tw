@php
    $language = '';

    foreach (Config::get('languages') as $key => $value) {
        if ($key == App::getLocale()) {
            $language = $value;
        }
    }
@endphp

<section class="site-footer" data-aos="fade-up">
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
                            <li>连络电话：+86-010-5869-3457</li>
                            <li>传真电话：+86-010-5869-3457</li>
                            <li>电子邮件：service@iontestkrk.com.cn</li>
                            <li>地址：中国(上海)自由贸易试验区张扬路828-838号26楼</li>
                            <li>邮政编码：100088</li>
                            <li>办公时间：09:00 ~ 18:00 (Mon - Fri)</li>
                        </ul>
                    </div>
                    <div class="right-col">
                        <div class="row">
                            <div class="col-sm-6 col-md-3 site-map-container">
                                <h3>关于科尔克</h3>
                                <ul class="site-map">
                                    <li><a href="">公司介绍</a></li>
                                    <li><a href="">全球认证</a></li>
                                    <li><a href="">社会责任</a></li>
                                    <li><a href="">人才招募</a></li>
                                    <li><a href="">联系我们</a></li>
                                </ul>
                            </div>
                            <div class="col-sm-6 col-md-3 site-map-container">
                                <h3>服务支持</h3>
                                <ul class="site-map">
                                    <li><a href="">授权经销商</a></li>
                                    <li><a href="">售后服务</a></li>
                                    <li><a href="">常见问题</a></li>
                                    <li><a href="">数据下载</a></li>
                                </ul>
                            </div>
                            <div class="col-md-6 sub-form-container">
                                <h3>订阅电子报</h3>
                                <form action="" method="POST">
                                    <table class="sub-form">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <input class="sub-input" type="name" placeholder="请输入姓名..." required>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input class="sub-input" type="email" placeholder="请输入电子邮件..." required>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <button class="sub-btn" type="submit">送出</button>
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
                <div class="col-md-4" style="text-align: center">
                    <a href="">隐私权政策</a>&nbsp;|&nbsp;<a href="">使用条款</a>
                </div>
                <div class="col-md-4" style="text-align: center">
                    <img src="/img/gongan.png" alt="" style="display: inline-block"><p style="margin: 0 5px 0; display: inline-block;">ICP备12006504号-4</p>
                </div>
                <div class="col-md-4" style="text-align: center; color: rgba(255,255,255, 0.4)">
                    Copyright &copy; KRK Lab-pro Instrument Co., Ltd All Right Reserved.
                </div>
            </div>
        </div> 
        {{-- footer-section --}}

    </div>
</section>