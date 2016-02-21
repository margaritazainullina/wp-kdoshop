jQuery(document).ready(function($) {
	$("#nf-settings-title").click(function () {
		$header = $(this);
		//getting the next element
		$content = $header.next();
		//open up the content needed - toggle the slide- if visible, slide up, if not slidedown.
		$content.slideToggle(500, function () {
			//execute this after slideToggle is done
			//change text of header based on visibility of content div
			$header.text(function () {
				//change text based on condition
				return $content.is(":visible") ? 'Close Settings' : 'View Settings';
			});
		});
	});
	
	select_pages_checked();
	
	$('#specific_pages').click (function(){
		select_pages_checked();
	});
	
	function select_pages_checked() {
		if ($('#specific_pages').prop('checked') == false) {
			$(".pagechecklist input").prop('disabled', true);
		} else {
			$(".pagechecklist input").prop('disabled', false);
		}
	}
});
