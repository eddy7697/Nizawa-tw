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
    <div class="container mg-site-thumbnail">
        <div class="col-md-12">
            <a href="/">首頁</a>
            &nbsp;&nbsp;>&nbsp;&nbsp;
            購物須知
        </div>
    </div>
    <div class="container" style="margin-bottom: 30px">
        <div class="row">
            {!!SiteMetaView::ecNotice()!!}
        </div>
    </div>

@endsection
