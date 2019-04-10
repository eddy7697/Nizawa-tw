@extends('main')

@section('custom-script')
    <script src="{{ asset('js/plugins/jquery.fancytree/dist/jquery.fancytree-all.min.js') }}"></script>
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
<div class="sub-page-banner" style="background-image: url('/img/banner-2-1.jpg');">
    <div>
        <h2>联系我们</h2>
        <h4>Contact Us</h4>
        <hr>
        <h5>欢迎您透过连络表单填写与我们联系，我们将尽速回复给您</h5>
    </div>
</div>
<div class="mg-site-thumbnail">
    <div class="container">
        <div class="col-md-12">
            <a href="/">首页</a>
            &nbsp;&nbsp;<i class="fa fa-chevron-right" aria-hidden="true"></i>&nbsp;&nbsp;
            联系我们
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-9 mx-auto site-contact-container">
            <form action="">
                <div class="col-md-11 mx-auto contact-form-header">
                    <h1>联系我们</h1>
                    <hr>
                    <p>请详细填写您的信息及疑问，以便我们精准为您回复，非常感谢您。</p>
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
                            <p>性别</p>
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
                            <p>电子邮箱</p>
                        </div>
                        <div class="col-md-8 column">
                            <input class="form-control" type="email" name="email" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 column important">
                            <p>连络电话</p>
                        </div>
                        <div class="col-md-8 column">
                            <input class="form-control" type="phone" name="phone" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 column">
                            <p>问题类型</p>
                        </div>
                        <div class="col-md-8 column">
                            <select name="type" class="form-control">
                                <option value="问题类型 1">问题类型 1</option>
                                <option value="问题类型 2">问题类型 2</option>
                                <option value="问题类型 3">问题类型 3</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 column important">
                            <p>询问内容</p>
                            <p class="text">提醒您，若您填写得越精准，越有利我们及时回复给您信息。</p>
                        </div>
                        <div class="col-md-8 column">
                            <textarea name="content" class="form-control content" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-md-10 mx-auto contact-form-footer">
                    <p class="info">我们不会将您输入的任何个人信息用于回答查找以外的目的，您亦可<a href="">点击这里</a>查看更多关于天壬提供的隐私权保护政策。</p>
                    <p class="info">* 请您务必将天壬的电子邮箱地址或域名设置为可接收的电子邮箱，以免错过我们的回复，您亦可直接与我们联系，<a href="">(点击这里查看联系信息)</a>。</p>
                    <div class="captcha-section">
                        <strong>確認碼</strong>
                        <img src="/captcha" id="captcha" alt="">
                        <a href="#" id="refresh-captcha">更新确认码</a>
                        <input type="text" class="form-control captcha" name="captcha" placeholder="請輸入上方的確認碼..." required title="請輸入驗證碼">
                        <button class="submit-btn" type="submit">提交信息</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
