@extends('backend.admin')

@section('custom-js-script')
    <script src="{{ asset('js/backend/remind.js') }}"></script>
@endsection

@section('panel-content')
    <div class="row ch-post-form" id="remind">
        <div class="col-md-12">
            <remind></remind>
        </div>
    </div>
@endsection
