$.fn.tab=function(i,space){
	i = i || 0;
	space = space || 0;
	var left=$(this).find(".tab-body").width()+space;
	var _this=$(this);
	var tab=function(i){
		_this.find(".tab-head").children().removeClass("hover").eq(i).addClass("hover");//head
		_this.find(".tab-body").children().each(function(index){//body
			if(index<i){
				$(this).stop().animate({
					left: -left,
				}, "slow",function(){$(this).hide();});
			}else if(index==i){
				$(this).stop().show().animate({
					left: 0
				}, "slow",function(){$(this).show();});
			}else{
				$(this).stop().animate({
					left: left
				}, "slow",function(){$(this).hide();});
			}
		});
	}
	var tabWidth=function(){
		_this.find(".tab-body").children().width(_this.find(".tab-body").width()).addClass("tab-body-list");;
		
		//_this.find(".tab-body li").height(_this.find(".tab-body").height());
	}
	tabWidth();
	$(window).resize(function(){
		tabWidth();
		left=_this.find(".tab-body").width()+space;
	})
	tab(i);
	_this.find(".tab-head").children().on("click",function(){
		if(!$(this).hasClass("hover"))
			tab($(this).index())
	})
}
function minWidth(val){
	var bw=$("html").outerWidth();
	if(bw<=val){
		$("html").addClass("phone-page");
		return true
	}else{
		$("html").removeClass("page-phone");
		return false
	}
}
function yearSelect(){
	$(".year-line .year").width(function(){
		return $(".year-line").width()/$(".year-line .year").length;
	})
	$(window).resize(function(){
		$(".year-line .year").width(function(){
			return $(".year-line").width()/$(".year-line .year").length;
		})
	})
	$(".year-line .year").click(function(){
		$(".year-line .year").removeClass("hover");
		$(this).addClass("hover");
		var value=$(this).attr('value');
		var lis=$("ul.list li");
		lis.hide();
		if(value!="All"){
		for(var i=0;i<lis.length;i++){
			if(lis.eq(i).attr('year')==value){
				lis.eq(i).fadeIn("slow");
			}else{
				lis.eq(i).hide();
			}
		}}else{
			lis.fadeIn("slow");
		}
	})
	$(".year-line .year:not(.hover)").on('hover',
	  function () {
		$(this).addClass("hover");
	  },
	  function () {
		$(this).removeClass("hover");
	  }
	);
}