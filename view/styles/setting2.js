$(document).ready(function(){
	$(".dropdown img.flag").addClass("flagvisibility");

    $(".dropdown dt a").click(function() {
        $(".dropdown dd ul").toggle();
    });
                
    $(".dropdown dd ul li a").click(function() {
        var text = $(this).html();
        $(".dropdown dt a").html(text);
        $(".dropdown dd ul").hide();
    });
    $(document).bind('click', function(e) {
        var $clicked = $(e.target);
        if (! $clicked.parents().hasClass("dropdown"))
            $(".dropdown dd ul").hide();
    });

	wow = new WOW(
      {
        animateClass: 'animated',
        offset:       100,
        callback:     function(box) {
          console.log("WOW: animating <" + box.tagName.toLowerCase() + ">")
        }
      }
    );
    wow.init();
	calc( parseInt($("#Ultra").val()));
	//Calculator

	function calc(plan){	
		var money = parseFloat($("#money").val());

		switch (plan) {
		    case 1:
		        if(money >= 10 && money <= 200){
					var profitDaily = money / 100 * 5.5;
					var profitDaily = profitDaily.toFixed(2);
					var profitTotal = profitDaily * 20;
					var profitTotal = profitTotal.toFixed(2);
					$("#profitTotal").text(profitTotal);
					$("#profitDaily").text(profitDaily);
				//} else if(isNaN(money) == true) {
				}else if(money > 200 && money <= 300){
					var profitDaily = money / 100 * 6;
					var profitDaily = profitDaily.toFixed(2);
					var profitTotal = profitDaily * 20;
					var profitTotal = profitTotal.toFixed(2);
					$("#profitTotal").text(profitTotal);
					$("#profitDaily").text(profitDaily);
				//} else if(isNaN(money) == true) {
				}else if(money > 300 && money <= 500){
					var profitDaily = money / 100 * 7.5;
					var profitDaily = profitDaily.toFixed(2);
					var profitTotal = profitDaily * 20;
					var profitTotal = profitTotal.toFixed(2);
					$("#profitTotal").text(profitTotal);
					$("#profitDaily").text(profitDaily);
				//} else if(isNaN(money) == true) {
				}else{
					$("#profitDaily").text("Error!");
					$("#profitTotal").text("Error!");
				}
				break;
		    case 2:
		        if(money >= 501 && money <= 1000){
					var profitDaily = money / 100 * 10;
					var profitDaily = profitDaily.toFixed(2);
					var profitTotal = profitDaily * 12;
					var profitTotal = profitTotal.toFixed(2);
					$("#profitTotal").text(profitTotal);
					$("#profitDaily").text(profitDaily);
				//} else if(isNaN(money) == true) {
				}else if(money > 1000 && money <= 3000){
					var profitDaily = money / 100 * 12;
					var profitDaily = profitDaily.toFixed(2);
					var profitTotal = profitDaily * 45;
					var profitTotal = profitTotal.toFixed(2);
					$("#profitTotal").text(profitTotal);
					$("#profitDaily").text(profitDaily);
				//} else if(isNaN(money) == true) {
				}else if(money > 3000 && money <= 5000){
					var profitDaily = money / 100 * 15;
					var profitDaily = profitDaily.toFixed(2);
					var profitTotal = profitDaily * 12;
					var profitTotal = profitTotal.toFixed(2);
					$("#profitTotal").text(profitTotal);
					$("#profitDaily").text(profitDaily);
				//} else if(isNaN(money) == true) {
				}else{
					$("#profitTotal").text("Error!");
					$("#profitDaily").text("Error!");
				}
				break;
		    case 3:
		        if(money >= 100 && money <= 500){
					var profitDaily = money / 100 * 130;
					var profitDaily = profitDaily.toFixed(2);
					var profitTotal = profitDaily * 1;
					var profitTotal = profitTotal.toFixed(2);
					$("#profitTotal").text(profitTotal);
					$("#profitDaily").text(profitDaily);
				//} else if(isNaN(money) == true) {
				}else if(money > 500 && money <= 1000){
					var profitDaily = money / 100 * 150;
					var profitDaily = profitDaily.toFixed(2);
					var profitTotal = profitDaily * 1;
					var profitTotal = profitTotal.toFixed(2);
					$("#profitTotal").text(profitTotal);
					$("#profitDaily").text(profitDaily);
				//} else if(isNaN(money) == true) {
				}else if(money > 1000 && money <= 2000){
					var profitDaily = money / 100 * 175;
					var profitDaily = profitDaily.toFixed(2);
					var profitTotal = profitDaily * 1;
					var profitTotal = profitTotal.toFixed(2);
					$("#profitTotal").text(profitTotal);
					$("#profitDaily").text(profitDaily);
				//} else if(isNaN(money) == true) {
				}else{
					$("#profitTotal").text("Error!");
					$("#profitDaily").text("Error!");
				}
				break;
				
				case 4:
		        if(money >= 1500 && money <= 3000){
					var profitDaily = money / 100 * 200;
					var profitDaily = profitDaily.toFixed(2);
					var profitTotal = profitDaily * 1;
					var profitTotal = profitTotal.toFixed(2);
					$("#profitTotal").text(profitTotal);
					$("#profitDaily").text(profitDaily);
				//} else if(isNaN(money) == true) {
				}else if(money >3000 && money <= 5000){
					var profitDaily = money / 100 * 300;
					var profitDaily = profitDaily.toFixed(2);
					var profitTotal = profitDaily * 1;
					var profitTotal = profitTotal.toFixed(2);
					$("#profitTotal").text(profitTotal);
					$("#profitDaily").text(profitDaily);
				//} else if(isNaN(money) == true) {
				}else if(money >5000 && money <= 10000){
					var profitDaily = money / 100 * 500;
					var profitDaily = profitDaily.toFixed(2);
					var profitTotal = profitDaily * 1;
					var profitTotal = profitTotal.toFixed(2);
					$("#profitTotal").text(profitTotal);
					$("#profitDaily").text(profitDaily);
				//} else if(isNaN(money) == true) {
				}else{
					$("#profitTotal").text("Error!");
					$("#profitDaily").text("Error!");
				}
				break;
				
				case 5:
		       if(money >= 500 && money <= 1000){
					var profitDaily = money / 100 * 200 / 3;
					var profitDaily = profitDaily.toFixed(2);
					var profitTotal = profitDaily * 3;
					var profitTotal = profitTotal.toFixed(2);
					$("#profitTotal").text(profitTotal);
					$("#profitDaily").text(profitDaily);
				//} else if(isNaN(money) == true) {
				}else if(money > 1000 && money <= 3000){
					var profitDaily = money / 100 * 200 / 3;
					var profitDaily = profitDaily.toFixed(2);
					var profitTotal = profitDaily * 3;
					var profitTotal = profitTotal.toFixed(2);
					$("#profitTotal").text(profitTotal);
					$("#profitDaily").text(profitDaily);
				//} else if(isNaN(money) == true) {
				}else if(money > 3000){
					var profitDaily = money / 100 * 200 / 3;
					var profitDaily = profitDaily.toFixed(2);
					var profitTotal = profitDaily * 3;
					var profitTotal = profitTotal.toFixed(2);
					$("#profitTotal").text(profitTotal);
					$("#profitDaily").text(profitDaily);
				//} else if(isNaN(money) == true) {
				}else{
					$("#profitTotal").text("Error!");
					$("#profitDaily").text("Error!");
				}
				break;
				
				case 6:
		      if(money >= 200 && money <= 1000){
					var profitDaily = money / 100 * 300 / 7;
					var profitDaily = profitDaily.toFixed(2);
					var profitTotal = profitDaily * 7;
					var profitTotal = profitTotal.toFixed(2);
					$("#profitTotal").text(profitTotal);
					$("#profitDaily").text(profitDaily);
				//} else if(isNaN(money) == true) {
				}else if(money > 1000 && money <= 3000){
					var profitDaily = money / 100 * 300 / 7;
					var profitDaily = profitDaily.toFixed(2);
					var profitTotal = profitDaily * 7;
					var profitTotal = profitTotal.toFixed(2);
					$("#profitTotal").text(profitTotal);
					$("#profitDaily").text(profitDaily);
				//} else if(isNaN(money) == true) {
				}else if(money > 3000){
					var profitDaily = money / 100 * 300 / 7;
					var profitDaily = profitDaily.toFixed(2);
					var profitTotal = profitDaily * 7;
					var profitTotal = profitTotal.toFixed(2);
					$("#profitTotal").text(profitTotal);
					$("#profitDaily").text(profitDaily);
				//} else if(isNaN(money) == true) {
				}else{
					$("#profitTotal").text("Error!");
					$("#profitDaily").text("Error!");
				}
				break;
				
				case 7:
		         if(money >= 100 && money <= 1000){
					var profitDaily = money / 100 * 400 / 15;
					var profitDaily = profitDaily.toFixed(2);
					var profitTotal = profitDaily * 15;
					var profitTotal = profitTotal.toFixed(2);
					$("#profitTotal").text(profitTotal);
					$("#profitDaily").text(profitDaily);
				//} else if(isNaN(money) == true) {
				}else if(money > 1000 && money <= 3000){
					var profitDaily = money / 100 * 400 / 15;
					var profitDaily = profitDaily.toFixed(2);
					var profitTotal = profitDaily * 15;
					var profitTotal = profitTotal.toFixed(2);
					$("#profitTotal").text(profitTotal);
					$("#profitDaily").text(profitDaily);
				//} else if(isNaN(money) == true) {
				}else if(money > 3000){
					var profitDaily = money / 100 * 400 / 15;
					var profitDaily = profitDaily.toFixed(2);
					var profitTotal = profitDaily * 15;
					var profitTotal = profitTotal.toFixed(2);
					$("#profitTotal").text(profitTotal);
					$("#profitDaily").text(profitDaily);
				//} else if(isNaN(money) == true) {
				}else{
					$("#profitTotal").text("Error!");
					$("#profitDaily").text("Error!");
				}
				break;
		    case 8:
		        if(money >= 20 && money <= 1000){
					var profitDaily = money / 100 * 500 / 35;
					var profitDaily = profitDaily.toFixed(2);
					var profitTotal = profitDaily * 35;
					var profitTotal = profitTotal.toFixed(2);
					$("#profitTotal").text(profitTotal);
					$("#profitDaily").text(profitDaily);
				//} else if(isNaN(money) == true) {
				}else if(money > 1000 && money <= 3000){
					var profitDaily = money / 100 * 550 / 35;
					var profitDaily = profitDaily.toFixed(2);
					var profitTotal = profitDaily * 35;
					var profitTotal = profitTotal.toFixed(2);
					$("#profitTotal").text(profitTotal);
					$("#profitDaily").text(profitDaily);
				//} else if(isNaN(money) == true) {
				}else if(money > 3000){
					var profitDaily = money / 100 * 600 / 35;
					var profitDaily = profitDaily.toFixed(2);
					var profitTotal = profitDaily * 35;
					var profitTotal = profitTotal.toFixed(2);
					$("#profitTotal").text(profitTotal);
					$("#profitDaily").text(profitDaily);
				//} else if(isNaN(money) == true) {
				}else{
					$("#profitTotal").text("Error!");
					$("#profitDaily").text("Error!");
				}
				break;

		    case 9:
		        if(money >= 50 && money <= 1000){
					var profitDaily = money / 100 * 1300 / 60;
					var profitDaily = profitDaily.toFixed(2);
					var profitTotal = profitDaily * 60;
					var profitTotal = profitTotal.toFixed(2);
					$("#profitTotal").text(profitTotal);
					$("#profitDaily").text(profitDaily);
				//} else if(isNaN(money) == true) {
				}else if(money > 1000 && money <= 3000){
					var profitDaily = money / 100 * 1400 / 60;
					var profitDaily = profitDaily.toFixed(2);
					var profitTotal = profitDaily * 60;
					var profitTotal = profitTotal.toFixed(2);
					$("#profitTotal").text(profitTotal);
					$("#profitDaily").text(profitDaily);
				//} else if(isNaN(money) == true) {
				}else if(money > 3000){
					var profitDaily = money / 100 * 1500 / 60;
					var profitDaily = profitDaily.toFixed(2);
					var profitTotal = profitDaily * 60;
					var profitTotal = profitTotal.toFixed(2);
					$("#profitTotal").text(profitTotal);
					$("#profitDaily").text(profitDaily);
				//} else if(isNaN(money) == true) {
				}else{
					$("#profitTotal").text("Error!");
					$("#profitDaily").text("Error!");
				}
				break;
				
			case 10:
		        if(money >= 10 && money <= 500){
					var profitDaily = money / 100 * 0.5;
					var profitDaily = profitDaily.toFixed(2);
					var profitTotal = profitDaily * 1000;
					var profitTotal = profitTotal.toFixed(2);
					$("#profitTotal").text(profitTotal);
					$("#profitDaily").text(profitDaily);
				//} else if(isNaN(money) == true) {
				}else if(money > 500 && money <= 2000){
					var profitDaily = money / 100 * 1;
					var profitDaily = profitDaily.toFixed(2);
					var profitTotal = profitDaily * 1000;
					var profitTotal = profitTotal.toFixed(2);
					$("#profitTotal").text(profitTotal);
					$("#profitDaily").text(profitDaily);
				//} else if(isNaN(money) == true) {
				}else if(money > 2000){
					var profitDaily = money / 100 * 2;
					var profitDaily = profitDaily.toFixed(2);
					var profitTotal = profitDaily * 1000;
					var profitTotal = profitTotal.toFixed(2);
					$("#profitTotal").text(profitTotal);
					$("#profitDaily").text(profitDaily);
				//} else if(isNaN(money) == true) {
				}else{
					$("#profitDaily").text("Error!");
					$("#profitTotal").text("Error!");
				}
				break;
		}
	}
	$("#money").keyup(function(){
		calc( parseInt($("#Ultra").val()));
	});

	$("#Ultra").on('change', function() {
		calc(parseInt($(this).val()));
	})
	//Parallax
	$("#scene").parallax({
		limitY: 0
	});
	$("#top").parallax();


});