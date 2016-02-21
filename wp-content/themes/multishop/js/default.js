jQuery(document).ready(function() {
    jQuery("#top-product").owlCarousel({
    autoPlay: false, //Set AutoPlay to 3 seconds
    items : 4,
    itemsDesktop : [1199,3],
    itemsDesktopSmall : [979,3]
    });
     jQuery(".next3").click(function(){
	 jQuery("#top-product").trigger('owl.next');
	 })
	 jQuery(".prev3").click(function(){
	 jQuery("#top-product").trigger('owl.prev');
	 })
});
jQuery(document).ready(function () {
	jQuery('#horizontalTab').easyResponsiveTabs({
		type: 'default', //Types: default, vertical, accordion           
		width: 'auto', //auto or any width like 600px
		fit: true,   // 100% fit in a container
		closed: 'accordion', // Start closed if in accordion view
		activate: function(event) { // Callback function if tab is switched
			var $tab = jQuery(this);
			var $info = jQuery('#tabInfo');
			var $name = jQuery('span', $info);
			$name.text($tab.text());
			$info.show();
		}
	});
	jQuery('#verticalTab').easyResponsiveTabs({
		type: 'vertical',
		width: 'auto',
		fit: true
	});
});
jQuery(document).ready(function() {
	 jQuery(".page-numbers").removeClass("next");
	 jQuery(".page-numbers").removeClass("prev");
	 jQuery(".form-submit input").addClass("send-btn");
	
});
