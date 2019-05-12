@extends('main')

@section('custom-script')
    <script src="{{ asset('js/plugins/jquery.fancytree/dist/jquery.fancytree-all.min.js') }}"></script>
    <script type="text/javascript">

        $(function () {
            $('.title_notice').css('border-bottom','solid 3px #616161')
        });

    </script>
@endsection

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
            {!!json_decode(SiteMetaView::ecNotice(), true)[App::getLocale()]!!}
        </div>
    </div>
</div>

@endsection
