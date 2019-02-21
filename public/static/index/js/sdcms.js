function setTab(name,cursel,n){
	for(i=1;i<=n;i++){
		var menu=$('#'+name+i);
		var con=$("#con_"+name+"_"+i);
		menu[0].className=i==cursel?"hover":"";
		con[0].style.display=i==cursel?"block":"none";
	}
}

function checksearch(the)
{
	if(the.key.value=="")
	{
		$.fn.tips({content:'请输入关键字'});
		the.key.focus();
		return false
	}
}

function addfavorite(the)
{
	var url,data;
	url=webroot+"user/ajax.asp";
	data="act=favorite";
	data+="&t0="+encodeURIComponent(the);
	$.ajax({
	type:"post",
	cache:false,
	url:url,
	data:data,
	error:function(){alert("fail");},
	success:function(_)
	{
		var act=_.substring(0,1);
		var info=_.substring(1);
		switch(act)
		{
			case "0":
				$.fn.tips({type:"error",content:info,time:3000});
				break;
			case "1":
				$.fn.tips({type:"error",content:info,time:3000});
				break;
			case "2":
				$.fn.tips({type:"ok",content:info,time:3000});
				break;
			default:
				alert(_);
				break;
		}
	}});
	return false
}

function avatar_success()
{
	$.fn.tips({type:"ok",content:"\u5934\u50cf\u4fdd\u5b58\u6210\u529f"});
	setTimeout(function(){location.href='?';},1000)
}

function addNum(t0){var o=$('#'+t0);o.parent().css('position','relative').append($('<span>+1</span>').css({'position':'absolute','left':'0px','top':'-15px','color':'#f00'}).animate({fontSize:80,opacity:0},800,function(){$(this).remove();}))}

$(function(){
	//userpanel
	if($("#userpanel").length>0)
	{
		$.ajax(
		{
			type:"post",
			cache:false,
			url:webroot+"plug/ajaxlogin.asp",
			data:"url="+location.href,
			success:function(_){$("#userpanel").html(_)}
		});
	}
	//subnav
	$(".menu li").hover(function(){
		$("dl",this).css("display","block");
		$(this).addClass("hover");
	},function(){
		$("dl",this).css("display","none");
		$(this).removeClass("hover");
	});
	//
})