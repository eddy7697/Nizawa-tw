@extends('backend.admin')

@section('custom-js-script')
<script src="{{ asset('js/backend/add-industry.js') }}"></script>
@endsection

@section('panel-content')
<div class="row" id="add-industry">
    <div class="col-md-12">
        @if ($mode == 'add')
            <add-industry editmode="add"></add-industry>
        @else
            <add-industry editmode="edit" id="{{$id}}"></add-industry>
        @endif
        
    </div>
</div>
@endsection
