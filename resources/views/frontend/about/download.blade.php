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
        <h2>資料下載</h2>
        <h4>File Download</h4>
        <hr>
        <h5>歡迎您透過本頁面下載各種產品目錄、檢測標準或相關文件</h5>
    </div>
</div>
<div class="mg-site-thumbnail">
    <div class="container">
        <div class="col-md-12">
            <a href="/">首頁</a>
            &nbsp;&nbsp;<a>></a>&nbsp;&nbsp;
            <a>服務支援</a>
            &nbsp;&nbsp;<a>></a>&nbsp;&nbsp;
            檔案下載
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12 about-content">
            <h3 class="about-section-title">資料下載專區</h3>
        </div>
        <div class="col-md-11 mx-auto download-container">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs download-tabs">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#home"><i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp;&nbsp;產品目錄</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#menu1"><i class="fa fa-id-card-o" aria-hidden="true"></i>&nbsp;&nbsp;文件下載</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#menu2"><i class="fa fa-files-o" aria-hidden="true"></i>&nbsp;&nbsp;資質證明</a>
                </li>
            </ul>
            
            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active" id="home">
                    <table class="table download-table">
                        <thead>
                            <tr>
                                <th style="width: 60px;">編號</th>
                                <th style="text-align: left">名稱</th>
                                <th style="width: 100px;">檔案類型</th>
                                <th style="width: 150px;">檔案大小</th>
                                <th style="width: 150px;">下載連結</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count(PageView::download('產品目錄')) < 1)
                                <tr>
                                    <td colspan="5">目前尚無資料</td>
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
                                    <td><a class="btn site-btn" href="{{$content}}"><i class="fa fa-download" aria-hidden="true"></i>&nbsp;下載檔案</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="tab-pane fade" id="menu1">
                    <table class="table download-table">
                        <thead>
                            <tr>
                                <th style="width: 60px;">編號</th>
                                <th style="text-align: left">名稱</th>
                                <th style="width: 100px;">檔案類型</th>
                                <th style="width: 150px;">檔案大小</th>
                                <th style="width: 150px;">下載連結</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count(PageView::download('文件下載')) < 1)
                                <tr>
                                    <td colspan="5">目前尚無資料</td>
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
                                    <td><a class="btn site-btn" href="{{$content}}"><i class="fa fa-download" aria-hidden="true"></i>&nbsp;下載檔案</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="menu2">
                    <table class="table download-table">
                        <thead>
                            <tr>
                                <th style="width: 60px;">編號</th>
                                <th style="text-align: left">名稱</th>
                                <th style="width: 100px;">檔案類型</th>
                                <th style="width: 150px;">檔案大小</th>
                                <th style="width: 150px;">下載連結</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count(PageView::download('資質證明')) < 1)
                                <tr>
                                    <td colspan="5">目前尚無資料</td>
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
                                    <td><a class="btn site-btn" href="{{$content}}"><i class="fa fa-download" aria-hidden="true"></i>&nbsp;下載檔案</a></td>
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
