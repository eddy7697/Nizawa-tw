@extends('main')

@section('content')
    <div class="container mg-site-thumbnail">
        <div class="col-md-12">
            <a href="/">首頁</a>
            &nbsp;&nbsp;>&nbsp;&nbsp;
            隱私權聲明
        </div>
    </div>
    <div class="container" style="margin-bottom: 30px">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 member-auth-form-table">

                {!!SiteMetaView::ecPrivacy()!!}

            </div>
        </div>
    </div>

@endsection
