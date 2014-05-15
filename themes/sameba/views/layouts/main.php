<?php
	$cs = Yii::app()->clientScript;

	$cs->registerCssFile($this->getAssetsUrl().'/css/bootstrap.min.css');
	$cs->registerCssFile($this->getAssetsUrl().'/css/bootstrap-theme.min.css');
	$cs->registerCssFile($this->getAssetsUrl().'/css/main.css?v=1');
	//$cs->registerCssFile($this->getAssetsUrl().'/css/fancybox/jquery.fancybox-buttons.css');
	
	$cs->registerCoreScript('jquery');
	// $cs->registerCoreScript('jquery.ui');
	$cs->registerScriptFile($this->getAssetsUrl().'/js/vendor/bootstrap.min.js', CClientScript::POS_END);
	$cs->registerScriptFile($this->getAssetsUrl().'/js/main.js', CClientScript::POS_END);

?><!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title><?php echo $this->title; ?></title>
		<!--[if IE]>
	    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	    <![endif]-->
	</head>
	<body>
        <div class="row home-page">
            <div class="col-sm-3 col-sm-push-9 nav-container">
                <div class="logo"><a href="/"><img src="<?=$this->getAssetsUrl()?>/img/logo.png" alt=" " ></a></div>
                <span class="phone"><i class="red-icon"></i> <?=Phones::getPhone()?></span>
                <nav class="nav-categories">
                    <div class="navbar-header">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".categories">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <!-- <a class="navbar-brand" href="#">Категории</a> -->
                        </div>
                    </div>
                    <?php if(!empty($this->clips['categories'])) echo $this->clips['categories']; ?>
                </nav>

                <nav class="right-menu">
                    <?php if(!empty($this->clips['main'])) echo $this->clips['main']; ?>
                    <div class="address">
                        <? $place = Places::getMain(); ?>
                        <?if($place):?>
                            <a href="/contacts/<?=$place->id?>"><i class="red-icon"></i> <?=$place->name?></a>
                        <?endif;?>
                    </div>
                </nav>
            </div>
            <div class="col-sm-9 col-sm-pull-3 content-container">
                <?php echo $content;?>
            </div>
        </div>
	</body>
</html>