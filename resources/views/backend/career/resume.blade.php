@extends('backend.admin')

@section('custom-js-script')
<script src="{{ asset('js/backend/resume-list.js') }}"></script>
@endsection

@section('panel-content')
<div class="row" id="resume-list">
    <div class="col-md-12">
        <resume-list careerid="{{$id}}"></resume-list>
    </div>
</div>
@endsection
