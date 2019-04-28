@extends('backend.admin')

@section('custom-js-script')
<script src="{{ asset('js/backend/qa-list.js') }}"></script>
@endsection

@section('panel-content')
<div class="row" id="qa-list">
    <div class="col-md-12">
        <qa-list></qa-list>
    </div>
</div>
@endsection
