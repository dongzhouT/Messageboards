$(function() {
	$(".mycontainer").mouseover(function() {
		$(this).find(".content-close").removeClass("display-none");
	}).mouseout(function() {
		$(this).find(".content-close").addClass("display-none");
	});
	//留言板滑动到底部
	var mtop = document.getElementById("msgs").scrollHeight;
	//$(".msgs").scrollTop(mtop);
	$(".dropmsg").click(function() {
		if (!confirm("确定要删除这条留言？(游客不可以删除留言！)")) {
			return false;
		}
	});
	$("#signup").click(function() {
		$("#signup-id").show();
		$(".coverdiv").show();
		$("body").css("overflow-y", "hidden");
		$("#signup-id").css({
			"top": ($(window).height() - $("#signup-id").height()) / 2 + "px",
			"left": ($(window).width() - $("#signup-id").width()) / 2 + "px",
		});
		return false;
	});
	$(".coverdiv").click(function() {
		$("#signup-id").hide();
		$(".coverdiv").hide();
		$("body").css("overflow-y", "visible");
	});
	//放大图片
	$(".mycontainer .guest-portrait").on("mouseover", function(event) {
		var x = 20;
		str = "<img class='big-portrait' src='" + $(this).attr("src") + "'/>";
		$("body").append(str);
		$(".big-portrait").css({
			top: event.pageY + x + "px",
			left: event.pageX + x + "px",
		});

	}).on("mouseout", function(event) {
		$(".big-portrait").remove();
	}).on("mousemove", function(event) {
		var x = 20;
		$(".big-portrait").css({
			top: event.pageY + x + "px",
			left: event.pageX + x + "px",
		});
	});
//	$("#addmsg").click(function(){
//		val=$("#content").val();
//		alert(val.length);
//		return false;
//	});
	function check(){
		val=$("#content").val();
		if(val.length>500){
			alert("内容不能超过500，现在已有"+val.length);
			return false;
		}
		return true;
		
	}

});