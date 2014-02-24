<?php
	$cs = Yii::app()->clientScript;

	$cs->registerCssFile($this->getAssetsUrl().'/css/bootstrap.min.css');
	$cs->registerCssFile($this->getAssetsUrl().'/css/bootstrap-theme.min.css');
	$cs->registerCssFile($this->getAssetsUrl().'/css/main.css');
	//$cs->registerCssFile($this->getAssetsUrl().'/css/fancybox/jquery.fancybox-buttons.css');
	
	$cs->registerCoreScript('jquery');
	// $cs->registerCoreScript('jquery.ui');
	$cs->registerScriptFile($this->getAssetsUrl().'/js/vendor/bootstrap.min.js', CClientScript::POS_END);
	$cs->registerScriptFile($this->getAssetsUrl().'/js/slider.js', CClientScript::POS_END);
	$cs->registerScriptFile($this->getAssetsUrl().'/js/main.js', CClientScript::POS_END);
	//$cs->registerScriptFile($this->getAssetsUrl().'/js/lib/jquery.fancybox-buttons.js', CClientScript::POS_END);
	//$cs->registerScriptFile('http://api-maps.yandex.ru/2.0.27/?load=package.standard&lang=ru-RU', CClientScript::POS_HEAD);
	
	// $cs->registerScriptFile($this->getAssetsUrl().'/js/lib/jquery.timepicker.addon.js', CClientScript::POS_END);
	// $cs->registerScriptFile($this->getAssetsUrl().'/js/lib/jquery.ui.timepicker.ru.js', CClientScript::POS_END);
	// $cs->registerScriptFile($this->getAssetsUrl().'/js/common.js', CClientScript::POS_END);

?><!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title><?php echo $this->title; ?></title>
		<!--[if IE]>
	    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	    <![endif]-->
	</head>
	<body>
		<div class="main-block clearfix">
            <div class="content-container">
				<?php echo $content;?>
			 </div>
            <div class="nav-container">
                <div class="logo"><a href="/"><img src="<?=$this->getAssetsUrl()?>/img/logo.png" alt=" " ></a></div>
                <span class="phone"><i class="red-icon"></i> +7 3452 700 899</span>
                <nav>
                    <ul class="categories">
                        <li class="root"><a href="#">Двери</a></li>
                        <li class="root"><a href="#">Лестницы</a></li>
                        <li class="root"><a href="#">Item 3</a></li>
                        <li class="root sub">
                            <a href="#">Кухни</a>
                            <ul class="sub-categories">
                                <li><a href="#">Классика</a></li>
                                <li><a href="#">Item 2</a></li>
                                <li><a href="#">Item 3</a></li>
                                <li><a href="#">Item 4</a></li>
                            </ul>
                        </li>
                        <li class="root"><a href="#">Item 5</a></li>
                        <li class="root"><a href="#">Item 6</a></li>
                        <li class="root"><a href="#">Item 7</a></li>
                        <li class="root"><a href="#">Item 8</a></li>
                    </ul>
                </nav>

                <nav class="right-menu">
                    <?php if(!empty($this->clips['main'])) echo $this->clips['main']; ?>
                    <div class="address">
                        <i class="red-icon"></i> Ветеранов труда, 34 "Б", стр. 7
                    </div>
                </nav>
            </div>
        </div>
	</body>
</html>