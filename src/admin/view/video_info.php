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
	<script type="text/javascript" src="/asset/js/goods.js<?php echo '?v=' . ASSETS_VERSION;?>"></script>
    <link type="text/css" rel="stylesheet" href="/asset/css/datetimepicker.css<?php echo '?v=' . ASSETS_VERSION;?>">
    <script type="text/javascript" src="/asset/js/datetimepicker.js<?php echo '?v=' . ASSETS_VERSION;?>"></script>
</head>
<body class="no-skin">
    <input id="videoId" name="videoId" type="hidden" value="<?php echo (isset($video['id']) ? $video['id'] : 0);?>"/>
	<h3 class="header smaller lighter blue"><?php echo $title?></h3>
	<form action="<?php echo $action?>" method="post" enctype="multipart/form-data" class="form-horizontal" role="form" id="save-form">
		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-left"> 备注：</label>
			<div class="col-sm-9">
				<input type="text" name="remark" id="remark" maxlength="100" class="span7" value="<?php if (!empty($video['remark'])){echo $video['remark'];}?>">
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-left"> 状态：</label>
			<div class="col-sm-9" id="state-radio">
				<div style="margin-right:20px;display:inline;">
                    <input type="radio" name="state" value="0" id="isshow0" <?php if (isset($video['state']) && $video['state'] == 0) { echo 'checked="true"';}?> >无效</div>
				<div style="margin-right:20px;display:inline;">
                    <input type="radio" name="state" value="1" id="isshow1" <?php if (isset($video['state']) && $video['state'] == 1) { echo 'checked="true"';}?> `>有效</div>
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-left">排序：</label>
			<div class="col-sm-9">
				<input type="text" name="sort" id="sort"
                onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')" 
                value="<?php if (!empty($video['sort'])){echo $video['sort'];}?>">
				<p class="help-block">数值越大，排序越靠前（当前最大可用值<?php echo time();?>）</p>
          	</div>
		</div>
        <!-- SWFUpload控件 -->
        <div id="divSWFUploadUI" class="hidden">
            <p>
            <span id="spanButtonPlaceholder"></span>
            <input id="btnCancel" type="hidden" value="全部取消" disabled="disabled"/>
            </p>
        </div>
        <!-- END -->
        <!-- SWFUpload控件 -->
        <div id="divSWFUploadUI3" class="hidden">
            <p>
            <span id="spanButtonPlaceholder3"></span>
            <input id="btnCancel3" type="hidden" value="全部取消" disabled="disabled"/>
            </p>
        </div>
        <!-- END -->
		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-left"> 视频预览图(最多5张)：</label>
			<div class="col-sm-9">
                <div id="prev_event_img" class="fileupload-preview thumbnail" style="width: 100%; height: 150px;">
                <ul>
                <?php if (!empty($video['image_url'])):?>
                    <?php foreach($video['image_url'] as $img):if(!empty($img)):?>
                       <li style="display:inline">
                        <img style="width:100px;height:120px;margin-right:2px;" src="<?php echo $img;?>" />
                        <a href='javascript:void(0)' onclick="delGoodsImg(this);return false;">删除</a>
                       </li> 
                    <?php endif;endforeach;?>
                <?php endif?>
                </ul>
                </div>
                <!-- SWFUpload控件 -->
                <div id="divSWFUploadUI2">
                    <p>
                        <span id="spanButtonPlaceholder2"></span>
						<input id="btnCancel2" type="hidden" value="全部取消" disabled="disabled"/>
                    </p>
                </div>
                <!-- END -->
			</div>
		</div>
		

		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-left">视频1：</label>
			<div class="col-sm-9">
				<input type="text" style="width:500px;" name="video1" id="video1" value="<?php if (!empty($video['video_url'][0])){echo $video['video_url'][0];}?>">
          	</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-left">视频2：</label>
			<div class="col-sm-9">
				<input type="text" style="width:500px;" name="video2" id="video2" value="<?php if (!empty($video['video_url'][1])){echo $video['video_url'][1];}?>">
          	</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-left">视频3：</label>
			<div class="col-sm-9">
				<input type="text" style="width:500px;" name="video3" id="video3" value="<?php if (!empty($video['video_url'][2])){echo $video['video_url'][2];}?>">
          	</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-left">视频4：</label>
			<div class="col-sm-9">
				<input type="text" style="width:500px;" name="video4" id="video4" value="<?php if (!empty($video['video_url'][3])){echo $video['video_url'][3];}?>">
          	</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-left">视频5：</label>
			<div class="col-sm-9">
				<input type="text" style="width:500px;" name="video5" id="video5" value="<?php if (!empty($video['video_url'][4])){echo $video['video_url'][4];}?>">
          	</div>
		</div>

		<div class="form-group">
			<label class="col-sm-2 control-label no-padding-left"></label>
			<div class="col-sm-9">
				<button type="button" id="save-btn" class="btn btn-primary span2" >保存</button>
			</div>
		</div>
		
        <input type="hidden"  name="thumb_img" id="thumb_img" class="thumb_img" value="<?php if (!empty($video['image_url'])){echo $video['image_url'];}?>">
        <div id="event_img">
        <?php if (!empty($video['image_url'])):?>
            <?php foreach($video['image_url'] as $img):if(!empty($img)):?>
               <input type="hidden" name="event_img[]" value="<?php echo $img;?>" />
            <?php endif; endforeach;?>
            <?php endif?>
        </div>
	</form>
	<script>
        $('#save-btn').click(function(){
            var url = $("#save-form").attr("action");
            var event_imgs = '';
             $("#event_img input").each(function(i,v){
                 event_imgs += $(v).val()+'|';
             });
            $.post(url,{
                videoId:$("#videoId").val(),
                remark:$("#remark").val(),
                sort:$("#sort").val(),
                state:$("#state-radio input[name='state']:checked").val(),
                imageUrl:event_imgs,
                videoUrl1:$("#video1").val(),
                videoUrl2:$("#video2").val(),
                videoUrl3:$("#video3").val(),
                videoUrl4:$("#video4").val(),
                videoUrl5:$("#video5").val()
                },function(data){
                if(data.code==0) {
                    alert(data.msg);
                    window.location.href= data.url;
                } else {
                    alert(data.msg);
                    return false;
                }
            },'json');
        });
	</script>
    <!-- SWFupload异步图片上传 -->
    <script type="text/javascript" src="/asset/js/swfupload/swfupload.js<?php echo '?v=' . ASSETS_VERSION;?>"></script>
    <script type="text/javascript" src="/asset/js/swfupload/swfupload.swfobject.js<?php echo '?v=' . ASSETS_VERSION;?>"></script>
    <script type="text/javascript" src="/asset/js/swfupload/swfupload.queue.js<?php echo '?v=' . ASSETS_VERSION;?>"></script>
    <script type="text/javascript" src="/asset/js/swfupload/fileprogress.js<?php echo '?v=' . ASSETS_VERSION;?>"></script>
    <script type="text/javascript" src="/asset/js/swfupload/handlers.js<?php echo '?v=' . ASSETS_VERSION;?>"></script>
    <!-- END -->
    <script type="text/javascript" src="/asset/js/swfupload/init.js<?php echo '?v=' . ASSETS_VERSION;?>"></script>
    <!-- <link href="/asset/js/swfupload/swfupload.css<?php echo '?v=' . ASSETS_VERSION;?>" rel="stylesheet" type="text/css"/> -->
</body>
</html>
