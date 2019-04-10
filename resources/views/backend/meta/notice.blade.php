@extends('backend.admin')

@section('custom-js-script')
    <script src="{{ asset('js/backend/notice.js') }}"></script>
@endsection

@section('panel-content')
    <div class="row ch-post-form" id="notice">
        <div class="col-md-12">
            <notice></notice>
        </div>
    </div>
@endsection
