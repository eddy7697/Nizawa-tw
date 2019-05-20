@extends('backend.admin')

@section('custom-js-script')
<script src="{{ asset('js/backend/add-industry.js') }}"></script>
@endsection

@section('panel-content')
<div class="row" id="add-industry">
    <div class="col-md-12">
        <add-industry></add-industry>
    </div>
</div>
@endsection
