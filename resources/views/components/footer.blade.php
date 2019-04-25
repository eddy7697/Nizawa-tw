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
                            <li>聯絡電話：+886-3-4935921 / +886-3-4935900</li>
                            <li>傳真電話：+886-3-4928654</li>
                            <li>電子郵件：info@nizawa-int.com.tw</li>
                            <li>地址：台灣桃園市中壢區三光路60號3F之1</li>
                            <li>郵遞區號：32047</li>
                            <li>服務時間：09:00 ~ 18:00 (Mon - Fri)</li>
                        </ul>
                    </div>
                    <div class="right-col">
                        <div class="row">
                            <div class="col-sm-6 col-md-3 site-map-container">
                                <h3>關於日澤</h3>
                                <ul class="site-map">
                                    <li><a href="">公司介紹</a></li>
                                    <li><a href="">全球認證</a></li>
                                    <li><a href="">社會責任</a></li>
                                    <li><a href="/about/career">人才招募</a></li>
                                    <li><a href="">聯絡我們</a></li>
                                </ul>
                            </div>
                            <div class="col-sm-6 col-md-3 site-map-container">
                                <h3>服務支援</h3>
                                <ul class="site-map">
                                    <li><a href="">售後服務</a></li>
                                    <li><a href="">常見問題</a></li>
                                    <li><a href="">資料下載</a></li>
                                </ul>
                            </div>
                            <div class="col-md-6 sub-form-container">
                                <h3>訂閱電子報</h3>
                                <form action="" method="POST">
                                    <table class="sub-form">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <input class="sub-input" type="name" placeholder="請輸入姓名..." required>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input class="sub-input" type="email" placeholder="請輸入電子郵件..." required>
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
                <div class="col-md-4" style="text-align: left; padding-left: 50px;">
                    <a href="">隱私權政策</a>&nbsp;|&nbsp;<a href="">使用條款</a>
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