@extends('backend.admin')

@section('custom-js-script')
    <script src="{{ asset('js/backend/banner-managment.js') }}"></script>
@endsection

@section('panel-content')
    <div class="row ch-post-form" id="banner-managment">
        <div class="col-md-12">
            <banner-managment></banner-managment>
        </div>
    </div>
@endsection
