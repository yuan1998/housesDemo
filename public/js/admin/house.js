;(function(){
	'use strict';

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	new Vue({
		el:'#appHouse',
		data:{
			page:1,
			list:[{id:1,title:'tt'}],
			statusList:[],
		},
		mounted:function(){
			this.getList().getStatusList();
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
	})

})();