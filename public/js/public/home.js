/**
 *  Yuan Yi
 * @AuthorHTL
 * @DateTime  2018-01-14T15:36:59+0800
 * @return    {[type]}                 [description]
 */
;
(function() {
	'use strict';


	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});






/**
 * vue communicator
 * @type {communicator}
 */
	const bus  = new Vue();



/**
 * home page component
 * @type {component}
 */
	const homeComponent =
	{
		template:
		`
			<div class="content">
				<div class="home-search-bar">
					<div class="am-container">
						<div class="am-g">
							<div class="am-u-sm-12 am-u-md-8 am-u-md-offset-2">
								<form class="am-form" v-on:submit.prevent="search">
									<label class="am-input-group">
										<input class="home-searchInput am-form-field" v-model="keyword" type="text" placeholder="试试输入地段" />
										<span class="am-input-group-btn"><button type="submit" class='am-btn am-btn-default'><i class="am-icon-search"></i>搜索</button></span>
									</label>
								</form>
							</div>
						</div>
					</div>
				</div>
				<div class="hoem-search-result-content" v-show="searchStart == true">
					<div class="am-container">
						<div v-if="result == false">
							没有搜索结果。
						</div>
						<div v-else class="search-result-item" v-for="item in result">
							<div class="am-panel am-panel-default">
								<header class="am-panel-hd"><h3>{{item.title}}</h3></header>
								<div class="am-panel-bd">
									<div>{{item.created_at}}</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		`,
		mounted: function() {
			console.log('now page is home');
		},
		data:function(){
			return {
				keyword:'',
				result:null,
				searchStart:false,
			}
		},
		methods:{
			search(){
				if(!this.searchValidator())
					return;
				$.post('/api/house/titleSearch',{keyword:this.keyword}).then(res=>{
					this.result = res.data;
				})
			},
			searchValidator(){
				if(this.searchStart == false)
					this.searchStart = true;
				if(this.keyword == ''){
					this.result = [];
					return false;
				}
				return true;
			},
		},
	};



/**
 * login page component
 * @type {component}
 */
	const loginComponent =
	{
		template:
		`
			<transition name="fade" mode="out-in">
				<div class="am-container">
					<div class="am-g">
						<div class="am-u-sm-6 am-u-sm-centered am-tabs">
							<ul class="am-tabs-nav am-nav am-nav-tabs am-text-center am-g-collapse">
								<li  class="am-u-sm-6 am-active"><a style="margin-right:0;" href="#">Login</a></li>
								<li  class="am-u-sm-6"><router-link style="margin-right:0;" to="/signup">Signup</router-link></li>
							</ul>
							<div class="am-tabs-bd">
								<div class="am-tab-panel am-active">
									<form class="am-form" v-on:submit.prevent="loginEvent">
										<fieldset>
											<input type="text" v-model="loginFormData.username" placeholder="回想一下注册时的邮箱？"/>
											<input type="password" v-model="loginFormData.password" placeholder="悄悄写下密码"/>
											<div class="am-form-group">
												<label class="am-checkbox">
													<input type="checkbox" data-am-ucheck /><span>记住我十万年</span>
												</label>
											</div>
											<button type="submit" class="am-btn am-btn-radius am-btn-default am-btn-block">登陆</button>
										</fieldset>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</transition>
		`,
		mounted:function(){
			console.log('now is login page.');
		},
		data:function(){
			return {
				loginFormData:{},
			}
		},
		methods:{
			loginEvent(){
				$.post('/api/user/login',this.loginFormData).then(res=>{
					if(res.success){
						bus.$emit('loginSuccess');
						router.push({path:'/'});
					}
				})
			},
		},
	};



/**
 * signup page component
 * @type {componnet}
 */
	const signupComponent =
	{
		template:
		`
			<transition name="fade" mode="out-in">
				<div class="am-container">
					<div class="am-g">
						<div class="am-u-sm-6 am-u-sm-centered am-tabs">
							<ul class="am-tabs-nav am-nav am-nav-tabs am-text-center am-g-collapse">
								<li class="am-u-sm-6"><router-link style="margin-right:0;" to="/login">Login</router-link></li>
								<li class="am-u-sm-6 am-active"><a style="margin-right:0;" href="#">Signup</a></li>
							</ul>
							<div class="am-tabs-bd">
								<div class="am-tab-panel am-active">
									<form class="am-form" v-on:submit.prevent="signupEvent">
										<fieldset>
											<div class="am-form-group am-form-icon am-form-feedback">

												<input type="text" v-model="signupFormData.username" placeholder="取个名字"/>
												<span class="am-icon-times"></span>
											</div>
											<input type="text" v-model="signupFormData.email" placeholder="填下邮箱"/>
											<input type="text" v-model="signupFormData.tel" placeholder="再填个手机"/>
											<input type="password" v-model="signupFormData.password" placeholder="设个密码"/>
											<input type="password" v-model="signupFormData.confirmPassword" placeholder="密码不确认一下吗"/>
											<div class="am-form-group">
												<router-link to="/login">已有账号？点击登录</router-link>
											</div>
											<button type="submit" class="am-btn am-btn-radius am-btn-default am-btn-block">注册</button>
										</fieldset>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</transition>
		`,
		mounted: function() {
			console.log('now is signup page.');
		},
		data:function(){
			return {
				signupFormData:{},
			}
		},
		methods:{
			signupEvent(){
				$.post('/api/user/signup',this.signupFormData).then(res=>{
					console.log('注册成功');
				})
			}
		}
	};




/**
 * admin control page componnet
 * @type {componnet}
 */
	const adminHouseComponent =
	{
		template:
		`
			<div class="am-container">
				<div class="am-g am-scrollable-horizontal">
					<table class="am-table-bordered am-table-striped am-table-hover am-table-centered">
						<thead>
							<th class="am-padding-horizontal">ID</th>
							<th class="am-padding-horizontal">TITLE</th>
							<th class="am-padding-horizontal">Community</th>
							<th class="am-padding-horizontal">expect_price</th>
							<th class="am-padding-horizontal">AREA</th>
							<th class="am-padding-horizontal">Location</th>
							<th class="am-padding-horizontal">VisitingCount</th>
							<th class="am-padding-horizontal">contact</th>
							<th class="am-padding-horizontal">contactTEL</th>
							<th class="am-padding-horizontal">created_at</th>
							<th class="am-padding-horizontal">Status</th>
							<th class="am-padding-horizontal">操作</th>
						</thead>
						<tbody v-if="list == false">
							<tr><td colspan="12">并没有订单。</td></tr>
						</tbody>
						<tbody v-else>
							<tr v-for="item in list">
								<td>{{item.id}}</td>
								<td>{{item.title || '暂无'}}</td>
								<td>{{item.community || '暂无'}}</td>
								<td>{{item.expect_price || '暂无'}}</td>
								<td>{{item.area || '暂无'}}</td>
								<td>
									<span>{{item.building || '暂无'}}</span>
									<span>{{item.unit || '暂无'}}</span>
									<span>{{item.house_number || '暂无'}}</span>
								</td>
								<td>{{item.visiting_count || '暂无'}}</td>
								<td>{{item.contack || '暂无'}}</td>
								<td>{{item.tel || '暂无'}}</td>
								<td>{{item.created_at || '暂无'}}</td>


								<td>
									<select :value="item.status" v-on:change="changeStatus(item.id,$event)">
										<option v-for="(value,key) in statusList" :value="key">{{value}}</option>
									</select>
								</td>
								<td>
									<button type="button" class="am-btn am-btn-link" >编辑</button>
									<button type="button" class="am-btn am-btn-link">关闭</button>
								</td>
							</tr>
						</tbody>
						<tfoot></tfoot>
					</table>
				</div>
			</div>
		`,
		mounted:function(){
			this.getList().getStatusList();
		},
		data:function(){
			return {
				page:1,
				list:[],
				statusList:[],
			}
		},
		methods:{
			getList(){
				$.post('/api/house/read',{page:this.page}).then((r)=>{
					console.log(r);
					this.list = r.data;
				})
				return this;
			},
			getStatusList(){
				$.get('/api/house/getStatusList').then((r)=>{
					this.statusList = r.data;
				})
			},
			changeStatus(id,e){
				console.log(e.target.value);
			}
		}
	};

/**
 * [sellHouseComponent]
 * @type {component}
 */
	const sellHouseComponent =
	{
		template:
		`
			<div class="content">
				<div class="top">
					<div class="am-container am-text-center">
						<div class="am-g">
							<div class="title">
								<div class="">发布出售房源</div>
							</div>
							<div class="subtitle">
								<h3 class='am-link-muted'>大数据专业估价·每天超过30000次估价请求量</h3>
							</div>
						</div>
					</div>
				</div>
				<div class="main">
					<div class="am-container">
						<div class="am-g">
							<div class="am-u-lg-8 am-u-sm-12 am-form">
								<form v-on:submit.prevent="add" class="am-sm-text-center am-g-collapse" id="sell-house-form">
									<div class="am-hide-sm">
										<dl class='am-padding-vertical am-text-center'>
											<dt class="am-u-md-3 am-text-middle">小区</dt>
											<dd class="am-u-md-9 am-text-middle">
												<input class="input-border-hide am-form-field am-u-lg-12" placeholder="请输入小区的名称，方便我们审核" type="text" v-model="row.community">
											</dd>
										</dl>
										<dl class='am-padding-vertical am-text-center' >
											<dt class="am-text-middle am-u-md-3">房屋地址</dt>
											<dd class="am-u-md-9 am-text-middle">
												<div class="am-u-md-3">
													<input placeholder="楼栋号" class="am-form-field am-u-sm-6 am-text-right" type="text" v-model="row.building">
												</div>
												<div class="am-u-md-3 am-u-md-offset-1">
													<input placeholder="单元号" class="am-form-field am-u-sm-6 am-text-right"  type="text" v-model="row.unit">
												</div>
												<div class="am-u-md-3 am-u-md-offset-1 am-u-end">
													<input placeholder="门牌号" class="am-form-field am-u-sm-6 am-text-right" type="text" v-model="row.house_number">
												</div>
											</dd>
										</dl>
										<dl class='am-padding-vertical am-text-center'>
											<dt class="am-u-md-3 am-text-middle">期望售价</dt>
											<dd class="am-u-md-9 am-text-middle">
												<div class="am-u-md-4">
													<input class="am-form-field am-u-sm-12 am-text-right" placeholder="请输入你期望的价格" type="text" v-model="row.expect_price">
												</div>
												<div class="am-u-md-2">
													<h4>万元</h4>
												</div>
												<div class="am-u-md-6">
													<a href="">不太清楚如何定价? 先估个价</a>
												</div>
											</dd>
										</dl>
										<dl class='am-padding-vertical am-text-center'>
											<dt class="am-u-md-3 am-text-middle">称呼</dt>
											<dd class="am-u-md-9 am-text-middle">
												<input class="am-form-field am-u-sm-12" placeholder="我们应该如何称呼您" type="text" v-model="row.contact">
											</dd>
										</dl>
										<dl class='am-padding-vertical am-text-center'>
											<dt class="am-u-md-3 am-text-middle">手机号码</dt>
											<dd class="am-u-md-9 am-text-middle">
												<input class="am-form-field am-u-sm-12" placeholder="您的联系方式，方便我们联系您" type="text" v-model="row.tel">
											</dd>
										</dl>
									</div>
									<div class="am-show-sm">
										<div class="am-form-group">
											<label class="">小区</label>
											<input type="text" class="am-form-field" placeholder="请输入小区的名称，方便我们审核" v-model="row.community">
										</div>
										<div class="am-form-group">
											<label class="">楼栋号</label>
											<input placeholder="楼栋号" class="am-form-field" type="text" v-model="row.building">
										</div>
										<div class="am-form-group">
											<label class="">单元号</label>
											<input placeholder="单元号" class="am-form-field" type="text" v-model="row.unit">
										</div>
										<div class="am-form-group">
											<label class="">门牌号</label>
											<input placeholder="门牌号" class="am-form-field" type="text" v-model="row.house_number">
										</div>
										<div class="am-form-group">
											<label class="">期望价格</label>
											<input class="am-form-field" placeholder="请输入你期望的价格" type="text" v-model="row.expect_price">
											<a href="">不太清楚如何定价? 先估个价</a>
										</div>
										<div class="am-form-group">
											<label class="">称呼</label>
												<input class="am-form-field" placeholder="我们应该如何称呼您" type="text" v-model="row.contact">
										</div>
										<div class="am-form-group">
											<label class="">手机号码</label>
												<input class="am-form-field" placeholder="您的联系方式，方便我们联系您" type="text" v-model="row.tel">
										</div>
									</div>
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
					</div>
				</div>
			</div>
		`,
		mounted:function()
		{

		},
		methods:
		{
			add()
			{
				bus.$emit('progress','start');
				// response
				console.log(this.row);
				$.post('/api/house/createTable',this.row).then(res=>{
					bus.$emit('progress','done');
					bus.$emit('alert',{'title':'添加成功～','content':'请耐心等待审核.'});
					this.row = {};
				},r=>{
					console.log(r);
				})
			},
		},
		data:function()
		{
			return {
				row:{},
			}
		}
	}


/**
 *  houseCompletionComponent
 */
 	const houseCompletionComponent =
 	{
 		template:`哈`,
 		mounted:function(){

 		},
 		methods:{

 		},
 		data:function(){
 			return {

 			}
 		}
 	}

/**
 *  please login component
 */
 	const pleaseLoginComponent =
 	{
 		template:
 		`
			<div class="content">
				<div class="am-container">
					<div class="am-g">
						<div class="am-text-center">
							<div>请先登录</div>
						</div>
					</div>
				</div>
			</div>
 		`,
 		mounted:function(){
 			console.log('now is please login');
 		},
 		data:function(){
 			return {

 			}
 		},
 		methods:{

 		}
 	}

/**
 *  read houses page component
 */
	const readHouseComponent =
	{
	 	template:
	 	`
			<div class="content">
				<div class="am-container">
					<div class="am-g">
						<div v-if="houseList == false">
							<h3>Not Data. QAQ</h3>
						</div>
						<div class="houseItem" v-for="item in houseList" v-else>
							<div class="am-panel am-panel-default">
								<div class="am-panel-bd">
									{{item.title|| 'Not Title. QAQ'}}
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
	 	`,
	 	mounted:function(){
	 		console.log('now is read houses page');
	 		this.init();
	 	},
	 	methods:{
	 		init(){
	 			this.getSellingHouses();
	 		},
	 		getSellingHouses(){
	 			$.post('/api/house/getSellingHouses').then(r=>{
	 				 this.houseList = r.data;
	 				 console.log(r);
	 			})
	 		},

	 	},
	 	data:function(){
	 		return {
	 			houseList:[],
	 		}
	 	}
	}

/**
 *  user page side @click="active('message')" @click="active('commissioned')" @click="active('transactionLog')"
 */
	const userComponent =
	{
		template :
		`
			<div class="content">
				<div class="am-g">
					<div class="am-container">
							<div class="">
								<div class="am-u-md-3 am-hide-sm">
									<div class="am-panel am-panel-default">
										<div class="am-panel-bd">
												<ul class="am-nav admin-sidebar-list" id="user-sibe-nav">
													<router-link  activeClass="am-active" tag="li" to="/user/info" exact>
														<a >我的资料</a>
													</router-link>
													<li>
														<a data-am-collapse="{parent:'#user-sibe-nav',target: '#user-message-collpase'}">
															消息中心
															<i class="am-icon-angle-right am-fr am-margin-right"></i>
															<span v-show="webMessage+userMessage >0" class="am-badge am-badge-default am-margin-right">{{webMessage+userMessage}}</span>
														</a>
														<ul class="am-nav am-collapse admin-sidebar-sub" id="user-message-collpase">
															<router-link  activeClass="am-active" tag="li" to="/user/webMessage" exact>
																<a >
																站内消息
																	<span v-show="webMessage >0" class="am-badge am-badge-default am-fr am-margin-right am-text-middle">{{webMessage}}</span>
																</a>
															</router-link>
															<router-link  activeClass="am-active" tag="li" to="/user/userMessage" exact>
																<a >
																	私信
																<span v-show="userMessage >0" class="am-badge am-badge-default am-fr am-margin-right am-text-middle">{{userMessage}}</span>
																</a>
															</router-link>
														</ul>
													</li>
													<router-link activeClass="am-active" tag="li" to="/user/commissioned" exact>
														 <a >我的委托</a>
													</router-link>
													<router-link activeClass="am-active" tag="li" to="/user/transactionlog" exact>
														<a >交易记录</a>
													</router-link>
												</ul>
										</div>
									</div>

								</div>
								<div class="am-sm-12 am-u-md-9">
									<router-view></router-view>
								</div>
							</div>
					</div>
				</div>
				<div class="user-menu-btn am-show-sm" style="position:fixed;bottom: 50px;right: 25px;">
					<a href="#user-side-menu-bar" data-am-offcanvas class="am-icon-btn am-icon-bars"></a>
				</div>
				<div id="user-side-menu-bar" class="am-offcanvas">
					<div class="am-offcanvas-bar">
						<div class="am-offcanvas-content">
							<div class="am-g am-g-collapse">
								<ul class="am-nav">
									<router-link tag="li" to="/">
										<a><i class="am-icon-home"></i>首页</a>
									</router-link>
									<router-link tag="li" to="/">
										<a><i class="am-icon-building-o"></i>看房</a>
									</router-link>
									<router-link tag="li" to="/">
										<a ><i class="am-icon-money"></i>我要卖房</a>
									</router-link>
									<hr>
									<router-link @click.native="sideBarHide" activeClass="am-active" tag="li" to="/user/info" exact>
										<a><i class="am-icon-user"></i>我的资料 </a>
									</router-link>
									<li activeClass="am-active">
										 <a data-am-collapse="{target:'#user-side-bar-message'}">
										 	<i class="am-icon-envelope-o"></i>
										 	消息中心
											<span v-show="webMessage+userMessage >0" class="am-badge am-badge-success am-fr am-margin-right am-text-middle">{{webMessage+userMessage}}</span>
										 </a>
										 <ul class="am-nav am-collapse" id="user-side-bar-message">
										 	<router-link @click.native="sideBarHide" activeClass="am-active" tag="li" to="/user/webMessage" exact>
												<a>
													站内消息
													<span v-show="webMessage > 0" class="am-badge am-badge-success am-fr am-margin-right am-text-middle">{{webMessage}}</span>
												</a>
											</router-link>
										 	<router-link @click.native="sideBarHide" activeClass="am-active" tag="li" to="/user/userMessage" exact>
												<a>
													私信
													<span v-show="userMessage >0" class="am-badge am-badge-success am-fr am-margin-right am-text-middle">{{userMessage}}</span>
												</a>
											</router-link>
										 </ul>
									</li>
									<router-link @click.native="sideBarHide" activeClass="am-active" tag="li" to="/user/commissioned" exact>
										 <a ><i class="am-icon-bell-o"></i>我的委托</a>
									</router-link>
									<router-link @click.native="sideBarHide" activeClass="am-active" tag="li" to="/user/transactionlog" exact>
										<a><i class="am-icon-align-left"></i>交易记录</a>
									</router-link>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		`,
		mounted:function(){
			this.init();
		},
		methods:{
			init(){
				this.getUnreadMessageCount();
			},
 			sideBarHide(){
 				$('#user-side-menu-bar').offCanvas('close');
 			},
 			getUnreadMessageCount(){
 				$.post('/api/adminMessage/getUnreadCount').then(res=>{
 					this.webMessage = res.data;
 				})

 				$.post('/api/envelope/getUnreadCount').then(res=>{
 					this.userMessage = res.data;
 				})
 			},
		},
		data:function(){
			return{
				activeIs:'info',
				userMessage:0,
				webMessage:0,
			}
		}
	}


/**
 *  user page children [info page]
 */
 	const userInfoComponent = {
 		template:
 		`
 			<transition>
				<div class="content">
					<div id="user-info-page">
						<h1>我的资料</h1>
						<hr />
						<div v-if="userData == null">
							哎呀出错了！
						</div>
						<form class="am-form" data-am-validator v-else>
							<div class="am-form-group">
								<label >用户ID</label>
								<input type="text" v-model="userData.id" disabled/>
							</div>
							<div class="am-form-group">
								<label >用户名</label>
								<input type="text" v-model="userData.username" disabled/>
							</div>
							<div class="am-form-group">
								<label >昵称</label>
								<input type="text" v-model="userData.nick_name"/>
							</div>
							<div >
								<label >性别</label>
								<select data-am-selected v-model="userData.sex">
									<option value="male">男</option>
									<option value="female">女</option>
									<option value="null">保密</option>
								</select>
							</div>
							<div class="am-form-group">
								<label >注册时间：</label>
								<span>{{userData.created_at}}</span>
							</div>
						</form>
					</div>
				</div>
 			</transition>
 		`,
 		mounted:function(){
 			console.log('now is user info page');
 			this.init();
 		},
 		methods:{
 			init(){
 				this.getUserData();
 			},
 			getUserData(){
 				$.post('/api/user/getUserData').then(r=>{
 					this.userData = r.data;
 				})
 			},
 		},
 		data:function(){
 			return {
 				userData:null,
 			}
 		}
 	}

/**
 *  user page children [My Message page]
 */

 	const userMessageComponent = {
 		template:
 		`
			<transition>
				<div class="content">
					<div id="user-message-page">
						<h1>私信</h1>
						<hr />
						<div v-if="uMessage === null">
							哎呀出错了！
						</div>
						<div v-else-if="uMessage == false">
							没有消息。。。
						</div>
						<div v-else>
							<div class="user-message-item am-panel am-panel-default" v-for="item in uMessage">
								<div class="am-panel-bd">
									<dl>
										<dt>
											<span>{{item.username}}</span>
											<small style="font-weight:100;">{{item.created_at}}</small>
										</dt>
										<dd>
											<p style="text-indent:0.5cm;" class="am-text-sm">{{item.content}}</p>
										</dd>
									</dl>
								</div>
							</div>
						</div>
					</div>
				</div>
 			</transition>
 		`,
 		mounted:function(){
 			console.log('now page is my message');
 			this.init();
 		},
 		methods:{
 			init(){
 				this.getUserMessage();
 			},
 			getUserMessage(){
 				$.post('/api/envelope/getUserMessage').then(res=>{
 					this.uMessage = res.data;
 				})
 			}
 		},
 		data:function(){
 			return {
 				uMessage:null,
 			}
 		}
 	}


 	const webMessageComponent = {
 		template:
 		`
			<transition>
				<div class="content">
					<div id="user-message-page">
						<div class="am-panel am-panel-default">
							<div class="am-panel-bd">
								<span style="font-weight:800" class="am-text-lg">站内消息</span>
							</div>
						</div>
						<div v-if="wMessage === null">
							哎呀出错了！
						</div>
						<div v-else-if="wMessage == false">
							没有消息。。。
						</div>
						<div v-else>
							<div class="user-message-item am-panel am-panel-default" v-for="item in wMessage">
								<div class="am-panel-bd">
									<dl>
										<dt>
											<span>{{item.title}}</span>
											<small style="font-weight:100;">{{item.created_at}}</small>
										</dt>
										<dd>
												<p style="text-indent:0.5cm;" class="am-text-sm">{{item.content}}</p>
										</dd>
									</dl>
								</div>
							</div>
						</div>
					</div>
				</div>
 			</transition>
 		`,
 		mounted:function(){
 			this.init();
 		},
 		methods:{
 			init(){
 				this.getWebMessage();
 			},
 			getWebMessage(){
 				$.post('/api/adminMessage/userGetMessage').then(res=>{
 					this.wMessage = res.data;
 				})
 			}
 		},
 		data:function(){
 			return {
 				wMessage:null,
 			}
 		}
 	}


/**
 *  user page children [My commissioned page]
 */
 	const userCommissionedComponent = {
 		template:`<h1>wu</h1>`,
 		mounted:function(){

 		},
 		methods:{

 		},
 		data:function(){
 			return {}

 		}
 	}

/**
 *  user page children [my transactionLog page]
 */
 const userTransactionLogComponent = {
 		template:`<h1>hu</h1>`,
 		mounted:function(){

 		},
 		methods:{

 		},
 		data:function(){
 			return {}

 		}
 	}

/**
 * vue router control
 * @type {vue routers}
 */
	const routes =
	[
		{
			path: '/',
			component:homeComponent,
			meta:{title:'首页'}
		},
		{
			path:'/login',
			component:loginComponent,
			meta:{title:'登录'}
		},
		{
			path: '/signup',
			component:signupComponent,
			meta:{title:'注册'}
		},
		{
			path:'/user/maifang',
			component:sellHouseComponent,
			meta:{title:'我要卖房'}
		},
		{
			path:'/user/maifang/completion',
			component:houseCompletionComponent,
			meta:{title:'资料补全'}
		},
		{
			path:'/admin/house',
			component:adminHouseComponent,
			meta:{title:'后台管理'}
		},
		{
			path:'/pleaseLogin',
			component:pleaseLoginComponent,
			meta:{title:'请登录'}
		},
		{
			path:'/readHouses',
			component:readHouseComponent,
			meta:{title:'看房'}
		},
		{
			path:'/user',
			component:userComponent,
			meta:{title:'用户'},
			children:[
				{
					path:'info',
					component:userInfoComponent,
				},
				{
					path:'webMessage',
					component:webMessageComponent,
				},
				{
					path:'userMessage',
					component:userMessageComponent,
				},
				{
					path:'commissioned',
					component:userCommissionedComponent,
				},
				{
					path:'transactionLog',
					component:userTransactionLogComponent,
				}
			]
		}
	];



/**
 * VueRouter
 * @type {VueRouter}
 */
	const router = new VueRouter({
		routes
	});


/**
 *
 */



/**
 *  main Vue
 * @AuthorHTL
 * @DateTime  2018-01-16T14:13:22+0800
 * @param     {null}                 ){			this.getLoggingStatus();			bus.$on('loginSuccess',()                                                                            [description]
 * @param     {null}                 methods:{			getLoggingStatus(){				$.post('/api/user/is_login',{want:['username','email','tel','id','permission']})					.then(res [description]
 * @param     {null}                 downEvent(){				$('.userBarDown').dropdown('toggle');			}                                                                           [description]
 * @param     {null}                 logoutEvent(                                                                                                                          [description]
 * @return    {null}                                                                                                                                                       [description]
 */
	const $v = new Vue({
		router,
		data:{
			user:null,
			alertEl:document.querySelector('#alertBtn'),
			msg:{'title':'添加成功～','content':'请耐心等待审核'},
		},
		mounted:function()
		{

			/**
			 *  judgment user is not it login
			 */
			this.getLoggingStatus();

			/*
			 * monitor user login
			 */
			bus.$on('loginSuccess',()=>{
				this.getLoggingStatus();
			});

			/*
			 * monitor alert
			 */
			bus.$on('alert',msg=>{
				this.alert(msg);
			});

			/**
			 *  monitor porgress
			 */
			bus.$on('progress',type=>{
				this.progress(type);
			})
		},
		methods:
		{
			getLoggingStatus()
			{
				$.post('/api/user/is_login',{want:['username','email','tel','id','permission']})
					.then(res=>{
						console.log(res);
						if(res.success){
							this.user = res.data[0];
						}
					})
			},
			downEvent()
			{
				$('.userBarDown').dropdown('toggle');
			},
			logoutEvent()
			{
				$.post('/api/user/logout').then(res=>{
					this.user = null;
					router.push({path:'/'});
				})
			},
			alert(msg)
			{
				if(msg){
					if(typeof(msg) == 'object'){
						this.msg.title = msg.title;
						this.msg.content = msg.content;
					}else this.msg.content = msg;
				}
				this.alertEl.click();
			},
			progress(type)
			{
				switch(type){
					case 'start':
						$.AMUI.progress.start();
						break;
					case 'done':
						$.AMUI.progress.done();
						break;
					default:
						break;
				}
			}
		},
	}).$mount('#appHome');



	router.beforeEach((to, from, next) => {
		$v.progress('start');
		let path = to.path;
		if(!$v.user && !(path == '/' || path == '/login' || path  == '/signup' || path =='/pleaseLogin' || path=='/readHouses')){
				return next('/pleaseLogin');
		}
		return next();
	})
	router.afterEach((to, from) => {
		$v.progress('done');
	})


})();
