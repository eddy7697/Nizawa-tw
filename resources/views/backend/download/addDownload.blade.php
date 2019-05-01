@extends('backend.admin')

@section('custom-js-script')
<script src="{{ asset('js/backend/add-download.js') }}"></script>
@endsection

@section('panel-content')
<div class="row" id="add-download">
    <div class="col-md-12">
        @if ($mode == 'add')
            <add-download></add-download>    
        @else
            <add-download qnaid="{{$id}}"></add-download>
        @endif
        
    </div>
</div>
@endsection
