@extends('backend.admin')

@section('custom-js-script')
<script src="{{ asset('js/backend/career-list.js') }}"></script>
@endsection

@section('panel-content')
<div class="row" id="career-list">
    <div class="col-md-12">
        <career-list></career-list>
    </div>
</div>
@endsection
