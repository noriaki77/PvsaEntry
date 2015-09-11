/*
 * DateSupport.js
 *
 * Copyright (c) 2008 nori (norimania@gmail.com)
 * Licensed under the MIT
 *
 * $Date: 2008-07-16 20:00
 */

$(function(){
	var dateObj = new Date();
	var dateSupport = {
		year: {
			start: 1900,
			end: dateObj.getFullYear()+20
		},
		month: {
			start: 1,
			end: 12
		},
		day: {
			start: 1,
			end: 31
		},
		fn: function(className,start,end){
			if($(className).length<1) return false;
			$(className).each(function(){
				var mat = document.createElement("div");
				var matId = $(this).attr("id")+"_mat";
				$(mat).css("display","none").attr("id",matId).addClass("mat");
				if(className.match(/year/)) $(mat).addClass("year");
				else if(className.match(/month/)) $(mat).addClass("month");
				else $(mat).addClass("day");
				var year = new Array();
				for(var i=0,j=start;j<(end+1);i++,j++){
					year[i] = j;
					var anchor = document.createElement("a");
					var txt = document.createTextNode(year[i]);
					$(anchor).attr("href","#"+year[i]).append(txt);
					$(mat).append(anchor);
					if(className.match(/year/) && j%10==0){
						$(anchor).addClass("heading");
						if(i!=0){
							var br = document.createElement("br");
							$(br).insertBefore(anchor);
						}
					}else if(className.match(/day/) && j%7==0){
						var br = document.createElement("br");
						$(br).insertAfter(anchor);
					}
				}
				$("body").append(mat);
				$(this).click(function(event){
					$("body").css("position","relative");
					var pos = $(this).offset();
					$("#"+matId).css({
						"position": "absolute",
						"top": pos.top+($("#"+matId.split("_mat")[0]).height()*1.5),
						"left": pos.left
					});
					var input = $(this).attr("id");
					$(".mat").not("#"+matId).hide();
					$("#"+matId).show();
					$("a","#"+matId).click(function(){
						$("#"+input).attr("value",$(this).attr("href").split("#")[1]);
						return false;
					});
					event.stopPropagation();
				});
			});
			$("body").click(function(event){
				$(".mat").hide();
			});
		}
	}
	dateSupport.fn(".year",dateSupport.year.start,dateSupport.year.end);
	dateSupport.fn(".month",dateSupport.month.start,dateSupport.month.end);
	dateSupport.fn(".day",dateSupport.day.start,dateSupport.day.end);
});