<?php 
$pageout = '<div class="container-pid'.$page_id.'">';
	
$b = 1;
$blocksARR = array();
while ( $b <= 4) {
	ob_start();		
	page_content($b);
	$temp = ob_get_contents();
	ob_end_clean();
	$b++;
	if ($temp != '') { 	$blocksARR[] = $temp;} else { break; } //Nicht alle 4 abfragen, sondern beim erste leeren raus. Sonst dauert das ewig.			
}	
$blocks = count($blocksARR);

$mdARR = array(12,12,6,4,3); //0=12
$nowmd = $mdARR[$blocks];


$out = '<!-- '.$blocks.' --><div class="row"><div class="content">';
$done = '';
if ($blocks  == 2) {
	//Typischer Fall: Hauptblock mit kleinem Block 2
	if ( 0.3 * strlen($blocksARR[0] ) > strlen($blocksARR[1] ) ) {
		$done = '<div class="col-md-8 page-grid"><div class="page-grid-inner">'.$blocksARR[0].'</div></div>
		<div class="col-md-4 page-grid"><div class="page-grid-inner">'.$blocksARR[1].'</div></div>';
		$out .= $done;
	}
}

if ($done == '') {
	foreach ($blocksARR as $block) {
		$out .= '<div class="col-md-'.$nowmd.' page-grid"><div class="page-grid-inner">'.$block.'</div></div>';
	}
}


$out .= '</div></div>';
//$pageout .= $out;

//Gibt es UNterseiten?
$subquery = "SELECT link, menu_title, position FROM ".TABLE_PREFIX."pages WHERE parent = '".$page_id."' AND visibility = 'public' ORDER BY 'position' ASC ";
$query_subpages = $database->query($subquery);
if ($query_subpages->numRows() > 0) {
	//Auf diese Seite hier direkt verlinken:	
	$out .= '<div class="readmore-link"><!--<a class="readmore-btn" href="'.WB_URL.PAGES_DIRECTORY.$this_page['link'].PAGE_EXTENSION.'">'.$TEXT['READ_MORE'].'</a>--></div>';
	
}
$pageout .= $out.'</div>';	

/*
//Diese in  neuen Block als iFrame einhängen
$out = '';
//Menü erzeugen und ersten gleich darstellen
$subquery = "SELECT link, menu_title, position FROM ".TABLE_PREFIX."pages WHERE parent = '".$page_id."' AND visibility = 'public' ORDER BY 'position' ASC ";
$query_subpages = $database->query($subquery);
$j=0;	
if ($query_subpages->numRows() > 0) {
	$out = '<div class="row"><div class="content">';		
	while($results_arraysub = $query_subpages->fetchRow()) {			
		$j++;
		$menu_titlesub = $results_arraysub['menu_title'];
		$linksub = $results_arraysub['link'];
		if ($j == 1) { $out .= ('<iframe src="'.page_link($linksub).'" width="100%" height="600" frameborder="0" scrolling="auto" ALLOWTRANSPARENCY="true">Nix iFrames? Hier die Links:'); }						
		$out .=  '<br/><a href="'.page_link($linksub).'">'.$menu_titlesub.'</a>';
	} 
	$out .=  ('</iframe>');	
}

*/

?>	
