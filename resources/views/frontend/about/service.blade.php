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
        <h2>售後服務</h2>
        <h4>After-sales Services</h4>
        <hr>
        <h5>歡迎您選用日澤化工系列服務，您可於本頁面查詢任何您所需要的售後支援</h5>
    </div>
</div>
<div class="mg-site-thumbnail">
    <div class="container">
        <div class="col-md-12">
            <a href="/">首頁</a>
            &nbsp;&nbsp;<a>></a>&nbsp;&nbsp;
            <a>服務支持</a>
            &nbsp;&nbsp;<a>></a>&nbsp;&nbsp;
            售後服務
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12 about-content">
            <h3 class="about-section-title">準確、可靠 - 日澤的專業售後服務</h3>
            <div class="about-text">
                <p>日澤作為水質與食安檢測儀器的高端企業，不僅提供高質量的儀器，同時還提供專業、可靠的售後服務和技術支持。目前，日澤於國內有數個售後服務據點，數名技術專業、經驗豐富的售後服務工程師。同時利用全面、先進的檢測工具，依拖高效的專家系統，秉持客戶至上的服務理念，為廣大客戶提供方便與高效的服務。</p>
            </div>
        </div>
        <div class="col-md-12 about-content">
            <h3 class="about-section-title">給客戶帶來的價值</h3>
            <div class="about-text">
                <table class="service-table">
                    <tr>
                        <td colspan="2">
                            服務類型合約
                        </td>
                        <td class="sn-number">
                            #
                        </td>
                        <td>
                            服務合約價值
                        </td>
                    </tr>
                    <tr>
                        <td rowspan="10">
                            <div class="fake-border"></div>
                            售後服務方案
                        </td>
                        <td rowspan="6">
                            <div class="fake-border"></div>
                            基礎保養校準服務
                        </td>
                        <td class="sn-number">1</td>
                        <td>完整的教育訓練，專業指導產品應用</td>
                    </tr>
                    <tr>
                        <td class="sn-number">2</td>
                        <td>被動性升級為預防性，更低的儀器生命週期成本</td>
                    </tr>
                    <tr>
                        <td class="sn-number">3</td>
                        <td>儀器生命週期更常，更低的儀器生命週期成本</td>
                    </tr>
                    <tr>
                        <td class="sn-number">4</td>
                        <td>減少故障次數和維修時間，降低故障時間</td>
                    </tr>
                    <tr>
                        <td class="sn-number">5</td>
                        <td>延長正常使用時間和故障間隔時間</td>
                    </tr>
                    <tr>
                        <td class="sn-number">6</td>
                        <td>制定預防性保養計畫</td>
                    </tr>
                    <tr>
                        <td rowspan="4">卓越獨享服務</td>
                        <td class="sn-number">1</td>
                        <td>完整的教育訓練，專業指導產品應用</td>
                    </tr>
                    <tr>
                        <td class="sn-number">2</td>
                        <td>預防性升級為預測性，合約期內服務預算固定</td>
                    </tr>
                    <tr>
                        <td class="sn-number">3</td>
                        <td>享受原廠多級專家團隊技術支持</td>
                    </tr>
                    <tr>
                        <td class="sn-number">4</td>
                        <td>根據客戶應用情況優化預防性保養計畫</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="col-md-12 about-content">
            <h3 class="about-section-title">相關文件下載</h3>
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
