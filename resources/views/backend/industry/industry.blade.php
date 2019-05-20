@extends('backend.admin')

@section('custom-js-script')
<script src="{{ asset('js/backend/industry-list.js') }}"></script>
@endsection

@section('panel-content')
<div class="row" id="industry-list">
    <div class="col-md-12">
        <industry-list></industry-list>
    </div>
</div>
@endsection
