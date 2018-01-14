;(function(){
	'use strict';

	$.ajaxSetup({
	  headers: {
	    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});


	new Vue({
		el:'#vueApp',

		data:
		{
			row:{},
			msg:{'title':'添加成功～','content':'请耐心等待审核'},
			alertEl:document.querySelector('#alertBtn'),
		},

		methods:
		{
			add()
			{
				
				// load start;
				$.AMUI.progress.start();


				// response 
				$.post('/api/house/createTable',this.row).then(res=>{
					$.AMUI.progress.done();
					this.alert();
					this.row = {};
				})

			},
			alert(msg)
			{
				if(msg){
					if(typeof(msg) == 'string'){
						this.msg.title = msg.title;
						this.msg.content = msg.content;
					}else this.msg.content = msg;
				}
				this.alertEl.click();
			}

		},

	})

})();