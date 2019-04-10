@extends('backend.admin')

@section('custom-js-script')
    <script src="{{ asset('js/backend/privacy.js') }}"></script>
@endsection

@section('panel-content')
    <div class="row ch-post-form" id="privacy">
        <div class="col-md-12">
            <privacy></privacy>
        </div>
    </div>
@endsection
