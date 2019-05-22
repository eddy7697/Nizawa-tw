@foreach (PageView::industry($id) as $industry)
    <div class="col-md-2 mx-auto">
        @php
            $str = $industry->title->{App::getLocale()};
            $accordionId = 'id-'.rand(1111111, 9999999);
        @endphp
        
        <h3>{{$str}}</h3>
        <hr>
        
        <div class="collapse-container" id="{{$accordionId}}">
            @foreach ($industry->flow as $key => $item)
                <div class="card">
                    <div class="card-header">
                        <a class="card-link" data-toggle="collapse" href="#collapseOne-{{$accordionId}}-{{$key}}">
                            @php
                                $title = $item->title->{App::getLocale()};
                            @endphp
                            <i class="fa fa-caret-down"></i>&nbsp;&nbsp;&nbsp;{{$title}}
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

        {{-- @include('components.industryMap', ['data' => $item->flow])                         --}}
    </div>
@endforeach