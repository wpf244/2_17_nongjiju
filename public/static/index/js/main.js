$(function() {
	$(".link-bottom>.ui-drop").each(function() {
		$(this).hover(function(e) {
			//e.stopPropagation();
			// var a = this.index();
			// $(this).siblings().find(".ui-drop-sub").hide();
			$(this).children(".ui-drop-sub").toggle();
		})
	})
})