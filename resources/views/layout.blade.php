<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>首页 - 房子</title>
	<link rel="stylesheet" type="text/css" href="/bower_components/amazeui/dist/css/amazeui.min.css">
	<link rel="stylesheet" type="text/css" href="/css/public/home.css">
</head>
<body>
	<div id="appHome">
		<div id="head">
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
		</div>
		router-view	
	</div>
	<script type="text/javascript" src="/bower_components/jquery/dist/jquery.min.js"></script>
	<script type="text/javascript" src="/bower_components/amazeui/dist/js/amazeui.min.js"></script>
	<script type="text/javascript" src="/node_modules/vue/dist/vue.js"></script>
	<script type="text/javascript" src="/js/public/home.js"></script>
</body>
</html>