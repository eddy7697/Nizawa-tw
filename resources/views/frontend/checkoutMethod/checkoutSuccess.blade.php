@extends('main')

@section('custom-script')
@endsection

@section('content')
    <div class="container mg-business">
        <div class="row">
            <div class="col-md-12 checkout-thumbnail">
                <ul>
                    <li>
                        <img src="https://nizawa.shuo-guo.net/img/icon/cart-01.svg" alt="">
                        &nbsp;&nbsp;
                        <i class="fa fa-caret-down arrow-icon" aria-hidden="true"></i>
                        &nbsp;&nbsp;
                        {{ trans('cart.inquery_car') }}
                    </li>
                    <li>
                        <img src="https://nizawa.shuo-guo.net/img/icon/cart-02.svg" alt="">
                        &nbsp;&nbsp;
                        <i class="fa fa-caret-down arrow-icon" aria-hidden="true"></i>
                        &nbsp;&nbsp;
                        {{ trans('cart.contact_info') }}
                    </li>
                    <li class="active">
                        <img src="https://nizawa.shuo-guo.net/img/icon/cart-03.svg" alt="">
                        &nbsp;&nbsp;
                        <i class="fa fa-caret-down arrow-icon" aria-hidden="true"></i>
                        &nbsp;&nbsp;
                        {{ trans('cart.complete_inquiry') }}
                    </li>
                </ul>
            </div>
            <div class="col-md-12 check-success" style="text-align: center">
                <h2>{{ trans('cart.complete_inquiry_desc_1') }}</h2>

                <div class="text">
                    {!! trans('cart.complete_inquiry_desc_2') !!}
                </div>
                <img src="https://nizawa.shuo-guo.net/img/site-logo/findmore.png" class="find-more" alt="">
                <br>
                <a class="find-more-btn" href="/product">{{ trans('string.learn_more_products') }}</a>
            </div>
        </div>
    </div>
@endsection
