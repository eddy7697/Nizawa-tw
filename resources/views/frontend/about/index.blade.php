@extends('main')

@section('custom-script')
@endsection

@section('custom-style')
@endsection

@section('content')
    <div class="sub-page-banner">
        <h2>關於科爾克</h2>
    </div>
    <div class="container mg-site-thumbnail">
        <div class="col-md-12">
            <a href="/">首頁</a>
            &nbsp;&nbsp;>&nbsp;&nbsp;
            關於易耕
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 about-content">
                {{-- {!!PageView::show(1)!!} --}}
            </div>
        </div>
    </div>
@endsection
