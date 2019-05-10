@extends('backend.admin')

@section('custom-js-script')
<script src="{{ asset('js/backend/subscribe-list.js') }}"></script>
@endsection

@section('panel-content')
<div class="row" id="subscribe-list">
    <div class="col-md-12">
        <subscribe-list></subscribe-list>
    </div>
</div>
@endsection
