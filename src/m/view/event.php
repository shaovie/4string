<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="description" content="第4弦传媒文化有限公司" />
    <meta name="Keywords" content="第四弦,第4弦,第四弦传媒文化,电机厂,传媒公司,798" />
    <meta name="Robots" content="all" />
    <title>第4弦传媒文化有限公司</title>

	<link href="/asset/css/video-js.css<?php echo '?v=' . ASSETS_VERSION;?>" rel="stylesheet">
    <link href="/asset/css/swiper.min.css<?php echo '?v=' . ASSETS_VERSION;?>" rel="stylesheet">
    <script type="text/javascript" src="/asset/js/videojs-ie8.min.js<?php echo '?v=' . ASSETS_VERSION;?>"></script> 
    <script type="text/javascript" src="/asset/js/video.js<?php echo '?v=' . ASSETS_VERSION;?>"></script> 

    <style type="text/css">
    body {background-color: white; text-align:center; margin:0px auto; padding:0; height:1580; width: 833;}
    h1 {margin:0; padding:0;}
    h2 {margin:0; padding:0;}
    #left {float:left;  padding:0px;}  
    #right {float:right;  padding:0px;}  
    div#footer {background-color: white ;clear:both;text-align:center;}

    .container {padding:0px;}
    .box {margin-bottom: 0px;}

    .swiper-container {
    width: 833px;
    height: 473px;
    margin: auto;
    }
    .swiper-slide {
    text-align: center;
    font-size: 18px;
    background: #fff;

    /* Center slide text vertically */
    display: -webkit-box;
    display: -ms-flexbox;
    display: -webkit-flex;
    display: flex;
     -webkit-box-pack: center;
     -ms-flex-pack: center;
     -webkit-justify-content: center;
     justify-content: center;
     -webkit-box-align: center;
     -ms-flex-align: center;
     -webkit-align-items: center;
     align-items: center;
    }
    .swiper-button-prev {
        background-image: url("/asset/images/left_arrow.png");
    }
    .swiper-button-next {
        background-image: url("/asset/images/right_arrow.png");
    }
    .swiper-button-prev .swiper-button-disabled {
        background-image: url("/asset/images/left_arrow_gray.png")
    }
    .swiper-button-next .swiper-button-disabled {
        background-image: url("/asset/images/right_arrow_gray.png");
    }
    </style>

</head>
<body align="center">
    <div style="margin: 0 0 0 0">
        <div id="left" style="margin: 29 0 0 50">
            <a href="/"><img id="ui_logo" border="0" src="/asset/images/ui_green.png" style="display:none"></a>
        </div>
        <div id="right" style="margin: 64 65 0 0">
            <a href="/m/Home/index" ><img id="ui_camera" border="0" src="/asset/images/ui_camera.png" style="display:none"></a>
        </div>
        <div id="footer"></div>

        <div class="container" style="margin: 26 0 0 0"></div>
    </div>
</body>



<body align="center">
<div>
    <?php foreach($eventList as $idx => $event):?>
    <div class="swiper-container">
        <div class="swiper-wrapper">
           <?php foreach($event['image_urls'] as $imgurl):?>
           <div class="swiper-slide">
                <div align="center" style="margin: 0 0 10 0">
                    <img border="0" src="<?php echo $imgurl?>">
                </div>
           </div>
           <?php endforeach?>
        </div>
       <div class="swiper-button-prev"></div>
       <div class="swiper-button-next"></div>
       <!--<div class="swiper-pagination"></div>-->
    </div>
    <?php if ($idx < count($eventList) - 1):?>
    <div align="center" style="margin: 40 0 26 0">
        <img border="0" src="/asset/images/ui_arrow.png">
    </div>
    <?php endif?>
    <?php endforeach?>

    <div align="center" style="margin: 40 0 26 0">
        <img border="0" src="/asset/images/ui_arrow.png">
    </div>
    <div align="center" style="margin: 0 0 10 0">
        <img border="0" src="/asset/images/ui_bg_2.jpg">
    </div>

    <div align="center">
        <div id="right" style="margin: 61 30 0 0">
            <a href="https://mp.weixin.qq.com/s?__biz=MzA4NjEwNjUyNg==&mid=506502862&idx=1&sn=6608161581736f487bafd87d704fe63a&scene=1&srcid=0814NplQ7Sf3UgB6h7aBheRq&key=305bc10ec50ec19bf86591337561a2eca8a28eb59ce7806d205b76f8f7fcf48937d40cbc68c153cf5b4e44e4b022f680&ascene=0&uin=MTM5MjMxMDc0MA%3D%3D" target="_blank"><img border="0" src="/asset/images/ui_weixin.png"></a>
        </div>

        <div id="right" style="margin: 61 11 0 0">
            <a href="http://weibo.com/u/3683929794" target="_blank"><img border="0" src="/asset/images/ui_weibo.png"></a>
        </div>
        <div id="footer"></div>
    </div>

    <HR style="margin: 34 0 0 0" padding="8" width="100%" align="center" color="#EDEDED" SIZE="2" />

    <div align="center" style="margin: 24 0 0 0">
        <img border="0" src="/asset/images/ui_binery.png">
    </div>

    <div id="left" style="margin: 15.6 0 0 53">
        <img border="0" src="/asset/images/ui_bottom.png">
    </div>
    <div id="footer"></div>
</div>
</body>

<script src="/asset/js/swiper.min.js<?php echo '?v=' . ASSETS_VERSION;?>"></script>
<script>
    document.getElementById("ui_logo").style.display = "block";
    document.getElementById("ui_camera").style.display = "block";

    var swiper = new Swiper('.swiper-container', {
    prevButton:'.swiper-button-prev',
    nextButton:'.swiper-button-next',
    pagination: '.swiper-pagination',
    paginationClickable: true
    });

</script>


</html>
