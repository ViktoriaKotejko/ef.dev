jQuery(document).ready(function() {	
	var $ptemplate_select = jQuery('select#page_template'),
		$ptemplate_box = jQuery('#et_ptemplate_meta');
		
	$ptemplate_select.live('change',function(){
		var this_value = jQuery(this).val();
		$ptemplate_box.find('.inside > div').css('display','none');
		
		switch ( this_value ) {
			
			case 'page-template-portfolio.php':
				$ptemplate_box.find('.et_pt_portfolio').css('display','block')
				break;
			case 'page-price.php':
				$ptemplate_box.find('.et_pt_price').css('display','block')
				break;	
			case 'main-page.php':
				$ptemplate_box.find('.et_pt_main').css('display','block')
				break;
			default:
                $ptemplate_box.find('.et_pt_info').css('display','block');
		}
	});
	
	$ptemplate_select.trigger('change');
});