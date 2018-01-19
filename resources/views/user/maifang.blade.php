<!DOCTYPE html>
<html lang="zh-cn">
<head>
	<meta charset="UTF-8">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>我要买房</title>
	<link rel="stylesheet" type="text/css" href="/bower_components/amazeui/dist/css/amazeui.min.css">
	<link rel="stylesheet" type="text/css" href="/css/user/maifang.css">
</head>
<body>
	<div id="vueApp">
		<div class="head">
			<div class="nav">
				<div class="am-topbar">
					<div class="am-container">
						<h1 class="am-topbar-brand">
						    <a href="#1">Amaze UI</a>
						</h1>
						<button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-success am-show-sm-only" data-am-collapse="{target: '#my-nav'}">
							<span class="am-sr-only">导航切换</span> <span class="am-icon-bars"></span>
						</button>
						<div class="am-collapse am-topbar-collapse" id="my-nav">
							<ul class="am-nav am-nav-pills am-topbar-nav">
								<li><a href="">首页</a></li>
								<li><a href="">TEST</a></li>
								<li class=""><a href="">哩个</a></li>
							</ul>
							<div class="am-topbar-right">
								<ul class="am-nav am-nav-pills am-topbar-nav">
									<li class="am-dropdown" data-am-dropdown>
										<a href="#" class="am-dropdown-toggle">哩个<i class="am-icon-caret-down"></i></a>
										<ul class="am-dropdown-content">
											<li><a href="">首页</a></li>
											<li><a href="">个人信息</a></li>
											<li><a href="">我的委托</a></li>
											<li><a href="">交易记录</a></li>
											<li><a href="">登出</a></li>
										</ul>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="top">
				<div class="am-container">

				</div>
			</div>
		</div>
		<div class="am-container">
			<div class="formTable am-u-lg-8 am-u-sm-12">
				<form v-on:submit.prevent="add" class="am-md-text-center">
					<dl class='compact font-0 am-padding-vertical am-text-middle'>
						<dt class="am-inline-block am-text-center font-1">小区</dt>
						<dd class="am-inline-block font-1">
							<input class="input-border-hide am-u-lg-12" placeholder="请输入小区的名称，方便我们审核" type="text" v-model="row.community">
						</dd>
					</dl>
					<dl class='compact font-0 am-padding-vertical ' >
						<dt class="am-inline-block am-text-center am-text-middle font-1">房屋地址</dt>
						<dd class="am-inline-block font-1 am-g am-text-middle">
							<div class="am-u-sm-2 locationInput am-margin-horizontal-sm">
								<input placeholder="几" class="input-border-hide am-u-sm-6 am-text-right" type="text" v-model="row.building" class="border">
								<span class="am-u-sm-6 am-inline-block">
									<h3>号楼</h3>
								</span>
							</div>
							<div class="am-u-sm-2 locationInput am-margin-horizontal-sm">
								<input class="input-border-hide am-u-sm-6 am-text-right" placeholder="几" type="text" v-model="row.unit" class="border">
								<span class="am-u-sm-6 am-inline-block">
									<h3>单元</h3>
								</span>
							</div>
							<div class="am-u-sm-2 locationInput am-u-end am-margin-horizontal-sm">
								<input placeholder="1xxx" class="input-border-hide am-u-sm-6 am-text-right" type="text" v-model="row.house_number" class="border">
								<span class="am-u-sm-6 am-inline-block">
									<h3>门牌</h3>
								</span>
							</div>
						</dd>
					</dl>
					<dl class='compact font-0 am-padding-vertical'>
						<dt class="am-inline-block am-text-center am-text-middle font-1">期望售价</dt>
						<dd class="am-inline-block am-text-middle font-1">
							<div class="am-u-sm-4">
								<input class="input-border-hide" placeholder="请输入你期望的价格" type="text" v-model="row.expect_price">
							</div>
							<div class="am-u-sm-2">
								<div>万元</div>
							</div>
							<div class="am-u-sm-6 am-u-end">
								<a href="">不太清楚如何定价? 先估个价</a>
							</div>

						</dd>
					</dl>
					<dl class='compact font-0 am-padding-vertical'>
						<dt class="am-inline-block am-text-middle am-text-center font-1">称呼</dt>
						<dd class="am-inline-block am-text-middle font-1">
							<input class="input-border-hide am-u-lg-12" placeholder="我们应该如何称呼您" type="text" v-model="row.contact">
						</dd>
					</dl>
					<dl class='compact font-0 am-padding-vertical'>
						<dt class="am-inline-block am-text-middle am-text-center font-1">手机号码</dt>
						<dd class="am-inline-block am-text-middle font-1">
							<input class="input-border-hide am-u-lg-12" placeholder="您的联系方式，方便我们联系您" type="text" v-model="row.tel">
						</dd>
					</dl>
					<div class="am-text-center am-lg-text-right am-margin-vertical-lg">
						<button type="submit" class="am-btn am-btn-lg am-btn-success am-radius">提交委托</button>
					</div>
				</form>
			</div>


			<div class="sibeBar am-u-lg-4 am-u-sm-12 ">
				<blockquote class="">
					<p>有人住的房子才是好房子</p>
					<small>鲁迅 ----《房》</small>
				</blockquote>
			</div>
		</div>
		<div class="am-modal am-modal-no-btn" tabindex="-1" id="my-alert">
		  <div class="am-modal-dialog">
		    <div class="am-modal-hd">@{{msg.title}}
		      <a href="javascript: void(0)" class="am-close am-close-spin" data-am-modal-close>&times;</a>
		    </div>
		    <div class="am-modal-bd">
		      @{{msg.content}}
		    </div>
		  </div>
		</div>

	</div>
	<script type="text/javascript" src="/bower_components/jquery/dist/jquery.min.js"></script>
	<script type="text/javascript" src="/bower_components/amazeui/dist/js/amazeui.min.js"></script>
	<script type="text/javascript" src="/node_modules/vue/dist/vue.js"></script>
	<script type="text/javascript" src="/js/user/maifang.js"></script>
</body>
</html>
