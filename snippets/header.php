<?php
if(!defined('WB_URL')) { header('Location: ../../../index.php'); exit(0); }

ob_start(); 
show_menu2(1, SM2_ROOT, SM2_START, SM2_TRIM, '<li role="presentation" class="[class]"><a href="[url]">[menu_title]</a>', "</li>", '<ul>', '</ul>', true, '');
$topnav = ob_get_contents();
$topnav = str_replace('menu-current','active',$topnav);
ob_end_clean();
	
	
?>

<!-- header -->
<header id="mainHeader" class="navbar-fixed-top" role="banner">
	<div class="container">
		<nav class="navbar navbar-default scrollMenu" role="navigation">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
				<a class="navbar-brand" href="#"><img src="img/main-logo.png" alt="Ваш сайт уже готов"></a> </div>
				<div class="collapse navbar-collapse navbar-ex1-collapse" id="scrollTarget">
					<ul class="nav navbar-nav pull-right">
						<li class=""><a href="#home"><i class="fa fa-calculator"></i>Home</a> </li>
						<li class=""><a href="#news"><i class="fa fa-cogs"></i>News</a> </li>
						<li class=""><a href="#services"><i class="fa fa-tachometer"></i>Services</a> </li>
						<li class=""><a href="#about"><i class="fa fa-cubes"></i>About</a> </li>
						<li class=""><a href="#works"><i class="fa fa-comments"></i>Works</a> </li>
						<li class=""><a href="#team"><i class="icon-users"></i>Team</a> </li>
						<li><a href="#contactSlice"><i class="icon-mail"></i>Contact</a> </li>
					</ul>
				</div>
			</div>
		</nav>
	</div>
</header>
<a id="home"></a>
<!-- header -->