@extends('main')

@php
    function formatSizeUnits($bytes)
        {
            if ($bytes >= 1073741824)
            {
                $bytes = number_format($bytes / 1073741824, 2) . ' GB';
            }
            elseif ($bytes >= 1048576)
            {
                $bytes = number_format($bytes / 1048576, 2) . ' MB';
            }
            elseif ($bytes >= 1024)
            {
                $bytes = number_format($bytes / 1024, 2) . ' KB';
            }
            elseif ($bytes > 1)
            {
                $bytes = $bytes . ' bytes';
            }
            elseif ($bytes == 1)
            {
                $bytes = $bytes . ' byte';
            }
            else
            {
                $bytes = '0 bytes';
            }

            return $bytes;
        }
    
    function parseType($str)
    {
        $typeString = '';
        switch ($str) {
            case 'application/vnd.openxmlformats-officedocument.wordprocessingml.document':
                $typeString = '<span><i class="fa fa-file-word-o" aria-hidden="true"></i></span>';
                break;
            case 'application/vnd.ms-excel':
                $typeString = '<span><i class="fa fa-file-excel-o" aria-hidden="true"></i></span>';
                break;
            case 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet':
                $typeString = '<span><i class="fa fa-file-excel-o" aria-hidden="true"></i></span>';
                break;
            case 'application/pdf':
                $typeString = '<span><i class="fa fa-file-pdf-o" aria-hidden="true"></i></span>';
                break;
            case 'application/msword':
                $typeString = '<span><i class="fa fa-file-word-o" aria-hidden="true"></i></span>';
                break;
            default:
                $typeString = '<span></span>';
                break;
        }

        return $typeString;
    }
@endphp

@section('custom-script')
@endsection

@section('custom-style')
<style>
.fa-file-word-o {
    color: #3F79E8;
    font-size: 18px;
}
.fa-file-excel-o {
    color: #3FBF50;
    font-size: 18px;
}
.fa-file-pdf-o {
    color: #FF5576;
    font-size: 18px;
}
</style>
@endsection

@section('content')
<div class="sub-page-banner" style="background-image: url('/img/sub-banner.jpg');">
    <div>
        <h2>{{ trans('string.support') }}</h2>
        @if (App::getLocale() !== 'en')
            <h4>Service</h4>
        @endif
        <hr>
        <h5>{{ trans('string.service_overview_banner_desc') }}</h5>
    </div>
</div>
<div class="mg-site-thumbnail">
    <div class="container">
        <div class="col-md-12">
            <a href="/">{{ trans('string.home') }}</a>
            &nbsp;&nbsp;<a>></a>&nbsp;&nbsp;
            <a>{{ trans('string.support') }}</a>
            &nbsp;&nbsp;<a>></a>&nbsp;&nbsp;
            {{ trans('string.service') }}
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12 about-content">
            <h3 class="about-section-title">{{ trans('service.service_title_1') }}</h3>
            <div class="about-text">
                <p>{{ trans('service.service_desc_1') }}</p>
            </div>
        </div>
        <div class="col-md-12 about-content">
            <h3 class="about-section-title">{{ trans('service.service_title_2') }}</h3>
            <div class="about-text">
                <table class="service-table">
                    <tr>
                        <td colspan="2">
                            {{ trans('service.service_1') }}
                        </td>
                        <td class="sn-number">
                            #
                        </td>
                        <td>
                            {{ trans('service.service_2') }}
                        </td>
                    </tr>
                    <tr>
                        <td rowspan="10">
                            <div class="fake-border"></div>
                            {{ trans('service.service_3') }}
                        </td>
                        <td rowspan="6">
                            <div class="fake-border"></div>
                            {{ trans('service.service_4') }}
                        </td>
                        <td class="sn-number">1</td>
                        <td>{{ trans('service.service_5') }}</td>
                    </tr>
                    <tr>
                        <td class="sn-number">2</td>
                        <td>{{ trans('service.service_6') }}</td>
                    </tr>
                    <tr>
                        <td class="sn-number">3</td>
                        <td>{{ trans('service.service_7') }}</td>
                    </tr>
                    <tr>
                        <td class="sn-number">4</td>
                        <td>{{ trans('service.service_8') }}</td>
                    </tr>
                    <tr>
                        <td class="sn-number">5</td>
                        <td>{{ trans('service.service_9') }}</td>
                    </tr>
                    <tr>
                        <td class="sn-number">6</td>
                        <td>{{ trans('service.service_10') }}</td>
                    </tr>
                    <tr>
                        <td rowspan="4">{{ trans('service.service_11') }}</td>
                        <td class="sn-number">1</td>
                        <td>{{ trans('service.service_12') }}</td>
                    </tr>
                    <tr>
                        <td class="sn-number">2</td>
                        <td>{{ trans('service.service_13') }}</td>
                    </tr>
                    <tr>
                        <td class="sn-number">3</td>
                        <td>{{ trans('service.service_14') }}</td>
                    </tr>
                    <tr>
                        <td class="sn-number">4</td>
                        <td>{{ trans('service.service_15') }}</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="col-md-12 about-content">
            <h3 class="about-section-title">{{ trans('service.service_16') }}</h3>
            <ul class="support-download">
                @foreach (PageView::downloadAll() as $key => $item)
                    @php
                        $title = json_decode($item->title, true)[App::getLocale()];
                        $content = json_decode($item->content, true)[App::getLocale()];
                        $filesize = formatSizeUnits(filesize(public_path($content)));
                        $filestat = basename(public_path($content));
                        $type = mime_content_type(public_path($content));
                        $typeString = parseType($type);
                    @endphp
                    <li><a href="{{$content}}">{!!$typeString!!}&nbsp;&nbsp;{{$filestat}}&nbsp;&nbsp;{{$filesize}}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection
