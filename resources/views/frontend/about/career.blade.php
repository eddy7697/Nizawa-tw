@extends('main')

@php
    use App\Career;
    $careers = Career::where('isShow', 1)->paginate(6);
@endphp

@section('custom-script')
<script>
    $('#resume-form').submit(function (e) {
        event.preventDefault();
        var data = new FormData();
        data.append('fullName', document.getElementsByName("fullName")[0].value);
        data.append('email', document.getElementsByName("email")[0].value);
        data.append('mobile', document.getElementsByName("mobile")[0].value);
        data.append('address', document.getElementsByName("address")[0].value);
        data.append('postalCode', document.getElementsByName("postalCode")[0].value);
        data.append('website', document.getElementsByName("website")[0].value);
        data.append('resumeFile', document.getElementById('resume-file').files[0]);

        axios.post('/resume/new/' + window.careerId, data)
            .then(function () {
                toastr.success('履歷投遞成功');
                $('#resumeModal').modal('hide');
            });

    });

    function openResumeModal(id) {
        window.careerId = id

        $('.loading-bar').show();
        axios.get('/career/get/' + id)
            .then(function (res) {
                console.log(res)
                $('#resumeModal').modal();
            }).catch(function (error) {
                
            }).then(function () {
                $('.loading-bar').hide();
            });
    }
</script>
@endsection

@section('custom-style')
@endsection

@section('content')
<div class="sub-page-banner" style="background-image: url('/img/sub-banner.jpg');">
    <div>
        <h2>{{ trans('string.recruiting') }}</h2>
        @if (App::getLocale() !== 'en')
            <h4>Recruiting</h4>
        @endif
        <hr>
        <h5>{{ trans('string.recruiting_banner') }}</h5>
    </div>
</div>
<div class="mg-site-thumbnail">
    <div class="container">
        <div class="col-md-12">
            <a href="/">{{ trans('string.home') }}</a>
            &nbsp;&nbsp;<a>></a>&nbsp;&nbsp;
            <a href="/">{{ trans('string.about') }}</a>
            &nbsp;&nbsp;<a>></a>&nbsp;&nbsp;
            {{ trans('string.recruiting') }}
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12 about-content">
            <h3 class="about-section-title">{{ trans('string.job_list') }}</h3>
            <div class="career-list">
                @foreach ($careers as $item)
                    <div class="career-item">
                        <div class="row">
                            <div class="col-md-10 career-info">
                                <h5>{{$item->title}}</h5>
                                <ul class="career-department">
                                    <li>{{ trans('string.recurit_department') }}：{{$item->department}}</li>
                                    <li>{{ trans('string.number_of_recruits') }}：{{$item->number}} 人</li>
                                </ul>
                                <ul class="career-location">
                                    <li>{{$item->location}}</li>
                                    @if (strlen($item->experience) == 0)
                                        <li>{{ trans('string.no_experience') }}</li>
                                    @else
                                        <li>{{$item->experience}}</li>
                                    @endif
                                    @if (strlen($item->education) == 0)
                                        <li>{{ trans('string.no_experience_qualifi') }}</li>
                                    @else
                                        <li>{{$item->education}}</li>
                                    @endif
                                </ul>
                                <hr>
                                <div class="career-content">
                                    {!!$item->description!!}
                                </div>
                                <hr>
                                <div class="career-pay">
                                    {{ trans('string.monthly_salary') }}：{{$item->paymentRange}} 元
                                </div>
                            </div>
                            <div class="col-md-2 action-group">
                                <div class="action-group-content">
                                    @if ($item->status)
                                        <a onclick="openResumeModal('{{$item->id}}')">
                                            <button class="btn btn-block btn-resume">我要應徵</button>
                                        </a>
                                    @else
                                        <button class="btn btn-block btn-resume off">暫不開放</button>
                                    @endif
                                    @if ($item->isTop)
                                        <span class="hot-tag">最火職缺</span>    
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                
            </div>
        </div>

        <div class="col-md-12">
            {{$careers}}
        </div>
        <div class="modal fade" id="resumeModal" data-backdrop="static">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">履歷投遞</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="resume-form">
                        <div class="modal-body site-contact-container resume">       
                            <div class="container-fluid contact-form-body"> 
                                <div class="row">
                                    <div class="col-md-4 column important">
                                        <p>姓名</p>
                                    </div>
                                    <div class="col-md-8 column">
                                        <input class="form-control" type="text" name="fullName" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 column important">
                                        <p>電子信箱</p>
                                    </div>
                                    <div class="col-md-8 column">
                                        <input class="form-control" type="email" name="email" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 column important">
                                        <p>行動電話</p>
                                    </div>
                                    <div class="col-md-8 column">
                                        <input class="form-control" type="text" name="mobile" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 column important">
                                        <p>地址</p>
                                    </div>
                                    <div class="col-md-8 column">
                                        <input class="form-control" type="text" name="address" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 column important">
                                        <p>郵遞區號</p>
                                    </div>
                                    <div class="col-md-8 column">
                                        <input class="form-control" type="text" name="postalCode" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 column ">
                                        <p>個人網址</p>
                                    </div>
                                    <div class="col-md-8 column">
                                        <input class="form-control" type="text" name="website" >
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 column important">
                                        <p>個人簡歷檔案</p>
                                    </div>
                                    <div class="col-md-8 column">
                                        <input type="file" name="resumeFile" id="resume-file" accept=".doc,.docx,.xls,.xlsx,.pdf" required>
                                    </div>
                                </div>
                            </div>                     
                            
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn" data-dismiss="modal">關閉視窗</button>
                            <button type="submit" class="btn btn-custom">投遞履歷</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
