var cme = {
	inicio : function(evento){ console.log("CME INCLUIDO"); }(),
	consecutiveClicks : 0,
	globalClickCounts : 0,
	lastX : 0,
	lastY : 0,
	lastClick : 0,
	saveEvent : function(evento){
		lastX = evento.pageX;
		lastY = evento.pageY;
		lastClick = new Date().getTime();
	},
	singleTap : function (evento) {
		console.log("Single tap triggered");
	},
	doubleTap : function (evento) {
		console.log("Double tap triggered");
	},
	swipeLeft : function (evento) {
		console.log("swipeLeft tap triggered");
	},
	swipeRight : function (evento) {
		console.log("swipeRight tap triggered");
	},
	swipe : function (evento) {
		console.log("A swipe was triggered");
		alert("A swipe was triggered");
	},
	touchStart : function (evento) {
		console.log("Touch evento begins at (" + evento.pageX + ", "+ evento.pageY + ")");
		alert("Touch evento begins at (" + evento.pageX + ", "+ evento.pageY + ")");
	},
	touchEnd : function (evento) {
		console.log("Touch evento ends at (" + evento.pageX + ", "+ evento.pageY + ")");
		alert("Touch evento ends at (" + evento.pageX + ", "+ evento.pageY + ")");
	},
	touchMove : function (evento) {
		console.log("Touch is moving in (" + evento.pageX + ", "+ evento.pageY + ")");
	}
};