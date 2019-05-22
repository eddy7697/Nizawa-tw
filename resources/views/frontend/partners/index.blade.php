@extends('frontend.partners.main')

@section('sub-script')
    <script src="https://api.map.baidu.com/api?key=&v=1.1&services=true"></script>
    <script src="/js/partner-map.js" charset="utf-8"></script>
@endsection

{{-- Google map api key --}}
{{-- AIzaSyBWGyWQEgeR_KqcgTOAuUaGe4BmmnclGzs --}}

@section('sub-content')
<div class="container-fluid">
    <div class="row" id="partner-map">
        <input type="hidden" id="partner_finder" name="" value="{!! trans('string.partner_finder') !!}">
        <input type="hidden" id="partner_finder_choose" name="" value="{!! trans('string.partner_finder_choose') !!}">
        <input type="hidden" id="partner_finder_country" name="" value="{!! trans('string.partner_finder_country') !!}">
        <div class="col-md-12">
            <partner-map locale="{{App::getLocale()}}"></partner-map>
        </div>
    </div>
</div>

    

@endsection
