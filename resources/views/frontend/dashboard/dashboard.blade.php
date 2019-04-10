@extends('main')

@section('content')
    <div class="container mg-site-thumbnail">
        <div class="col-md-12">
            <a href="/">首頁</a>
            &nbsp;&nbsp;>&nbsp;&nbsp;
            會員專區
        </div>
    </div>
    <div class="container mg-dashboard">
        <div class="row">
            <div class="col-md-3">
                <div class="center-hr">
                    <span>
                        我的帳戶
                    </span>
                </div>
                <ul class="dash-sidebar">
                    <li><a href="{{ url('/user') }}">我的訂單</a></li>
                    <li><a href="{{ url('/user/address') }}">聯絡資訊</a></li>
                    <li><a href="{{ url('/user/information') }}">會員資訊</a></li>
                    <li><a onclick="event.preventDefault(); document.getElementById('logout-form').submit();" href="#">帳號登出</a></li>
                </ul>
            </div>
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="pull-left">{{ $title }}</h3>
                        <ul class="dash-methods pull-right">
                            <li><a href="#" data-toggle="modal" data-target="#myModal-01">客服資訊</a></li>
                            <li><a href="#" data-toggle="modal" data-target="#myModal-02">運送資訊</a></li>
                            <li><a href="#" data-toggle="modal" data-target="#myModal-03">退換貨政策</a></li>
                        </ul>
                    </div>
                </div>
                <hr>

                {{-- 客服資訊 --}}
                <div class="modal fade" id="myModal-01" tabindex="-1" role="dialog" aria-labelledby="myModal-01Label">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            {{-- <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModal-01Label">客服資訊</h4>
                            </div> --}}
                            <div class="modal-body">
                                <h3 style="text-align:center">客服資訊</h3>

                                {!!SiteMetaView::noticeService()!!}

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-dismiss="modal">關閉視窗</button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- 運送資訊 --}}
                <div class="modal fade" id="myModal-02" tabindex="-1" role="dialog" aria-labelledby="myModal-02Label">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            {{-- <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModal-02Label">運送方式</h4>
                            </div> --}}
                            <div class="modal-body">
                                <h3 style="text-align:center">運送方式</h3>

                                <hr />
                                {!!SiteMetaView::noticeShipping()!!}


                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-dismiss="modal">關閉視窗</button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- 退換貨服務 --}}
                <div class="modal fade" id="myModal-03" tabindex="-1" role="dialog" aria-labelledby="myModal-03Label">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            {{-- <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModal-03Label">運送方式</h4>
                            </div> --}}
                            <div class="modal-body">
                                <h3 style="text-align:center">退換貨承諾</h3>

                                <hr />
                                {!!SiteMetaView::noticeReturn()!!}


                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-dismiss="modal">關閉視窗</button>
                            </div>
                        </div>
                    </div>
                </div>
                @yield('dashboard-content')
            </div>
        </div>
    </div>





@endsection
