@extends('backend.admin')

@section('custom-js-script')
<script src="{{ asset('js/backend/add-qa.js') }}"></script>
@endsection

@section('panel-content')
<div class="row" id="add-qa">
    <div class="col-md-12">
        @if ($mode == 'add')
            <add-qa></add-qa>    
        @else
            <add-qa qnaid="{{$id}}"></add-qa>
        @endif
        
    </div>
</div>
@endsection
