$(document).ready(function(){
	$(".panel_command").hover(
			function(){
				var panel_content = $(this).attr('rel');
				$("#panel_content_"+panel_content).show();
			},
			function(){
				$(".panel_content").hide();
			}
	);
});
