@php
    $accordionId = 'id-'.rand(1111111, 9999999);
@endphp

<div class="collapse-container" id="{{$accordionId}}">
    @foreach (json_decode(json_encode($data)) as $key => $item)
        <div class="card">
            <div class="card-header">
                <a class="card-link" data-toggle="collapse" href="#collapseOne-{{$accordionId}}-{{$key}}">
                    <i class="fa fa-caret-down"></i>&nbsp;&nbsp;&nbsp;{{$item->title}}
                </a>
            </div>
            <div id="collapseOne-{{$accordionId}}-{{$key}}" class="collapse" data-parent="#{{$accordionId}}">
                <div class="card-body">
                    <ul class="map-item">
                        @foreach ($item->product as $index => $elm)
                            <li><a href="/product-detail/{{$elm->id}}"><i class="fa fa-caret-down"></i>&nbsp;&nbsp;&nbsp;{{$elm->title}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endforeach
</div>