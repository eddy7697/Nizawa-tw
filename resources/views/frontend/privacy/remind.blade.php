@extends('main')

@section('content')
    <div class="container mg-site-thumbnail">
        <div class="col-md-12">
            <a href="/">首頁</a>
            &nbsp;&nbsp;>&nbsp;&nbsp;
            安心購物宣言
        </div>
    </div>
    <div class="container" style="margin-bottom: 30px">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 member-auth-form-table">

                {!!SiteMetaView::ecRemind()!!}

            </div>
        </div>
    </div>

@endsection
