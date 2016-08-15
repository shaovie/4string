<!DOCTYPE html>
<html >
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=10">
	<title>4string后台管理系统</title>
	<meta name="description" content="">
	<meta name="keywords" content="">
    <link href="/asset/css/bootstrap.min.css<?php echo '?v=' . ASSETS_VERSION;?>" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="/asset/css/fontawesome3/css/font-awesome.min.css<?php echo '?v=' . ASSETS_VERSION;?>">
    <script type="text/javascript" src="/asset/js/jquery-1.10.2.min.js<?php echo '?v=' . ASSETS_VERSION;?>"></script>
    <script type="text/javascript" src="/asset/js/bootstrap.min.js<?php echo '?v=' . ASSETS_VERSION;?>"></script>

    <script src="/asset/js/ace-elements.min.js<?php echo '?v=' . ASSETS_VERSION;?>"></script>
    <script src="/asset/js/ace.min.js<?php echo '?v=' . ASSETS_VERSION;?>"></script>
	<link rel="stylesheet" href="/asset/css/ace.min.css<?php echo '?v=' . ASSETS_VERSION;?>">
    <link rel="stylesheet" href="/asset/css/ace-rtl.min.css<?php echo '?v=' . ASSETS_VERSION;?>">
    <link rel="stylesheet" href="/asset/css/ace-skins.min.css<?php echo '?v=' . ASSETS_VERSION;?>">
	<link type="text/css" rel="stylesheet" href="/asset/css/default.css<?php echo '?v=' . ASSETS_VERSION;?>">
    <!--[if lte IE 8]>
    <link rel="stylesheet" href="/asset/css/ace-ie.min.css<?php echo '?v=' . ASSETS_VERSION;?>" />
    <![endif]-->
    <!-- ace settings handler -->
    <script src="/asset/js/ace-extra.min.js<?php echo '?v=' . ASSETS_VERSION;?>"></script>
    <!--[if IE 7]>
    <link rel="stylesheet" href="/asset/css/font-awesome-ie7.min.css<?php echo '?v=' . ASSETS_VERSION;?>">
    <![endif]-->
    <style>body{background-color: #F8FAFC;}</style>
    <script type="text/javascript">
    function navtoggle(stitle){
    	if(stitle==''){
    		stitle='控制台';	
    	}
    	document.getElementById('activeworker').innerText=stitle;
    }
    try{ace.settings.check('navbar' , 'fixed')}catch(e){}
</script>
</head>
<body scrolling="no" style="overflow: visible;">
<div class="navbar navbar-default" id="navbar">
<div class="navbar-container" id="navbar-container">
<div class="navbar-header pull-left">
    <a href="/admin/Home" class="navbar-brand">
        <small>
            <i class="icon-leaf"></i>
            <span id="accountname">四弦首页内容管理系统</span>
        </small>
    </a>
</div>

<div class="navbar-header pull-right" role="navigation">
<ul class="nav ace-nav" style="height:45px">
	<li class="light-blue">
		<a data-toggle="dropdown" href="#" class="dropdown-toggle">
       		<span class="user-info">
				<small>欢迎光临,</small>
				<?php echo $account;?>
			</span>
			<i class="icon-caret-down"></i>
		</a>
		<ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
			<li>
				<a onclick="navtoggle(&#39;退出系统&#39;)" href="/admin/Logout">
					<i class="icon-off"></i>
					退出
				</a>
			</li>
		</ul>
	</li>
</ul>
</div>
</div>
</div>

<div class="main-container" id="main-container">
    <script type="text/javascript">
        try{ace.settings.check('main-container' , 'fixed')}catch(e){}
    </script>
    <div class="main-container-inner">
        <a class="menu-toggler" id="menu-toggler" href="#">
            <span class="menu-text"></span>
        </a>
        <div class="sidebar" id="sidebar">
            <script type="text/javascript">
                try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
            </script>
            <div class="sidebar-shortcuts" id="sidebar-shortcuts">              
                <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
                    <span class="btn btn-success"></span>
                    <span class="btn btn-info"></span>
                    <span class="btn btn-warning"></span>
                    <span class="btn btn-danger"></span>
                </div>
            </div>
			<ul class="nav nav-list">                                            
                <li class="open">
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-shopping-cart"></i>
                        <span class="menu-text">网站管理</span>
                        <b class="arrow icon-angle-down"></b>
                    </a>                    
                    <ul class="submenu" style="display: block;">
                        <!-- 子菜单 第二级-->
                        <li><a onclick="navtoggle(&#39;网站管理 - &gt; 图片管理&#39;)" href="/admin/Event/listPage" target="main">
                            <i class="icon-double-angle-right"></i>
                                图片管理
                             </a>   
						</li>
                        <li> <a onclick="navtoggle(&#39;网站管理 - &gt; 视频管理&#39;)" href="/admin/Video/listPage" target="main">
                             <i class="icon-double-angle-right"></i>
                               视频管理
                             </a>  
						</li>                               
                     </ul>
                </li>
				<li>
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-info-sign"></i>
                        <span class="menu-text"> 权限管理</span>
                        <b class="arrow icon-angle-down"></b>
                    </a>                    
                    <ul class="submenu">
					    <li>
                            <a onclick="navtoggle(&#39;权限管理 - &gt; 新增用户 &#39;)" href="/admin/Employee/addPage" target="main">
                             <i class="icon-double-angle-right"></i>
                                 新增用户                                
                            </a>
                        </li>
						<li>
                            <a onclick="navtoggle(&#39;权限管理 - &gt; 管理员列表 &#39;)" href="/admin/Employee/listPage" target="main">
                            <i class="icon-double-angle-right"></i>
                                管理员列表                                
                            </a>
                        </li>
					</ul>
				</li>
				<li>
                    <a href="#" class="dropdown-toggle">
                        <i class="icon-info-sign"></i>
                        <span class="menu-text">网站配置</span>
                        <b class="arrow icon-angle-down"></b>
                    </a>                    
                    <ul class="submenu">
					</ul>
				</li>
            </ul>

            <script type="text/javascript">
                try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
            </script>
        </div>

        <div class="main-content">
            <div class="breadcrumbs" id="breadcrumbs">
                <script type="text/javascript">
                    try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
                </script>

                <ul class="breadcrumb">
                    <li>
                        <i class="icon-home home-icon"></i>
                    </li>
                    <li class="active"><span id="activeworker">首页</span></li>
                </ul><!-- .breadcrumb -->

                <div class="nav-search" id="nav-search">

                </div><!-- #nav-search -->
            </div>
            <div class="page-content" style="padding: 1px 13px 24px;">
	            <iframe scrolling="yes" frameborder="0" style="width:100%;min-height:850px; overflow:visible;" name="main" id="main" src="<?php echo $iframe?>"></iframe>
            </div>
        </div>

    </div><!-- /.main-container-inner -->

</div>
</body></html>
