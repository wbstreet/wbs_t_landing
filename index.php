<?php
if(!defined('WB_URL')) {
	header('Location: ../index.php');
	exit(0);
}

$top_grids_page_ids = '6,7,4,9,10,11';
$topics_picture_directory = WB_URL.'/media/grid';

$makeFrontpageStatic = false; //true or false
$makeFrontpageStaticPassword = "saveit"; //change this!


$make_editlink = false;
if ($wb->is_authenticated()) { $make_editlink = true; }

$isstartpage=false;
$toParentLink = '';

$allmenue = '';
$start_page_id = $wb->page_id;

$alloutput = '';
$pw = '';
$static_hint = '';




if(!isset($page_id)) {
	//Definitiv die Startseite
	$isstartpage=true;
	$show_parent = 0;
	$query = "SELECT * FROM ".TABLE_PREFIX."pages WHERE parent = '0' AND menu=1 AND visibility='public' ORDER BY position ASC";	
	$query_pages = $database->query($query);
	
} else {
	$query = "SELECT * FROM ".TABLE_PREFIX."pages WHERE page_id = '".$page_id."' AND menu=1 ORDER BY position ASC";	
	$query_page = $database->query($query);
	$query_page = $query_page->fetchRow();
	
	if ($query_page['level'] >= 2)  {
    	$query = "SELECT * FROM ".TABLE_PREFIX."pages WHERE page_id = '".$page_id."' AND menu=1 ORDER BY position ASC";	
    	$query_pages = $database->query($query);
	} else {
    
    	//Hat das, was aufgerufen wurde, Kinder?
    	$query = "SELECT * FROM ".TABLE_PREFIX."pages WHERE parent = '".$page_id."' AND menu=1 AND visibility='public' ORDER BY position ASC";	
    	$query_pages = $database->query($query);
    	if($query_pages->numRows() > 0) {
    		//Ja, hat Kinder, diese Abfrage zeigen
    	} else {
    		//nur diese eine Seite zeigen
    		$query = "SELECT * FROM ".TABLE_PREFIX."pages WHERE page_id = '".$page_id."' AND menu=1 AND visibility='public' ORDER BY position ASC";	
    		$query_pages = $database->query($query);
    	}
	}
	$toParentLink = WB_URL;
	
}


/*	
if (LEVEL != 0)  {
	$query = "SELECT * FROM ".TABLE_PREFIX."pages WHERE page_id = '".PARENT."'";	
	$query_pages = $database->query($query);
	$results_array = $query_pages->fetchRow();
	$toParentLink = page_link($results_array['link']);
	
	if ($wallsLevel == $wallsmaxlevel + 1) {$framereloadlink = $toParentLink; }
	$show_parent = PARENT;
}
*/


/*=============================
WICHTIG:
Der Tatsächliche Link #irgendwas kann erst weiter unten festgestellt werden.
Es sollte einen Redirect geben
*/


/*
$static_hint = '';
$pw = '';
if ($isstartpage) { 
	$showparentwall = false;
	if ($makeFrontpageStatic) {
		$pw = $_GET['pw'];
		if ($pw != $makeFrontpageStaticPassword) {$pw = '';}
		if ($pw == '') {$static_hint = "<h3>This is the uncached frontpage!</h3>"; } else {$showHelpLink = false;}
	}
}
*/
	

$allmenue = '';
//link zu übergeordneter:
if ($toParentLink != '') {
	$allmenue = '<li><a href="'.$toParentLink.'">&nbsp;<i class="fa fa-home"></i>&nbsp;<br/>Главная</a></li>';		
}
$allmenue .= '<li class=""><a href="#home">&nbsp;<i class="fa fa-caret-up"></i>&nbsp;<br/>Вверх</a></li>';


if($query_pages->numRows() > 0) { //hier geht los: Seiten als Anschnitte sammeln
	
	$i = 0;
	while($this_page = $query_pages->fetchRow()) {	
		$i++;
		$link = $this_page['link'];
		$menu_title = $this_page['menu_title'];
		$page_title = $this_page['page_title'];
		$page_id = $this_page['page_id'];
		$icon = $this_page['keywords'];
					
		$wb->page_id = $page_id;
		//echo " | ".$i.":".$page_id;
		
		$editlink = '';
		if ($make_editlink) { $editlink = '<a class="editlink" href="'.ADMIN_URL.'/pages/modify.php?page_id='.$page_id.'">EDIT</a>';}
		
		//----- Die Seite holen: / get the pages:
		include("pagesegment.php");
		$output = '<div class="container"><div id="gotopid'.$page_id.'">'.$editlink.'
		<!-- h2 class="text-center page_title page_title_'.$page_id.'">'.$page_title.'</h2 -->
		'.$pageout.'
		</div></div>
		';
		$allmenue .= '<li class=""><a href="#gotopid'.$page_id.'">&nbsp;<i class="fa fa-'.$icon.'"></i>&nbsp;<br />'.$menu_title.'</a></li>';
		$alloutput .= $output;
	} //ende while
	
	//$MenueItems = $i;
}
//$allmenue .= '<li class=""><a href="#services">&nbsp;<i class="fa"></i>&nbsp;<br />Услуги</a></li>';
$allmenue .= '<li class=""><a href="#gotopidForm">&nbsp;<i class="fa"></i>&nbsp;<br />Заказать</a></li>';
//$allmenue .= '<li style="background: #d80202;" class=""><a style="color: #ffffff;" href="'.WB_URL.'/pages/td-kupec.php">&nbsp;<i class="fa fa-'.$icon.'"></i>&nbsp;<br />т/д Купец</a></li>';
//die('HIER');

$page_id = $start_page_id;
$wb->page_id = $start_page_id;

/*
$anker=0;


if ($wallsLevel < $wallsmaxlevel AND $createLinksOnParentPages) {
	$allmenue .= $allmenueNoJS;
} else {
	$allmenue .= $allmenueJS."\n//-->\n</script>\n<noscript>".$allmenueAnker."</noscript>";
}

if ($allwidth < 1600) {$allwidth = 1600; }
$output = '';
$showiframes=false;



if ($showparentwall) {$showwallcontent=true;}
if ($static_hint == '' AND $useGoogleAnalytics) {include("googleanalytics.php");}
*/
ob_start();			
require('front.php');			
$output = ob_get_contents();			
ob_end_clean(); 


$norobots = '<meta name="robots" content="noindex,nofollow" />';	
if ($pw == '') {
	if ($static_hint == '')  $output = str_replace($norobots, '', $output);
	echo $output;	
} else {
	$staticpath = WB_PATH."/index.html";	
	$output = str_replace($norobots, '', $output);
	
	$handle = fopen($staticpath, 'w');
	fwrite($handle, $output);
	fclose($handle);
	$staticpath = WB_URL."/index.html";
	echo '<a href="'.$staticpath.'">$staticpath</a>';
}

?>