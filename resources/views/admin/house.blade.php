<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>house</title>
	<link rel="stylesheet" type="text/css" href="/bower_components/amazeui/dist/css/amazeui.min.css">	
	<link rel="stylesheet" type="text/css" href="/css/admin/house.css">
</head>
<body>
	<div id="appHouse">
		<div class="am-g">
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
				<tbody>
					<tr v-for="item in list">
						<td>@{{item.id}}</td>
						<td>@{{item.title || '暂无'}}</td>
						<td>@{{item.community || '暂无'}}</td>
						<td>@{{item.expect_price || '暂无'}}</td>
						<td>@{{item.area || '暂无'}}</td>
						<td>
							<span>@{{item.building || '暂无'}}</span>
							<span>@{{item.unit || '暂无'}}</span>
							<span>@{{item.house_number || '暂无'}}</span>
						</td>
						<td>@{{item.visiting_count || '暂无'}}</td>
						<td>@{{item.contack || '暂无'}}</td>
						<td>@{{item.tel || '暂无'}}</td>
						<td>@{{item.created_at || '暂无'}}</td>


						<td>
							<select :value="item.status" v-on:change="changeStatus(item.id,$event)">
								<option v-for="(value,key) in statusList" :value="key">@{{value}}</option>
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
	<script type="text/javascript" src="/bower_components/jquery/dist/jquery.min.js"></script>
	<script type="text/javascript" src="/bower_components/amazeui/dist/js/amazeui.min.js"></script>
	<script type="text/javascript" src="/node_modules/vue/dist/vue.js"></script>
	<script type="text/javascript" src="/js/admin/house.js"></script>
</body>
</html>