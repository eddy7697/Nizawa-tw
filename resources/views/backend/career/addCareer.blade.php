@extends('backend.admin')

@section('custom-js-script')
<script src="{{ asset('js/backend/add-career.js') }}"></script>
@endsection

@section('panel-content')
<div class="row" id="add-career">
    <div class="col-md-12">
        @if ($mode == 'edit')
            <add-career mode="{{$mode}}" id="{{$id}}"></add-career>
        @else
            <add-career mode="{{$mode}}"></add-career>
        @endif
    </div>
</div>
@endsection
