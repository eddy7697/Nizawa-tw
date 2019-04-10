@extends('backend.admin')

@section('custom-js-script')
    <script src="{{ asset('js/backend/page-list.js') }}"></script>
@endsection

@section('panel-content')
    <div class="row ch-post-form" id="page-list">
        <div class="col-md-12">
        <page-list type="{{$type}}"></page-list>
        </div>
    </div>
@endsection
