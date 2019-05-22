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
                $typeString = '<span><i class="fa fa-file-word-o" aria-hidden="true"></i>&nbsp;WORD</span>';
                break;
            case 'application/vnd.ms-excel':
                $typeString = '<span><i class="fa fa-file-excel-o" aria-hidden="true"></i>&nbsp;EXCEL</span>';
                break;
            case 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet':
                $typeString = '<span><i class="fa fa-file-excel-o" aria-hidden="true"></i>&nbsp;EXCEL</span>';
                break;
            case 'application/pdf':
                $typeString = '<span><i class="fa fa-file-pdf-o" aria-hidden="true"></i>&nbsp;PDF</span>';
                break;
            case 'application/msword':
                $typeString = '<span><i class="fa fa-file-word-o" aria-hidden="true"></i>&nbsp;WORD</span>';
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
@endsection

@section('content')
<div class="sub-page-banner" style="background-image: url('/img/sub-banner.jpg');">
    <div>
        <h2>{{ trans('string.download') }}</h2>
        @if (App::getLocale() !== 'en')
        <h4>Data Download</h4>    
        @endif
        <hr>
        <h5>{{ trans('string.download_banner_desc') }}</h5>
    </div>
</div>
<div class="mg-site-thumbnail">
    <div class="container">
        <div class="col-md-12">
            <a href="/">{{ trans('string.home') }}</a>
            &nbsp;&nbsp;<a>></a>&nbsp;&nbsp;
            <a>{{ trans('string.support') }}</a>
            &nbsp;&nbsp;<a>></a>&nbsp;&nbsp;
            {{ trans('string.download') }}
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12 about-content">
            <h3 class="about-section-title">{{ trans('string.download_area') }}</h3>
        </div>
        <div class="col-md-11 mx-auto download-container">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs download-tabs">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#home"><i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp;&nbsp;{{ trans('string.product_menu') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#menu1"><i class="fa fa-id-card-o" aria-hidden="true"></i>&nbsp;&nbsp;{{ trans('string.file_download') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#menu2"><i class="fa fa-files-o" aria-hidden="true"></i>&nbsp;&nbsp;{{ trans('string.download_license') }}</a>
                </li>
            </ul>
            
            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active" id="home">
                    <table class="table download-table">
                        <thead>
                            <tr>
                                <th style="width: 60px;">{{ trans('string.download_sharp') }}</th>
                                <th style="text-align: left">{{ trans('string.download_file_name') }}</th>
                                <th style="width: 100px;">{{ trans('string.download_file_type') }}</th>
                                <th style="width: 150px;">{{ trans('string.download_file_size') }}</th>
                                <th style="width: 150px;">{{ trans('string.download_link') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count(PageView::download('產品目錄')) < 1)
                                <tr>
                                    <td colspan="5">{{ trans('string.download_no_data') }}</td>
                                </tr>
                            @endif
                            @foreach (PageView::download('產品目錄') as $key => $item)
                                @php
                                    $title = json_decode($item->title, true)[App::getLocale()];
                                    $content = json_decode($item->content, true)[App::getLocale()];
                                    $filesize = formatSizeUnits(filesize(public_path($content)));
                                    $type = mime_content_type(public_path($content));
                                    $typeString = parseType($type);
                                @endphp
                                <tr>
                                    <td>{{$key + 1}}</td>
                                    <td style="text-align: left">{{$title}}</td>
                                    <td style="text-align: left">{!!$typeString!!}</td>
                                    <td>{{$filesize}}</td>
                                    <td><a class="btn site-btn" href="{{$content}}"><i class="fa fa-download" aria-hidden="true"></i>&nbsp;{{ trans('string.download_get_file') }}</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="tab-pane fade" id="menu1">
                    <table class="table download-table">
                        <thead>
                            <tr>
                                <th style="width: 60px;">{{ trans('string.download_sharp') }}</th>
                                <th style="text-align: left">{{ trans('string.download_file_name') }}</th>
                                <th style="width: 100px;">{{ trans('string.download_file_type') }}</th>
                                <th style="width: 150px;">{{ trans('string.download_file_size') }}</th>
                                <th style="width: 150px;">{{ trans('string.download_link') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count(PageView::download('文件下載')) < 1)
                                <tr>
                                    <td colspan="5">{{ trans('string.download_no_data') }}</td>
                                </tr>
                            @endif
                            @foreach (PageView::download('文件下載') as $key => $item)
                                @php
                                    $title = json_decode($item->title, true)[App::getLocale()];
                                    $content = json_decode($item->content, true)[App::getLocale()];
                                    $filesize = formatSizeUnits(filesize(public_path($content)));
                                    $type = mime_content_type(public_path($content));
                                    $typeString = parseType($type);
                                @endphp
                                <tr>
                                    <td>{{$key + 1}}</td>
                                    <td style="text-align: left">{{$title}}</td>
                                    <td style="text-align: left">{!!$typeString!!}</td>
                                    <td>{{$filesize}}</td>
                                    <td><a class="btn site-btn" href="{{$content}}"><i class="fa fa-download" aria-hidden="true"></i>&nbsp;{{ trans('string.download_get_file') }}</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="menu2">
                    <table class="table download-table">
                        <thead>
                            <tr>
                                <th style="width: 60px;">{{ trans('string.download_sharp') }}</th>
                                <th style="text-align: left">{{ trans('string.download_file_name') }}</th>
                                <th style="width: 100px;">{{ trans('string.download_file_type') }}</th>
                                <th style="width: 150px;">{{ trans('string.download_file_size') }}</th>
                                <th style="width: 150px;">{{ trans('string.download_link') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count(PageView::download('資質證明')) < 1)
                                <tr>
                                    <td colspan="5">{{ trans('string.download_no_data') }}</td>
                                </tr>
                            @endif
                            @foreach (PageView::download('資質證明') as $key => $item)
                                @php
                                    $title = json_decode($item->title, true)[App::getLocale()];
                                    $content = json_decode($item->content, true)[App::getLocale()];
                                    $filesize = formatSizeUnits(filesize(public_path($content)));
                                    $type = mime_content_type(public_path($content));
                                    $typeString = parseType($type);
                                @endphp
                                <tr>
                                    <td>{{$key + 1}}</td>
                                    <td style="text-align: left">{{$title}}</td>
                                    <td style="text-align: left">{!!$typeString!!}</td>
                                    <td>{{$filesize}}</td>
                                    <td><a class="btn site-btn" href="{{$content}}"><i class="fa fa-download" aria-hidden="true"></i>&nbsp;{{ trans('string.download_get_file') }}</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
