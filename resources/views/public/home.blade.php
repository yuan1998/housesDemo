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
                  <span class="am-topbar-brand">
                     <router-link  to="/" >
                         <a ><i class="am-icon-location-arrow"></i> @{{getIpCity}}</a>
                     </router-link>
                  </span>
                  <div class="am-collapse am-topbar-collapse" id="my-nav">
                     <ul class="am-nav am-nav-pills am-topbar-nav">
                        <router-link tag="li" active-class="am-active" to="/" exact>
                            <a >首页</a>
                        </router-link>
                        <router-link tag="li" active-class="am-active" to="/readHouses" exact>
                           <a >看房</a>
                        </router-link>
                        <li class="">
                           <a href="">哩个</a>
                        </li>
                     </ul>
                     <div class="am-topbar-right">
                        <ul class="am-nav am-nav-pills am-topbar-nav">
                           <li>
                              <router-link to="/user/maifang">我要卖房</router-link>
                           </li>
                           <template v-if="getUser">
                              <li v-on:mouseenter="downOpenEvent('.messageBarDown');downCloseEvent('.userBarDown');" class="am-dropdown messageBarDown">
                                 <a :class="{ 'mark' : getUserMessage+getWebMessage >0}">消息<sup></sup></a>
                                 <ul v-on:mouseleave="downCloseEvent('.messageBarDown')" class="am-dropdown-content" id="home-message">
                                    <router-link tag="li" to="/message/webMessage" active-class="am-active" exact>
                                       <a >
                                          站内消息
                                          <span v-show="getWebMessage >0 " class="am-badge am-badge-success am-fr am-margin-right am-text-middle">@{{getWebMessage}}</span>
                                       </a>
                                    </router-link>
                                    <router-link tag="li" to="/message/userMessage" active-class="am-active" exact>
                                       <a >
                                          私信
                                          <span v-show="getUserMessage >0" class="am-badge am-badge-success am-fr am-margin-right am-text-middle">@{{getUserMessage}}</span>
                                       </a>
                                    </router-link>
                                 </ul>
                              </li>
                              <li  v-on:mouseenter="downOpenEvent('.userBarDown');downCloseEvent('.messageBarDown');"  class="am-dropdown userBarDown">
                                 <a href="#" class="am-dropdown-toggle">@{{getUser.username}}<i class="am-icon-caret-down"></i></a>
                                 <ul v-on:mouseleave="downCloseEvent('.userBarDown')" class="am-dropdown-content">
                                    <li>
                                       <router-link to="/user/info">个人信息</router-link>
                                    </li>
                                    <li>
                                       <router-link to="/user/commissioned">我的委托</router-link>
                                    </li>
                                    <li>
                                       <router-link to="/user/transactionlog">交易记录</router-link>
                                    </li>
                                    <li v-if="getUser.permission > 3">
                                       <router-link to="/admin/house">后台管理</router-link>
                                    </li>
                                    <li>
                                       <a v-on:click="logoutEvent" href="#">登出</a>
                                    </li>
                                 </ul>
                              </li>
                           </template>
                           <li v-else>
                              <router-link to="/login" title="登陆">登陆</router-link>
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
      <div id="side-bar">
         <div class="user-menu-btn am-show-sm" style="position:fixed;bottom: 50px;right: 25px;">
               <a href="#user-side-menu-bar" data-am-offcanvas :class="{ 'mark' : getUserMessage+getWebMessage >0}" class="am-icon-btn am-icon-bars"><sup></sup></a>
            </div>
            <div id="user-side-menu-bar" class="am-offcanvas">
               <div class="am-offcanvas-bar " style="background: #fff;border-right:none;">
                  <div class="am-offcanvas-content" style="padding-left:0px;padding-right:0px;">
                     <div class="am-g am-g-collapse">
                        <ul class="am-nav">
                           <li class="am-nav-header">导航</li>
                           <router-link @click.native="sideBarHide" active-Class="am-active" tag="li" to="/" exact>
                              <a><i class="am-icon-home"></i>首页</a>
                           </router-link>
                           <router-link @click.native="sideBarHide" active-Class="am-active" tag="li" to="/readHouses" exact>
                              <a><i class="am-icon-building-o"></i>看房</a>
                           </router-link>
                           <router-link @click.native="sideBarHide" active-Class="am-active" tag="li" to="/user/maifang" exact>
                              <a ><i class="am-icon-money"></i>我要卖房</a>
                           </router-link>
                           <template v-if='getUser'>
                              <li class="am-nav-header">用户</li>
                              <router-link @click.native="sideBarHide" active-Class="am-active" tag="li" to="/user/info" exact>
                                 <a><i class="am-icon-user"></i>我的资料 </a>
                              </router-link>
                              <router-link @click.native="sideBarHide" active-Class="am-active" tag="li" to="/user/commissioned" exact>
                                  <a ><i class="am-icon-bell-o"></i>我的委托</a>
                              </router-link>
                              <router-link @click.native="sideBarHide" active-Class="am-active" tag="li" to="/user/transactionlog" exact>
                                 <a><i class="am-icon-align-left"></i>交易记录</a>
                              </router-link>
                              <li class="am-nav-header">消息</li>
                              <router-link @click.native="sideBarHide" active-Class="am-active" tag="li" to="/message/webMessage" exact>
                                 <a>站内消息
                                    <span v-show="getWebMessage > 0" class="am-badge am-badge-success am-fr am-margin-right am-text-middle">@{{getWebMessage}}</span>
                                 </a>
                              </router-link>
                              <router-link @click.native="sideBarHide" active-Class="am-active" tag="li" to="/message/userMessage" exact>
                                 <a>私信
                                    <span v-show="getUserMessage >0" class="am-badge am-badge-success am-fr am-margin-right am-text-middle">@{{getUserMessage}}</span>
                                 </a>
                              </router-link>
                           </template>
                           <template v-else>
                              <router-link @click.native="sideBarHide" active-Class="am-active" tag="li" to="/login" exact>
                                 <a>
                                    登录
                                 </a>
                              </router-link>
                              <router-link @click.native="sideBarHide" active-Class="am-active" tag="li" to="/signup" exact>
                                 <a>
                                    注册
                                 </a>
                              </router-link>
                           </template>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- foolter -->
      <div id="foolter"></div>
   </div>
   <script src="http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=js" type="text/javascript" charset="utf-8" async defer></script>
   <script type="text/javascript" src="/node_modules/jquery/dist/jquery.js"></script>
   <script type="text/javascript" src="/node_modules/amazeui/dist/js/amazeui.js"></script>
   <script type="text/javascript" src="/node_modules/vue/dist/vue.js"></script>
   <script type="text/javascript" src="/node_modules/vue-router/dist/vue-router.js"></script>
   <script type="text/javascript" src="/node_modules/vuex/dist/vuex.js"></script>

   <script type="text/javascript" src="/js/public/home.js"></script>
</body>
</html>
