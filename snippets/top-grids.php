<p id="services"></p>

<h2 style="text-align:center;">НАШИ УСЛУГИ</h2>
<?php
if(!defined('WB_URL')) { header('Location: ../../../index.php'); exit(0); }

$theq = "SELECT * FROM `".TABLE_PREFIX."pages` WHERE page_id IN (".$top_grids_page_ids.") ORDER BY FIND_IN_SET(page_id, '".$top_grids_page_ids."');" ;
$query_pages = $database->query($theq);

if($query_pages->numRows() < 1) { 
	//do nothing 
} else {
	$i = 0;
	echo '<!-- top-grids --><div class="top-grids text-center"><div class="container">';
	while($page = $query_pages->fetchRow()) {
		$i++;
		$ahref= '<a href="'.WB_URL.PAGES_DIRECTORY.$page['link'].PAGE_EXTENSION.'">';
		//Start output:
		$l = '
<div class="col-md-2"><div class="top-grid">
		'.$ahref.'<img style="width:50%;" class="img-responsive" src="'.WB_URL.'/media/grids/'.$i.'.png" alt="'.$page['page_title'].'"></a>
		<h5>'.$ahref.$page['menu_title'].'</a></h5> 
		 <p>'.$page['description'].'</p>';
		//$l .= '<a class="caption-btn" href="'.WB_URL.PAGES_DIRECTORY.$page['link'].PAGE_EXTENSION.'">'.$TEXT['READ_MORE'].'</a>';
	$l .= '</div>
	'.$ahref.'<div class="btn-go"></div></a></div>';
	echo $l;
		} //end while
		echo '<div class="clearfix"> </div></div></div><!-- end top-grids -->';
} 

?>

			
				
