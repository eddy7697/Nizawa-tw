@extends('backend.admin')

@section('custom-js-script')
    <script src="{{ asset('js/backend/other.js') }}"></script>
@endsection

@section('panel-content')
    <div class="row ch-post-form" id="other">
        <div class="col-md-12">
            <other></other>
        </div>
    </div>
@endsection
