<?php if(!defined('WB_URL')) { header('Location: ../index.php'); 	exit(0); }	
?><!DOCTYPE html>
<html>
<head>
<?php
if(function_exists('simplepagehead')) {
	simplepagehead(); 
} else { ?>
<title><?php page_title(); ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=<?php if(defined('DEFAULT_CHARSET')) { echo DEFAULT_CHARSET; } else { echo 'utf-8'; }?>" />
<meta name="description" content="<?php page_description(); ?>" />
<meta name="keywords" content="<?php page_keywords(); ?>" />
<?php }
if(function_exists('register_frontend_modfiles')) {
	register_frontend_modfiles('css');
	register_frontend_modfiles('jquery');
	register_frontend_modfiles('js');
} ?>





<!-- Bootstrap -->
<link href="<?php echo TEMPLATE_DIR; ?>/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo TEMPLATE_DIR; ?>/css/responsive-slider.css" rel="stylesheet">
<!--link href="<?php echo TEMPLATE_DIR; ?>/css/animate.css" rel="stylesheet"-->
<link href="<?php echo TEMPLATE_DIR; ?>/css/font-awesome.min.css" rel="stylesheet">
  
    <link rel="stylesheet" type="text/css" media="all" href="<?php echo TEMPLATE_DIR; ?>/css/styles.css">
    <script type="text/javascript" src="<?php echo TEMPLATE_DIR; ?>/js/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="<?php echo TEMPLATE_DIR; ?>/js/responsiveCarousel.js"></script>

    <!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script> <![endif]-->

    <!-- third party plugins  -->
    <!--<script type="text/javascript" src="<?php echo TEMPLATE_DIR; ?>/js/bootstrap.js"></script>-->
    <!--script type="text/javascript" src="<?php echo TEMPLATE_DIR; ?>/js/jquery.easing.1.3.js"></script-->

    <link href="<?php echo TEMPLATE_DIR; ?>/editor.css" rel="stylesheet">
    <link href="<?php echo TEMPLATE_DIR; ?>/template.css" rel="stylesheet">


    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="HandheldFriendly" content="true" />
    <meta name="MobileOptimized" content="320" />

    <?php if(function_exists('wbs_core_include')) wbs_core_include(['functions.js', 'windows.js', 'windows.css']); ?>
    <?php require_once(WB_PATH.'/include/captcha/captcha.php'); ?>

</head>
<body data-spy="scroll" data-target="#scrollTarget" data-offset="150" style="overflow: visible;">
    <!-- Primary Page Layout 
    ================================================== -->
    <!-- globalWrapper -->
    <div id="globalWrapper" class="localscroll">
	<!-- header -->
	<header id="mainHeader" class="navbar-fixed-top" role="banner">
	    <div class="container">
		    <nav class="navbar navbar-default scrollMenu" role="navigation">
			    <div class="navbar-header">
				    <button type="button" class="navbar-toggle" data-toggle=".collapse" data-target=".navbar-ex1-collapse"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
				    <a class="navbar-brand" href="<?php echo WB_URL; ?>/"><img src="<?php echo WB_URL; ?>/media/img/logo.png" alt="<?php echo WEBSITE_TITLE; ?>" title="<?php echo WEBSITE_TITLE; ?>"></a>
			    </div>
			    <div class="collapse navbar-collapse navbar-ex1-collapse" id="scrollTarget" style='text-align:right;'>
				    <ul class="nav navbar-nav pull-right">
					    <?php echo $allmenue; ?>
				    </ul>
			    </div>
		    </nav>
	    </div>
	</header>
    </div>

    <!--<div  class="mainHeader-spacer" id="home"></div>-->

    <!-- header -->

	
<?php 
if ($isstartpage) {

	$slider_page_ids = '1';
	$slider_image_base = WB_URL.'/media/slide/slide'; // added: number + .jpg
	include('snippets/responsiveslides.php');
//	include('snippets/top-grids.php');
	
//	include('snippets/2col-intro.php');
//	include('snippets/parallax.php');
//	include('snippets/form.php');
//	include('chat/chat.php');
}


echo $alloutput; 
?>

<footer>
	<?php if (function_exists('echo_creator')) echo_creator();?>
</footer>
</div><!-- global wrapper -->
<!-- End Document 
================================================== -->



<script type="text/javascript" src="<?php echo TEMPLATE_DIR; ?>/js/jquery.scrollTo-1.4.3.1-min.js"></script>
<script type="text/javascript" src="<?php echo TEMPLATE_DIR; ?>/js/jquery.localscroll-1.2.7-min.js"></script>
<script type="text/javascript" src="<?php echo TEMPLATE_DIR; ?>/js/template.js"></script>

<!-- Для слайдера -->
<script src="<?php echo WB_URL; ?>/include/added_js/responsiveslides.min.js"></script>

<script type="text/javascript">
$(function(){
  $('.crsl-items').carousel({
    visible: 4,
    itemMinWidth: 180,
    itemEqualHeight: 370,
    itemMargin: 9,
  });
  
  $("a[href=#]").on('click', function(e) {
    e.preventDefault();
  });
});
$(document).ready(function() {
  $("[data-toggle]").click(function() {
    var toggle_el = $(this).data("toggle");
    $(toggle_el).fadeToggle();
  });

  // добавляет отступ в зависимости от высоты шапки
  $('body').css({
    marginTop: 'calc('+getComputedStyle($('header')[0]).height+' - 30px)'
  });
});

// добавляет отступ в зависимости от высоты шапки
$(window).resize(function() {
    $('body').css({
        marginTop: 'calc('+getComputedStyle($('header')[0]).height+' - 30px)'
    });
});
</script>



</body></html>

</body>
</html>
