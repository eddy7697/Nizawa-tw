@extends('backend.admin')

@section('custom-js-script')
<script src="{{ asset('js/backend/download-list.js') }}"></script>
@endsection

@section('panel-content')
<div class="row" id="download-list">
    <div class="col-md-12">
        <download-list></download-list>
    </div>
</div>
@endsection
