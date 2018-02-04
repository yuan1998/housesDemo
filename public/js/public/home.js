/**
 *  Yuan Yi
 * @AuthorHTL
 * @DateTime  2018-01-14T15:36:59+0800
 * @return    {[type]}                 [description]
 */
;(function() {
   'use strict';


   const IpLocation = remote_ip_info;


   /**
    * set x-csrf-token header.
    * @type {Object}
    */
   function set_headers(){
      $.ajaxSetup({
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            's_token':$.AMUI.utils.cookie.get('s_token')
         }
      });
   }


   set_headers();

   /**
    * if responces exists token .save to cookie.
    * @Yuan1998
    * @DateTime 2018-01-23T17:13:52+0800
    */
   function set_token($token){
      $.AMUI.utils.cookie.set('s_token',$token);
      set_headers();
   }


   function is_login($param){
      return $.post('/api/user/is_login',$param);
   }



/**
 * vue communicator
 * @type {Vue}
 */
   const bus  = new Vue();





/**
 *  Module User
 */
const userStore = {
   namespaced: true,
   state:{
      user:null,
   },
   mutations:{
      saveUser(state,payload){
         state.user = payload;
      }
   },
   actions:{
      saveUser({commit},data){
         commit('saveUser',data);
      }
   },
   getters:{
      user:(state)=>{
         console.log(state);
         return state.user;
      }
   }

}


const messageStore = {
   namespaced: true,
   state:{
      userMessage:[],
      webMessage:[],
      unreadUserMessageCount:0,
      unreadWebMessageCount:0,
   },
   mutations:{
      userMessage(state,payload){
         state.userMessage = payload;
      },
      webMessage(state,payload){
         state.webMessage = payload;
      },
      saveUserCount(state,payload){
         state.unreadUserMessageCount = payload;
      },
      saveWebCount(state,payload){
         state.unreadWebMessageCount = payload;
      }
   },
   actions:{
      getUserMessage(state){

         $.post('/api/envelope/getUserMessage').then(res=>{
            state.commit('userMessage',res.data);
         })
         $.post('/api/adminMessage/userGetMessage').then(res=>{
            state.commit('webMessage',res.data);
         })

         $.post('/api/envelope/getUnreadCount').then(res=>{
            state.commit('saveUserCount',res.data);
         })
         $.post('/api/adminMessage/getUnreadCount').then(res=>{
            state.commit('saveWebCount',res.data);
         })


      },
   },
   getters:{
      userMessageCount:(state)=>{
         return state.unreadUserMessageCount;
      },
      webMessageCount:(state)=>{
         return state.unreadWebMessageCount;
      },
      user:(state)=>{
         return state.userMessage;
      },
      web:(state)=>{
         return state.webMessage;
      }
   }
}



/**
 *  Vuex
 */
const store = new Vuex.Store({
   modules:{
      user:userStore,
      message:messageStore,
   },
   state:{
      alertMsg : {'title':'添加成功～','content':'请耐心等待审核'},
      ipInfo:IpLocation,
   },
   mutations:{
      setMsgTitle(state,text){
         state.alertMsg.title = text;
      },
      setMsgContent(state,text){
         state.alertMsg.content = text;
      },
      saveIp(state,ip){
         state.ip = ip;
      },
      saveIpInfo(state,data){
         state.ipInfo= data;
      }
   },
   actions:{
      progress(state,type){
         $.AMUI.progress[type]();
      },
      _alert(state,msg){
         if(msg){
            if(typeof(msg) == 'object'){
               state.commit('setMsgTitle',msg.title);
               state.commit('setMsgContent',msg.content);
            }else state.commit('setMsgContent',msg);
         }
         document.querySelector('#alertBtn').click();
      },
      isLogin(state,data){
         is_login(data).then((res,textStatus,response)=>{

            let token =response.getResponseHeader('s_token');

            if(token)
               set_token(token);

            if(res.success){
               state.dispatch('user/saveUser',res.data);
               state.dispatch('message/getUserMessage');
            }
         })
      },
   },
   getters:{
      getIpCity(state){
         return state.ipInfo.city;
      },
      msg(state){
         return state.alertMsg;
      }
   }


})










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
                        <form class="am-form" v-on:submit.prevent="sendFile">
                           <label class="am-input-group">
                              <input class="home-searchInput am-form-field" v-model="keyword" type="text" placeholder="试试输入地段" />
                              <span class="am-input-group-btn"><button type="submit" class='am-btn am-btn-default'><i class="am-icon-search"></i>搜索</button></span>
                           </label>
                           <div class="am-form-group am-form-file">
                             <button type="button" class="am-btn am-btn-default am-btn-sm">
                               <i class="am-icon-cloud-upload"></i> 选择要上传的文件</button>
                             <input @change="uploads" type="file" multiple>
                           </div>
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
            formData:{},
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
         sendFile(){
            $.post('/api/img/test',this.formData).then(res=>{
               console.log(res);
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
         uploads(e){
            var files = e.target.files || e.dataTransfer.files;

            if(!files.length)
               return ;

            let a = this.img_to_base(files[0]);
            console.log(a);
         },
         img_to_base(file){

            let reader = new FileReader(),result;

            reader.onload = (e) =>{
               this.formData.file = e.target.result;
            }

            reader.readAsDataURL(file);
         }
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
         Validator(){
            if_login().then(res=>{
               if(res.success)
                  $router
            })
         }
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
         },

      }
   };

/**
 * sellHouseComponent
 * @type {component}
 */
   const sellHouseComponent =
   {
      store,
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
                              <dl class='am-g am-padding-vertical am-text-center'>
                                 <dt class="am-u-md-3 am-text-middle">城市位置</dt>
                                 <dd class="am-u-md-9 am-text-middle">
                                    <input class="input-border-hide am-form-field am-u-lg-12" placeholder="请输入城市位置" type="text" v-model="row.city">
                                 </dd>
                              </dl>

                              <dl class='am-g am-padding-vertical am-text-center'>
                                 <dt class="am-u-md-3 am-text-middle">小区</dt>
                                 <dd class="am-u-md-9 am-text-middle">
                                    <input class="input-border-hide am-form-field am-u-lg-12" placeholder="请输入小区的名称，方便我们审核" type="text" v-model="row.community">
                                 </dd>
                              </dl>

                              <dl class='am-g am-padding-vertical am-text-center' >
                                 <dt class="am-text-middle am-u-md-3">房屋地址</dt>
                                 <dd class="am-u-md-9 am-text-middle">
                                    <div class="am-u-md-3">
                                       <input placeholder="楼栋号" class="am-form-field am-u-sm-6 am-text-right" type="text" v-model="row.building_number">
                                    </div>
                                    <div class="am-u-md-3 am-u-md-offset-1">
                                       <input placeholder="单元号" class="am-form-field am-u-sm-6 am-text-right"  type="text" v-model="row.unit_number">
                                    </div>
                                    <div class="am-u-md-3 am-u-md-offset-1 am-u-end">
                                       <input placeholder="门牌号" class="am-form-field am-u-sm-6 am-text-right" type="text" v-model="row.house_number">
                                    </div>
                                 </dd>
                              </dl>

                              <dl class='am-g am-padding-vertical am-text-center'>
                                 <dt class="am-u-md-3 am-text-middle">期望售价</dt>
                                 <dd class="am-u-md-9 am-text-middle">
                                    <div class="am-u-md-4">
                                       <input class="am-form-field am-u-sm-12 am-text-right" placeholder="请输入你期望的价格" type="text" v-model="row.expect_price">
                                    </div>
                                    <div class="am-u-md-2">
                                       <span class="am-text-">万元</span>
                                    </div>
                                    <div class="am-u-md-6">
                                       <a href="">不太清楚如何定价? 先估个价</a>
                                    </div>
                                 </dd>
                              </dl>

                              <dl class='am-g am-padding-vertical am-text-center'>
                                 <dt class="am-u-md-3 am-text-middle">称呼</dt>
                                 <dd class="am-u-md-9 am-text-middle">
                                    <input class="am-form-field am-u-sm-12" placeholder="我们应该如何称呼您" type="text" v-model="row.contact">
                                 </dd>
                              </dl>

                              <dl class='am-g am-padding-vertical am-text-center'>
                                 <dt class="am-u-md-3 am-text-middle">手机号码</dt>
                                 <dd class="am-u-md-9 am-text-middle">
                                    <input class="am-form-field am-u-sm-12" placeholder="您的联系方式，方便我们联系您" type="text" v-model="row.tel">
                                 </dd>
                              </dl>
                           </div>
                           <div class="am-show-sm">
                              <div class="am-form-group">
                                 <label class="">所在城市</label>
                                 <input type="text" class="am-form-field" placeholder="请输入城市位置" v-model="row.city">
                              </div>
                              <div class="am-form-group">
                                 <label class="">小区</label>
                                 <input type="text" class="am-form-field" placeholder="请输入小区的名称，方便我们审核" v-model="row.community">
                              </div>
                              <div class="am-form-group">
                                 <label class="">楼栋号</label>
                                 <input placeholder="楼栋号" class="am-form-field" type="text" v-model="row.building_number">
                              </div>
                              <div class="am-form-group">
                                 <label class="">单元号</label>
                                 <input placeholder="单元号" class="am-form-field" type="text" v-model="row.unit_number">
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
                              <button type="submit" class="am-btn am-btn-lg am-btn-default am-radius">提交委托</button>
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

      methods:
      {
         add()
         {
            store.dispatch('progress','start');
            // response
            $.post('/api/commissioned/create',this.row).then(res=>{
               store.dispatch('progress','done');
               store.dispatch('_alert',{'title':'添加成功～','content':'请耐心等待审核'});
               this.row = {};
            },r=>{
               console.log(r);
            })
         },
      },
      mounted:function()
      {
         this.row.city = this.getCity;
         console.log(this.row);

      },
      computed:{
         getCity(){
            return store.getters['getIpCity'];
         }
      },
      data:function()
      {
         return {
            row:{city:''},// city:undefine
         }
      }
   }


/**
 *  houseCompletionComponent
 */
   const houseCompletionComponent =
   {
      template:
      `
         <transition>
            <div class="content">
               <div class="am-container">
                  <div class="am-g">
                     <div class="am-panel-default am-panel">
                        <div class="am-panel-hd">
                           <span>西安</span>
                           <span>知心印花元素</span>
                           <span>3号楼3单元1502号门牌</span>
                        </div>
                        <div class="am-panel-bd">
                           <form  class="am-form am-form-horizontal">
                              <div class="am-form-group">
                                 <label class="am-u-sm-2">房屋面积</label>
                                 <div class="am-u-sm-10">
                                    <input type="text" v-model="row.arae"/>
                                 </div>
                              </div>
                              <hr />
                              <div class="am-form-group">
                                 <label class="am-u-sm-2">户型</label>
                                 <div class="am-u-sm-10">
                                    <input type="text" v-model="row.room_count"/>
                                 </div>
                              </div>
                              <hr />
                              <div class="am-form-group">
                                 <label class="am-u-sm-2">朝向</label>
                                 <div class="am-u-sm-10">
                                    <input type="text" v-model="row.direction"/>
                                 </div>
                              </div>
                              <hr />
                              <div class="am-form-group">
                                 <label class="am-u-sm-2">所在楼层</label>
                                 <div class="am-u-sm-10">
                                    <input type="text" v-model="row.floor"/>
                                 </div>
                              </div>
                              <hr />
                              <div class="am-form-group">
                                 <label class="am-u-sm-2">总楼层</label>
                                 <div class="am-u-sm-10">
                                    <input type="text" v-model="row.floors"/>
                                 </div>
                              </div>
                              <hr />
                              <div class="am-form-group">
                                 <label class="am-u-sm-2">房屋类型</label>
                                 <div class="am-u-sm-10">
                                    <input type="text" v-model="row.house_type"/>
                                 </div>
                              </div>
                              <hr />
                              <div class="am-form-group">
                                 <label class="am-u-sm-2">房屋装修</label>
                                 <div class="am-u-sm-10">
                                    <input type="text" v-model="row.Decoration"/>
                                 </div>
                              </div>
                              <hr />
                              <div class="am-form-group">
                                 <label class="am-u-sm-2">楼房年龄</label>
                                 <div class="am-u-sm-10">
                                    <input type="text" v-model="row.floor_age"/>
                                 </div>
                              </div>
                              <hr />
                              <div class="am-form-group">
                                 <label class="am-u-sm-2">房屋供暖</label>
                                 <div class="am-u-sm-10">
                                    <input type="text" v-model="row.supply_heating"/>
                                 </div>
                              </div>
                              <hr />
                              <div class="am-form-group">
                                 <label class="am-u-sm-2">周边情况</label>
                                 <div class="am-u-sm-10">
                                    <input type="text" v-model="row.surroundings"/>
                                 </div>
                              </div>
                              <hr />
                              <div class="am-form-group">
                                 <label class="am-u-sm-2">小区信息</label>
                                 <div class="am-u-sm-10">
                                    <input type="text" v-model="row.community_info"/>
                                 </div>
                              </div>
                              <hr />
                              <div class="am-form-group">
                                 <label class="am-u-sm-2">周边交通</label>
                                 <div class="am-u-sm-10">
                                    <input type="text" v-model="row.traffic"/>
                                 </div>
                              </div>
                              <hr />
                              <div class="am-form-group">
                                 <label class="am-u-sm-2">房产资料</label>
                                 <div class="am-u-sm-10">
                                    <input type="text" v-model="row.deed_info"/>
                                 </div>
                              </div>
                              <hr />
                              <div class="am-form-group">
                                 <label class="am-u-sm-2">房屋年限</label>
                                 <div class="am-u-sm-10">
                                    <input type="text" v-model="row.house_age_limit"/>
                                 </div>
                              </div>
                              <hr />
                              <div class="am-form-group">
                                 <label class="am-u-sm-2">房屋户型信息</label>
                                 <div class="am-u-sm-10">
                                    <input type="text" v-model="row.huxing_map_info"/>
                                 </div>
                              </div>
                              <hr />


                             <button type="submit" class="am-btn am-btn-primary">提交</button>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </transition>
      `,
      props:['id'],
      mounted:function(){
         console.log(this.id);
      },
      methods:{

      },
      data:function(){
         return {
            row:{
               huxing_map:{
                  ting:[],
                  wei:[],
                  wo:[],
                  chu:[],
                  yang:[],
               },
            },
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
                                    <ul class="am-nav admin-sidebar-list am-text-center" id="user-sibe-nav">
                                       <router-link  activeClass="am-active" tag="li" to="/user/info" exact>
                                          <a >我的资料</a>
                                       </router-link>
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
         </div>
      `,
      mounted:function(){
         this.init();
      },
      methods:{
         init(){
         },
         sideBarHide(){
            $('#user-side-menu-bar').offCanvas('close');
         },
      },
      data:function(){
         return{
            activeIs:'info',
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
                  <div class="am-panel am-panel-default">
                     <div class="am-panel-bd">
                        <span style="font-weight:800" class="am-text-lg">私信</span>
                     </div>
                  </div>
                  <div v-if="userMessage === null">
                     哎呀出错了！
                  </div>
                  <div v-else-if="userMessage == false">
                     没有消息。。。
                  </div>
                  <div v-else>
                     <div class="user-message-item am-panel am-panel-default" v-for="item in userMessage">
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
      store,
      mounted:function(){

      },
      methods:{
         haveRead(arr){
            for(let item of arr){
               if(item.status === 'unread'){
                  $.post('/api/envelope/read',{id:item.id})
                     .thne(res=>{
                        store.dispatch('message/saveUserMessage',0);
                     })
               }
            }
         },
      },
      computed:{
         userMessage(){
            return store.getters['message/user'];
         }
      },
      data:function(){
         return {
         }
      }
   }


   const webMessageComponent = {
      template:
      `
         <transition>
            <div class="content">
               <div id="web-message-page">
                  <div class="am-panel am-panel-default">
                     <div class="am-panel-bd">
                        <span style="font-weight:800" class="am-text-lg">站内消息</span>
                     </div>
                  </div>
                  <div v-if="getWebMessage === null">
                     哎呀出错了！
                  </div>
                  <div v-else-if="getWebMessage == false">
                     没有消息。。。
                  </div>
                  <div v-else>
                     <div class="user-message-item am-panel"  v-for="item in getWebMessage" :class="[item.status === 'read' ?'am-panel-default': 'am-panel-primary']">
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
      store,
      mounted:function(){

      },
      methods:{
         haveRead(arr){
            for(let item of arr){
               if(!item.status){
                  $.post('/api/adminMessageStatus/userRead',{id:item.id})
                     .thne(res=>{
                        store.dispatch('message/saveWebMessage',0);
                     })
               }
            }
         },
      },
      computed:{
         getWebMessage(){
            return store.getters['message/web'];
         }
      },
      data:function(){
         return {
         }
      }
   }


/**
 *  user page children [My commissioned page]
 */
   const userCommissionedComponent = {
      template:
      `
         <transition>
            <div class="content">
               <div class="am-container">
                  <div class="am-g">
                     <div class="header">
                        <div class="am-panel am-panel-default">
                           <div class="am-panel-bd">
                              <span style="font-weight:800" class="am-text-lg">我的委托</span>
                           </div>
                        </div>
                     </div>
                     <div class="body" v-if="commissioned != false">
                        <div class="am-panel am-panel-default" v-for="item in commissioned">
                           <div class="am-panel-hd">
                              {{item.created_at}}
                           </div>
                           <div class="am-panel-bd">
                              <span>{{item.city}}</span>
                              <span>{{item.community}}</span>
                              <span>{{item.building_number}}号楼</span>
                              <span>{{item.unit_number}}单元</span>
                              <span>{{item.house_number}}号门牌</span>
                              <span class="am-badge am-badge-default am-fr am-margin-right am-text-middle">{{statusList[item.status]}}</span>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </transition>
      `,
      mounted:function(){

         this.getUserCommissioneds();
      },
      methods:{
         getUserCommissioneds(){

            $.post('/api/commissioned/statusList').then(res=>{
               this.statusList = res.data;
            })

            $.post('/api/commissioned/read').then(res=>{
               this.commissioned = res.data;
            })
         },
      },
      data:function(){
         return {
            commissioned : null,
            statusList:null,
         }
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

   const messageComponent =
   {
      store,
      template:
      `
         <div class="content">
            <div class="am-g">
               <div class="am-container">
                     <div class="">
                        <div class="am-u-md-3 am-hide-sm">
                           <div class="am-panel am-panel-default">
                              <div class="am-panel-bd">
                                 <ul class="am-nav admin-sidebar-list am-text-center" id="message-sibe-nav">
                                    <router-link  activeClass="am-active" tag="li" to="/message/webMessage" exact>
                                       <a>
                                       站内消息
                                          <span v-show="getWebMessageCount >0" class="am-badge am-badge-default am-fr am-margin-right am-text-middle">{{getWebMessageCount}}</span>
                                       </a>
                                    </router-link>
                                    <router-link  activeClass="am-active" tag="li" to="/message/userMessage" exact>
                                       <a>
                                          私信
                                       <span v-show="getUserMessageCount >0" class="am-badge am-badge-default am-fr am-margin-right am-text-middle">{{getUserMessageCount}}</span>
                                       </a>
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

         </div>
      `,
      mounted:function(){
         console.log('now is message page');
      },

      computed:{
         getUserMessageCount(){
            return store.getters['message/userMessageCount'];

         },
         getWebMessageCount(){
            return store.getters['message/webMessageCount'];
         },
      },
   }

/**
 *  message dafault page component
 */
const messageDefaultComponent = {
   template:
   `
      <h1>请选择查看消息类型</h1>
   `,
   mounted:function(){
      console.log('now page is defaule page');
   }
}


const NotFoundComponent = {
   template:
   `
      <transition>
         <h1>404 Not Found</h1>
      </transition>
   `,

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
         porps:true,
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
         path:'/user/maifang/completion/:id',
         props:true,
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
               path:'commissioned',
               component:userCommissionedComponent,
            },
            {
               path:'transactionLog',
               component:userTransactionLogComponent,
            }
         ]
      },
      {
         path:'/message',
         component:messageComponent,
         meta:{title:'消息'},
         children:[
            {
               path:'webMessage',
               component:webMessageComponent,
            },
            {
               path:'userMessage',
               component:userMessageComponent,
            },
            {
               path:'',
               component:messageDefaultComponent,
            }
         ]
      },
   ];



/**
 * VueRouter
 * @type {VueRouter}
 */
   const router = new VueRouter({
      routes
   });




/**
 *  main Vue
 * @AuthorHTL
 * @DateTime  2018-01-16T14:13:22+0800
 * @param     {null}                 ){         this.getLoggingStatus();         bus.$on('loginSuccess',()                                                                            [description]
 * @param     {null}                 methods:{        getLoggingStatus(){           $.post('/api/user/is_login',{want:['username','email','tel','id','permission']})             .then(res [description]
 * @param     {null}                 downEvent(){           $('.userBarDown').dropdown('toggle');        }                                                                           [description]
 * @param     {null}                 logoutEvent(                                                                                                                          [description]
 * @return    {null}                                                                                                                                                       [description]
 */
   const $v = new Vue({
      router,
      store,
      data:{
         user:null,
         userMessage:0,
         webMessage:0,
      },
      mounted:function()
      {

         store.dispatch('isLogin',{want:['username','email','tel','id','permission']});


      },
      methods:
      {
         downOpenEvent($el)
         {
            $($el).dropdown('open');
         },
         downCloseEvent($el){
            $($el).dropdown('close');
         },
         logoutEvent()
         {
            $.post('/api/user/logout').then(res=>{
               store.dispatch('user/saveUser',null);
               router.push({path:'/'});
            })
         },
         sideBarHide(){
            $('#user-side-menu-bar').offCanvas('close');
         },
      },
      computed: {
         msg(){
            return store.getters['msg'];
         },
         getUser(){
            return this.$store.getters['user/user'];
         },
         getUserMessage(){
            return this.$store.getters['message/userMessageCount'];
         },
         getWebMessage(){
            return this.$store.getters['message/webMessageCount'];
         },
         getIpCity(){
            return store.getters['getIpCity'];
         }
      }
   }).$mount('#appHome');



   router.beforeEach((to, from, next) => {
      store.dispatch('progress','start');

      // let path = to.path;
      // if(!$v.user && !(path == '/' || path == '/login' || path  == '/signup' || path =='/pleaseLogin' || path=='/readHouses')){
      //       return next('/pleaseLogin');
      // }
      return next();
   })

   router.afterEach((to, from) => {

      store.dispatch('progress','done');

   })


})();
