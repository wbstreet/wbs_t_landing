if($('.localscroll').length){    
		$('.localscroll').localScroll({
			lazy: true,
			offset: {
				top: - ($('#mainHeader').height() + 20)
			}
		});
	}

/*
|--------------------------------------------------------------------------
| AUTOCLOSE BOOSTRAP MENU
|--------------------------------------------------------------------------
*/
$('.nav a').on('click', function(){

	if($('.navbar-toggle').css('display') != 'none')
    $('.navbar-toggle').click();

});