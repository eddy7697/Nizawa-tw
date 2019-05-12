@extends('main')

@section('content')
<div class="mg-site-thumbnail">
    <div class="container">
        <div class="col-md-12">
            <a href="/">{{ trans('string.home') }}</a>
            &nbsp;&nbsp;<a>></a>&nbsp;&nbsp;
            {{ trans('string.notice') }}
        </div>
    </div>
</div>
<div class="container" style="margin-bottom: 30px">
    <div class="row">
        <div class="col-md-10 mx-auto member-auth-form-table">
            {!!json_decode(SiteMetaView::ecPrivacy(), true)[App::getLocale()]!!}

        </div>
    </div>
</div>

@endsection
