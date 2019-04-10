@extends('backend.admin')

@section('custom-js-script')
<script src="{{ asset('js/backend/coupon-add.js') }}"></script>
@endsection

@section('panel-content')
<div class="row" id="coupon-add">
    <div class="col-md-12">
        <input type="hidden" class="mode" name="" value="{{$mode}}">
        @if ($mode == 'edit')
            <input type="hidden" class="guid" name="" value="{{$guid}}">
        @endif
        <coupon-add></coupon-add>
    </div>
</div>
@endsection
