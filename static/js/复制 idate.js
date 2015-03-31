$(function() {
	$(document).icalendar();
});

(function($) {
	$.fn.extend({
		"icalendar": function(option) {
			var defaults = {
				"prev": "#prev", //前一个月份
				"ititle": "#title_time", //当前月
				"next": "#next", //后一个月份
			};
			var ops = $.extend(defaults, option);
			var myDate = new Date();
			var nowDate = new Date();
			var monthArr = ["JANUARY", "FEBRUARY", "MARCH", "APRIL", "MAY", "JUNE", "JULY", "AUGUST", "SEPTEMBER", "OCTOBER", "NOVEMBER", "DECEMBER"];
			var week = ["SUN", "MON", "TUE", "WED", "THU", "FRI", "SAT"];

			var nowYear = nowDate.getFullYear();
			var nowMonth = nowDate.getMonth();
			var nowDt = nowDate.getDate();
			var nowStr = nowYear + "-" + (nowMonth + 1) + "-" + nowDt;

			function timer() {
				$("#icalendar td").text("").removeAttr("title");
				var year = myDate.getFullYear(); //年
				var month = myDate.getMonth(); //0-11月份
				var trueMonth = month + 1; //1-12月份
				var date = myDate.getDate(); //1-31日
				var day = myDate.getDay(); //星期X 0-6,0代表星期日
				var num = day - date % 7 + 1;
				num = num < 0 ? num + 7 : num;
				//				$(ops.title).text(monthArr[month] + " | " + year);
				$(ops.ititle).html(monthArr[month] + " | " + year);

				//给标题赋值，周日，周一。。。
				$("tr").eq(0).children("th").each(function(i, o) {
					$(o).text(week[i]);
				});
				var i = 1;
				var end;
				switch (trueMonth) {
					case 1:
					case 3:
					case 5:
					case 7:
					case 8:
					case 10:
					case 12:
						end = 31;
						break;
					case 4:
					case 6:
					case 9:
					case 11:
						end = 31;
						break;
					case 2:
						end = ((year % 4 == 0 && year % 100 != 0) || (year % 400 == 0)) ? 29 : 28;
						break;
					default:
						break;
				}
				var str = year + "-" + trueMonth + "-" + i;
				$("tr").eq(1).find("td").eq(num).text(i).attr("title", str);
				$("#icalendar td").each(function() {
					if ($(this).parent().index() == 1) {
						if ($(this).prev().text() != "") {
							i++;
							var str = year + "-" + trueMonth + "-" + i;
							$(this).text(i).attr("title", str);
						}
					}
					if ($(this).parent().index() > 1 && i < end) {
						i++;
						var str = year + "-" + trueMonth + "-" + i;
						$(this).text(i).attr("title", str);
					}
				});
				//已选择的日期高亮显示
				var selstr = $("#seltime span").text();
				var d = $("#seltime span").attr("date");
				focus_str = "<div class='td-focus'>" + d + "</div>";
				$("#icalendar td[title='" + selstr + "']").html(focus_str);
			}

			$("td").click(function() {
				if ($(this).text() != "") {
					var value = $(this).attr("title");
					var i = $(this).text();
					$(this).text("");
					$(".td-focus").each(function() {
						num = $(this).text();
						$(this).parent().html(num);
					});
					focus_str = "<div class='td-focus'>" + i + "</div>";
					$(this).append(focus_str);
					$("#seltime span").text(value).attr("date", i);
				}

			}).mouseover(function() {
				if ($(this).text() != "") {
					$(this).css({
						"color": "#D84C29"
					});
				}
			}).mouseout(function() {
				if ($(this).text() != "") {
					$(this).attr("style", "");
				}
			});
			//点击上一月
			$(ops.prev).click(function() {
				var year = myDate.getFullYear(); //年
				var month = myDate.getMonth(); //0-11月份
				var i = 1;
				if (month == 0) {
					year--;
					month = 12;
				}
				var str = year + "/" + month + "/" + i;
				myDate = new Date(str);
				timer();
			});
			//点击下一月
			$(ops.next).click(function() {
				var year = myDate.getFullYear(); //年
				var month = myDate.getMonth(); //0-11月份
				var i = 1;
				month += 2; //取出来的month是0-11，new Date() 的时候是1-12
				if (month > 12) {
					year++;
					month = 1;
				}

				var str = year + "/" + month + "/" + i;
				myDate = new Date(str);
				timer();
			});
			timer();
			$("#icalendar td[title=" + nowStr + "]").click();
		}
	});
})(jQuery);