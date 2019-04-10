@extends('layouts.app')

@section('custom-js-script')	
	@yield('custom-js-script')
@endsection
@section('custom-style-section')
	@yield('custom-style-section')
@endsection
@section('main-panel-script')
	<script>
		document.getElementById('center-btn').addEventListener('click', e => {
			document.getElementById('menu_toggle').click()
		})
	</script>
@endsection

@section('content')
<style media="screen">

</style>

<div class="container body">

        <div class="main_container">
            {{--  left start  --}}
			<div class="col-md-3 left_col menu_fixed mCustomScrollbar _mCS_1 mCS-autoHide" style="overflow: visible;">
				<button id="center-btn"><i class="fa fa-angle-left" aria-hidden="true"></i></button>
				<div id="mCSB_1" class="mCustomScrollBox mCS-minimal mCSB_vertical mCSB_outside" style="max-height: none;" tabindex="0">
					<div id="mCSB_1_container" class="mCSB_container" style="position:relative; top:0; left:0;" dir="ltr">
						<div class="left_col scroll-view">
							<div class="navbar nav_title" style="border: 0;">
								<a href="/cyberholic-system/admin" class="site_title">
									<img src="/img/LanuchCenter_v1.png" class="default" width="95%" alt="">
									<img src="/img/LanuchCenter_icon.png" class="mini" alt="">
								</a>
							</div>

							<div class="clearfix"></div>
			
							<br>
			
							<!-- sidebar menu -->
							<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
								<div class="menu_section active">
									<br> <br>
									<ul class="nav side-menu" style="">
										<li><a><i class="fa fa-tachometer"></i> 主控板 <span class="fa fa-chevron-down"></span></a>
											<ul class="nav child_menu" style="">
												<li><a href="/cyberholic-system/admin">後臺首頁</a></li>
												<li><a href="/cyberholic-system/admin/list">後台使用者列表</a></li>
												<li><a href="/cyberholic-system/admin/reset">重設密碼</a></li>
											</ul>
										</li>
										<li class=""><a><i class="fa fa-globe" aria-hidden="true"></i>網站資訊管理系統 <span class="fa fa-chevron-down"></span></a>
											<ul class="nav child_menu" style="display: none;">
												<li><a href="/cyberholic-system/page/managment">網站資訊</a></li>
												<li><a href="/cyberholic-system/page/banner">首頁輪播</a></li>
											</ul>
										</li>
										<li class=""><a><i class="fa fa-file-text-o"></i>頁面管理系統 <span class="fa fa-chevron-down"></span></a>
											<ul class="nav child_menu" style="display: none;">												
												@if (false)
													<li><a href="/cyberholic-system/page/add">新增頁面</a></li>
												@endif
												<li><a href="/cyberholic-system/page/list">頁面列表</a></li>
												<li><a href="/cyberholic-system/page/block">區塊列表</a></li>
												<li><a href="/cyberholic-system/meta/notice">購物須知管理</a></li>
												<li><a href="/cyberholic-system/meta/privacy">隱私權政策管理</a></li>
												<li><a href="/cyberholic-system/meta/remind">安心購物宣言管理</a></li>
												<li><a href="/cyberholic-system/meta/other">其他資訊管理</a></li>
											</ul>
										</li>
										<li class=""><a><i class="fa fa-users"></i> 會員管理系統 <span class="fa fa-chevron-down"></span></a>
											<ul class="nav child_menu" style="display: none;">
												<li><a href="/cyberholic-system/account/list">會員資料列表</a></li>
											</ul>
										</li>
										<li class=""><a><i class="fa fa-pencil-square-o"></i> 最新消息管理系統 <span class="fa fa-chevron-down"></span></a>
											<ul class="nav child_menu" style="display: none;">
												<li><a href="/cyberholic-system/post/add">新增最新消息</a></li>
												<li><a href="/cyberholic-system/post/list">最新消息列表</a></li>
												<li><a href="/cyberholic-system/post/category">最新消息類別管理</a></li>
											</ul>
										</li>
										<li><a><i class="fa fa-picture-o"></i> 媒體與檔案 <span class="fa fa-chevron-down"></span></a>
											<ul class="nav child_menu" style="">
												<li><a href="/cyberholic-system/media/manager?type=Images">媒體庫</a></li>
											</ul>
										</li>
										<li><a><i class="fa fa-shopping-cart"></i> 電商管理系統 <span class="fa fa-chevron-down"></span></a>
											<ul class="nav child_menu" style="">
												<li><a href="/cyberholic-system/product/add">新增銷售商品</a></li>
												<li><a href="/cyberholic-system/product/list">商品列表</a></li>
												<li><a href="/cyberholic-system/product/category">商品類別管理</a></li>
											</ul>
										</li>
										@if (false)
											<li class=""><a><i class="fa fa-briefcase"></i> 商務邏輯管理 <span class="fa fa-chevron-down"></span></a>
												<ul class="nav child_menu" style="display: none;">
													<li><a href="/cyberholic-system/business/bonus">紅利系統設定</a></li>
													<li><a href="/cyberholic-system/business/addCoupon">新增優惠券</a></li>
													<li><a href="/cyberholic-system/business/coupon">優惠券管理</a></li>
												</ul>
											</li>
										@endif										
										<li class=""><a><i class="fa fa-shopping-basket"></i> 訂單管理系統 <span class="fa fa-chevron-down"></span></a>
											<ul class="nav child_menu" style="display: none;">
												<li><a href="/cyberholic-system/order/list">訂單資料查詢</a></li>
												@if (true)
													<li><a href="/cyberholic-system/order/shipping-method">運費規格設定</a></li>
												@endif
											</ul>
										</li>
										
									</ul>
								</div>
			
							</div>
							<!-- /sidebar menu -->
			
							<!-- /menu footer buttons -->
							<div class="sidebar-footer hidden-small" style="font-size: 12px; padding: 5px 10px">
								版本編號：v 1.2.0 b <br>釋出日期：2018/07/11
							</div>
							@if (false)
								<div class="sidebar-footer hidden-small">
									<a data-toggle="tooltip" data-placement="top" title="" data-original-title="Settings">
										<span class="glyphicon glyphicon-cog" aria-hidden="true" style="opacity: 0"></span>
									</a>
									<a data-toggle="tooltip" data-placement="top" title="" data-original-title="FullScreen">
										<span class="glyphicon glyphicon-fullscreen" aria-hidden="true" style="opacity: 0"></span>
									</a>
									<a data-toggle="tooltip" data-placement="top" title="" data-original-title="Lock">
										<span class="glyphicon glyphicon-eye-close" aria-hidden="true" style="opacity: 0"></span>
									</a>
									<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
											<i class="fa fa-sign-out pull-right"></i> Log Out
										</a>
									<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
										<span class="glyphicon glyphicon-off" aria-hidden="true"></span>
									</a>
								</div>
							@endif
							
							<!-- /menu footer buttons -->
						</div>
					</div>
				</div>
				<div id="mCSB_1_scrollbar_vertical" class="mCSB_scrollTools mCSB_1_scrollbar mCS-minimal mCSB_scrollTools_vertical" style="display: block;">
					<div class="mCSB_draggerContainer">
						<div id="mCSB_1_dragger_vertical" class="mCSB_dragger" style="position: absolute; min-height: 50px; height: 838px; top: 0px; display: block; max-height: 891px;" oncontextmenu="return false;">
							<div class="mCSB_dragger_bar" style="line-height: 50px;"></div>
						</div>
						<div class="mCSB_draggerRail"></div>
					</div>
				</div>
			</div>

			{{--  left end  --}}
			
			{{--  right start  --}}

			<div class="top_nav">
				<div class="nav_menu">
					<nav>
						<div class="nav toggle">
							<a id="menu_toggle"><i class="fa fa-bars"></i></a>
						</div>

						<ul class="nav navbar-nav navbar-right">
							<li class="">
								<a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
									{{ Auth::user()->name }}
									<span class=" fa fa-angle-down"></span>
								</a>
								<ul class="dropdown-menu dropdown-usermenu pull-right">
									<li>
										<a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
											<i class="fa fa-sign-out pull-right"></i> Log Out
                                        </a>
										<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
											{{ csrf_field() }}
										</form>
									</li>
								</ul>
							</li>

						</ul>
					</nav>
				</div>
			</div>
			<!-- /top navigation -->
				
				<!-- page content -->
				<div class="right_col" role="main">
					<div class="">
						<div class="page-title">
							<div class="title_left">
								<h3>{{ $panelTitle }}</h3>
							</div>
						</div>
						@yield('panel-content')
					</div>
				</div>
				<!-- /page content -->
				
				<!-- footer content -->
				<footer>
					<div style="text-align: right">
						Lunch Center - CyberHolic</a>
					</div>
					<div class="clearfix"></div>
				</footer>


			{{--  right end  --}}
        </div>

    </div>
@yield('script')
@yield('style')
@endsection
