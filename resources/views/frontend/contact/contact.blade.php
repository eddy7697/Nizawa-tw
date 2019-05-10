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
        <h2>聯絡我們</h2>
        <h4>Contact Us</h4>
        <hr>
        <h5>歡迎您透過連絡表單填寫與我們聯絡，我們將盡速回復給您</h5>
    </div>
</div>
<div class="mg-site-thumbnail">
    <div class="container">
        <div class="col-md-12">
            <a href="/">首頁</a>
            &nbsp;&nbsp;<a>></a>&nbsp;&nbsp;
            聯絡我們
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-9 mx-auto site-contact-container">
            <form action="{{route('sendForm')}}" method="POST">
                {{ csrf_field() }}
                <div class="col-md-11 mx-auto contact-form-header">
                    <h1>聯絡我們</h1>
                    <hr>
                    <p>請詳細填寫您的資訊及疑問，以便我們精準為您回覆，非常感謝您。</p>
                </div>
                <div class="col-md-10 mx-auto contact-form-body">
                    <div class="row">
                        <div class="col-md-4 column important">
                            <p>姓名</p>
                        </div>
                        <div class="col-md-8 column">
                            <input class="form-control" type="text" name="name" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 column important">
                            <p>性別</p>
                        </div>
                        <div class="col-md-8 column">
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="gender" value="男" required>男
                                </label>
                            </div>
                            <div class="form-check-inline">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="gender" value="女" required>女
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 column important">
                            <p>電子郵箱</p>
                        </div>
                        <div class="col-md-8 column">
                            <input class="form-control" type="email" name="email" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 column important">
                            <p>連絡電話</p>
                        </div>
                        <div class="col-md-8 column">
                            <input class="form-control" type="phone" name="phone" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 column">
                            <p>問題類型</p>
                        </div>
                        <div class="col-md-8 column">
                            <select name="type" class="form-control" required>
                                <option disabled>--請選擇問題類型--</option>
                                <option value="產品諮詢">產品諮詢</option>
                                <option value="詢價問題">詢價問題</option>
                                <option value="訂單問題">訂單問題</option>
                                <option value="服務支援">服務支援</option>
                                <option value="其他諮詢">其他諮詢</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 column important">
                            <p>詢問內容</p>
                            <p class="text">提醒您，若您填寫得越精準，越有利我們及時回覆給您資訊。</p>
                        </div>
                        <div class="col-md-8 column">
                            <textarea name="content" class="form-control content" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-md-10 mx-auto contact-form-footer">
                    <p class="info">我們不會將您輸入的任何個人資訊用於回答查詢以外的目的，您亦可<a href="">點選這裡</a>檢視更多關於日澤提供的隱私權保護政策。</p>
                    <p class="info">* 請您務必將日澤的電子郵箱地址或域名設定為可接收的電子郵箱，以免錯過我們的回覆，您亦可直接與我們聯絡，<a href="">(點選這裡檢視聯絡資訊)</a>。</p>
                    <div class="captcha-section">
                        <strong>確認碼</strong>
                        <img src="/captcha" id="captcha" alt="">
                        <a href="#" id="refresh-captcha">更新確認碼</a>
                        <input type="text" class="form-control captcha" name="captcha" placeholder="請輸入上方的確認碼..." required title="請輸入驗證碼">
                        @if ($errors->has('captcha_error'))
                            <span class="help-block">
                                <strong>驗證碼錯誤</strong>
                            </span>
                        @endif
                        <button class="submit-btn" type="submit">提交資訊</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
