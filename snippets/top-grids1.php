<?php
if(!defined('WB_URL')) { header('Location: ../../../index.php'); exit(0); }

$theq = "SELECT * FROM `".TABLE_PREFIX."pages` WHERE page_id IN (".$top_grids_page_ids.") ORDER BY FIND_IN_SET(page_id, '".$top_grids_page_ids."');" ;
$query_pages = $database->query($theq);

if($query_pages->numRows() < 1) { return ''; }

//OK, Go:
$i = 0;
$blocksARR = array();
$iconsARR = explode(',',$top_grids_page_icons);

while($page = $query_pages->fetchRow()) {
	$i++;
	$ahref= '<a href="'.WB_URL.PAGES_DIRECTORY.$page['link'].PAGE_EXTENSION.'">';
	
	$description = $page['description'];
	if ( $description == '') {
		$description = 'Edit the Description of this page';
		if ($wb->is_authenticated()) { $description .= '<br /><a href="'.WB_URL.'/'.ADMIN_DIRECTORY.'/pages/settings.php?page_id='.$page['page_id'].'">[EDIT]</a>'; }
	}
	//Start output:
	$blocksARR[] = '
<div class="col-md-[COLMD]">
	<div class="top-grid wow flipInY" data-wow-offset="0" data-wow-delay="0.4s">
		<div class="top-grids-inner">
			<h4>'.$page['menu_title'].' [COLMD]</h4>					
			<div class="icon"><i class="fa '.$iconsARR[$i - 1].' fa-3x"></i></div>
			<p>'.$description.'</p>
			<div class="ficon">'.$ahref.$TEXT['READ_MORE'].'</a> <i class="fa fa-long-arrow-right"></i></div>
		</div>
	</div>
</div>';
} //end while

$blockstart = '<div class="row"><div class="content">';
$blockend = '</div></div>';	

$blocks = count($blocksARR);

if ($blocks <= 4) { 
	$divider = $blocks; 
} else  {
	$divider = 4;
	if ($blocks % 4 == 0) { $divider = 4; }
	if ($blocks % 3 == 0) { $divider = 3; }
}
$mdARR = array(12,12,6,4,3); //0=12
$nowmd = $mdARR[$divider];

$i = 0; $alli = 0; 
$allout = '<div id="news" class="top-grids text-center"><div class="container">'.$blockstart;

foreach ($blocksARR as $block) {
	$i++; $alli++; 
	$allout .= str_replace('[COLMD]',$nowmd,$block);
	if ($i >= $divider) {
		
		//echo "<p>BLOCKSTART</p>";
		//echo "<p>$i / $divider</p>";
		$i = 0;
		$rest = $blocks - $alli;
		if ($rest > 0 AND $rest < 4) {
			$divider = $rest;
			$nowmd = $mdARR[$divider];
			$allout .= $blockend;
		}		
	}
}
$allout .= $blockend.'</div></div>';
echo $allout;	
?>