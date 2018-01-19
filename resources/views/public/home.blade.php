<!DOCTYPE html>
<html lang="zh-cn">
<head>
	<meta charset="UTF-8">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>首页 - 房子</title>
	<link rel="stylesheet" type="text/css" href="/node_modules/amazeui/dist/css/amazeui.css">
	<link rel="stylesheet" type="text/css" href="/css/public/home.css">
	<!-- <link rel="stylesheet" type="text/css" href="/css/user/maifang.css"> -->
</head>
<body>
	<div id="appHome" v-cloak>
		<!-- topbar -->
		<div id="head">
			<!-- 导航 -->
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
								<li><router-link to="/">首页</router-link></li>
								<li><router-link to="/readHouses">看房</router-link></li>
								<li class="">
									<a href="">哩个</a>
								</li>
							</ul>
							<div class="am-topbar-right">
								<ul class="am-nav am-nav-pills am-topbar-nav">
									<li>
										<router-link to="/user/maifang">我要卖房</router-link>
									</li>
									<li v-if="user === null">
										<router-link to="/login" title="登陆">登陆</router-link>
									</li>
									<li v-on:click="downEvent" class="am-dropdown userBarDown" v-else>
										<a href="#" class="am-dropdown-toggle">@{{user.username}}<i class="am-icon-caret-down"></i></a>
										<ul class="am-dropdown-content">
											<li>
												<router-link to="/">首页</router-link>
											</li>
											<li>
												<router-link to="/user/info">个人信息</router-link>
											</li>
											<li>
												<router-link to="/">我的委托</router-link>
											</li>
											<li>
												<router-link to="/">交易记录</router-link>
											</li>
											<li v-if="user.permission > 3">
												<router-link to="/admin/house">后台管理</router-link>
											</li>
											<li>
												<a v-on:click="logoutEvent" href="#">登出</a>
											</li>
										</ul>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- content -->
		<transition name="fade" mode="out-in">
			<router-view></router-view>
		</transition>
		<div class="alertBar">
			<button type="button" id='alertBtn' data-am-modal="{target: '#my-alert'}" style="display:none;"></button>
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

		<!-- foolter -->
		<div id="foolter"></div>
	</div>
	<script type="text/javascript" src="/node_modules/jquery/dist/jquery.js"></script>
	<script type="text/javascript" src="/node_modules/amazeui/dist/js/amazeui.js"></script>
	<script type="text/javascript" src="/node_modules/vue/dist/vue.js"></script>
	<script type="text/javascript" src="/node_modules/vue-router/dist/vue-router.js"></script>
	<script type="text/javascript" src="/js/public/home.js"></script>
</body>
</html>
