@extends('backend.admin')

@section('custom-js-script')
<script src="/js/backend/{{$source}}.js" charset="utf-8"></script>
@endsection

@section('panel-content')
<div style="clear: both"></div>
<div class="row ch-product-form" id="{{$source}}">
    <div class="col-md-12" style="width: 100%">
        <{{$source}}></{{$source}}>
    </div>
</div>
@endsection
