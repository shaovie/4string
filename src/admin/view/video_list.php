<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=10">    
	<link href="/asset/css/bootstrap.min.css<?php echo '?v=' . ASSETS_VERSION;?>" rel="stylesheet">
	<link href="/asset/css/ace.min.css<?php echo '?v=' . ASSETS_VERSION;?>" rel="stylesheet">
    <link rel="stylesheet" href="/asset/css/ace-rtl.min.css<?php echo '?v=' . ASSETS_VERSION;?>">
    <link rel="stylesheet" href="/asset/css/ace-skins.min.css<?php echo '?v=' . ASSETS_VERSION;?>">
    <!--[if lte IE 8]>
	<link rel="stylesheet" href="/asset/css/ace-ie.min.css<?php echo '?v=' . ASSETS_VERSION;?>" />
    <![endif]-->
	<link href="/asset/css/common.css<?php echo '?v=' . ASSETS_VERSION;?>" rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="/asset/css/fontawesome3/css/font-awesome.min.css<?php echo '?v=' . ASSETS_VERSION;?>">
	<script type="text/javascript" src="/asset/js/jquery-1.10.2.min.js<?php echo '?v=' . ASSETS_VERSION;?>"></script>
	<script type="text/javascript" src="/asset/js/common.js<?php echo '?v=' . ASSETS_VERSION;?>"></script>
	<script type="text/javascript" src="/asset/js/bootstrap.min.js<?php echo '?v=' . ASSETS_VERSION;?>"></script> 
	<link type="text/css" rel="stylesheet" href="/asset/css/default.css<?php echo '?v=' . ASSETS_VERSION;?>">
    <!--[if IE 7]>
    <link rel="stylesheet" href="/asset/css/fontawesome3/css/font-awesome-ie7.min.css<?php echo '?v=' . ASSETS_VERSION;?>">
    <![endif]-->
</head>
<body class="no-skin">
	<h3 class="header smaller lighter blue"><span style="margin-right:20px">事件总数：<?php echo $totalNum;?></span><a href="/admin/Video/addPage" class="btn btn-primary">新建</a><span class="refresh">刷新</span></h3>
	<table class="table table-striped table-bordered table-hover">
		<tbody>
		<tr>
			<th class="text-center" style="width:250px;">备注</th>
			<th class="text-center" style="width:200px;">预览图</th>
			<th class="text-center" style="width:200px;">状态</th>
			<th class="text-center" style="width:200px;">排序</th>
			<th class="text-center">操作</th>
		</tr>
        <?php foreach ($videoList as $video):?>
		<tr>
			<td style="text-align:center;vertical-align:middle;">
                <div><?php echo $video['remark']?></div>
            </td>
			<td style="text-align:center;vertical-align:middle;padding:5px;">
                <?php foreach ($video['image_url'] as $image_url):?>
                <img src="<?php echo $image_url?>" height="60" width="60">
                <?php endforeach?>
			</td>
			<td style="text-align:center;vertical-align:middle;">
                <div><?php echo $video['state']?></div>
			</td>
			<td style="text-align:center;vertical-align:middle;">
                <div><?php echo $video['sort']?></div>
			</td>
			<td style="text-align:center;vertical-align:middle;">
				<a class="btn btn-xs btn-info" href="/admin/Video/editPage?videoId=<?php echo $video['id']?>">编辑</a>
                <a class="btn btn-xs btn-info" href="/admin/Video/del?videoId=<?php echo $video['id'];?>" onclick="return confirm(&#39;确认删除吗？&#39;);return false;">删除</a>
			</td>
		</tr>
        <?php endforeach?>
		</tbody>
	</table>
    <?php echo $pageHtml;?>
</body>
</html>
