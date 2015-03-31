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
			m = nowMonth + 1;
			d = nowDt;
			if (m < 10) {
				m = "0" + m;
			}
			if (d < 10) {
				d = "0" + d;
			}
			var nowStr = nowYear + "-" + m + "-" + d;

			function timer() {
				$("#icalendar td").text("").removeAttr("title");
				var year = myDate.getFullYear(); //年
				var month = myDate.getMonth(); //0-11月份
				var trueMonth = month + 1; //1-12月份
				var date = myDate.getDate(); //1-31日
				var day = myDate.getDay(); //星期X 0-6,0代表星期日
				var num = day - date % 7 + 1;
				var str = "";
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
				m = trueMonth;
				if (trueMonth < 10) {
					m = "0" + trueMonth;
				}
				d = i;
				if (i < 10) {
					d = "0" + i;
				}
				var str0 = year + "-" + m + "-" + d;
				$("tr").eq(1).find("td").eq(num).text(i).attr("title", str0);
				//返回当月有留言的日期
				$.ajax({
					type: "get",
					url: "index.php?c=msg&a=ajaxtime",
					data: {
						datetime: str0,
						duration: end,
					},
					dataType: "text",
					async: true, //同步请求将锁住浏览器，用户其它操作必须等待请求完成才可以执行。
					success: function(data) {
						if ("" != data) {
							$("#month_msg_date").text("留言日期："+data);
							//显示小白点
							$("#icalendar td").each(function() {
								str = $(this).attr("title");
								if ("" != str && ($("#month_msg_date").text()).indexOf(str) >= 0) {
									hasmsg = "<div class='td-hasmsg'><div class='td-circle'></div></div>";
									$(this).append(hasmsg);
								}
							});
						}
						$("#loading").html("加载完成");
					},
					beforeSend: function() {
						//$("#msgs").html("");
						$("#loading").html("正在加载中......");
					}
				});
				$("#icalendar td").each(function() {
					var str = "";
					if ($(this).parent().index() == 1) {
						if ($(this).prev().text() != "") {
							i++;
							d = i;
							if (d < 10) {
								d = "0" + d;
							}

							str = year + "-" + m + "-" + d;

							$(this).text(i).attr("title", str);
						}
					}
					if ($(this).parent().index() > 1 && i < end) {
						i++;
						d = i;
						if (d < 10) {
							d = "0" + d;
						}
						str = year + "-" + m + "-" + d;
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
					var msgflg = 0;//有无白点
					if ($(this).children(".td-hasmsg").length > 0) {
						msgflg = 1;
					}
					var value = $(this).attr("title");
					var i = $(this).text();
					var str = "";
					var hasmsg = "<div class='td-hasmsg'><div class='td-circle'></div></div>";
					$(this).text("");
					$(".td-focus").each(function() {
						num = $(this).text();
						if ($(this).siblings(".td-hasmsg").length > 0) {

							$(this).parent().html(num).append(hasmsg);
						} else {
							$(this).parent().html(num);
						}
						$(this).remove();
					});
					focus_str = "<div class='td-focus'>" + i + "</div>";
					$(this).append(focus_str);
					if (msgflg == 1) {
						$(this).append(hasmsg);
					}
					//							}
					$("#seltime span").text(value).attr("date", i);
					$.ajax({
						type: "get",
						url: "index.php?c=msg&a=ajaxmsg",
						data: {
							datetime: $(this).attr("title"),
						},
						dataType: "json",
						async: true, //同步请求将锁住浏览器，用户其它操作必须等待请求完成才可以执行。
						success: function(data) {
							if (data.length > 0) {
								for (var i in data) {
									str += "<div class='mycontainer'><img src='" + data[i].guest_portrait + "'  class='guest-portrait' title='" + data[i].uname + "' /><span class='uname'>" + data[i].uname + "</span><span class='time'>" + data[i].timetoread + "</span><br><pre class='content'>" + data[i].content + "</pre><a class='dropmsg' href='ind.php?c=demo&a=delmsg&id=" + data[i].id + "'><div class='content-close bd-r-100 display-none'>×</div></a></div>";
								}
								$("#msgs").html(str);
								$("#success").html("have data!");
							} else {
								$("#success").html("no data!");
								str = "<center><h2>今日没有留言</h2></center>";
								$("#msgs").html(str);

							}
							$("#loading").html("<span class='green'>加载完成！</span>");
						},
						beforeSend: function() {
							$("#msgs").html("");
							$("#loading").html("<span class='red'>正在加载中......</span>");
						}
					});
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