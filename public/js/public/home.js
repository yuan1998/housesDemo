;(function(){
	'use strict';


	$.ajaxSetup({
	  headers: {
	    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});

	const homeSearch = 
	`
		<div class="content">
			<div class="home-search-bar">
				<div class="am-container">
					<div class="am-g">
						<div class="am-u-sm-12 am-u-md-8 am-u-md-offset-2">
							<form class="am-form">
								<label class="am-input-group">
									<input class="home-searchInput am-form-field" type="text" placeholder="试试输入地段" />
									<span class="am-input-group-btn"><button type="submit" class='am-btn am-btn-default'><i class="am-icon-search"></i>搜索</button></span>
								</label>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>

	`;


	const routes = 
	[
		{
			path:'/',
			component:
			{
				mounted: function() {console.log(1)},
				template:homeSearch,
			},
		},
		// {
		// 	path:'/user/maifang',
		// 	component:
		// 	{
		// 		template:`<div class="am-container">hehe</div>`,
		// 	},
		// }
	];

	const router = new VueRouter({
		routes
	});

	const $v = new Vue({
		router,
		el:'#appHome',

	}).$mount('#appHome');





})();