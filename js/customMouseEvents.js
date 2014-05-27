var cme = {
	inicio : function(evento){ console.log("CME INCLUIDO"); }(),
	consecutiveClicks : 0,
	globalClickCounts : 0,
	lastX : 0,
	lastY : 0,
	lastClick : 0,
	saveEvent : function(evento, objeto){
		cme.lastX = parseInt(objeto.clientX);
		cme.lastY = parseInt(objeto.clientY);
		cme.lastClick = new Date().getTime();
	},
	singleTap : function (evento) {
		var touchobj = e.changedTouches[0];
		saveEvent(evento, touchobj);
		alert("event given at ("+lastX+", "+lastY+") time : "+lastClick);
		event.preventDefault();
		handleClick();
		console.log("Single tap triggered");
	},
	doubleTap : function (evento) {
		var touchobj = e.changedTouches[0];
		console.log("Double tap triggered");
	},
	swipeLeft : function (evento) {
		var touchobj = e.changedTouches[0];
		console.log("swipeLeft tap triggered");
	},
	swipeRight : function (evento) {
		var touchobj = e.changedTouches[0];
		console.log("swipeRight tap triggered");
	},
	swipe : function (evento) {
		var touchobj = e.changedTouches[0];
		console.log("A swipe was triggered");
		alert("A swipe was triggered");
	},
	touchStart : function (evento) {
		var touchobj = e.changedTouches[0];
		console.log("Touch evento begins at (" + evento.pageX + ", "+ evento.pageY + ")");
		alert("Touch evento begins at (" + evento.pageX + ", "+ evento.pageY + ")");
	},
	touchEnd : function (evento) {
		var touchobj = e.changedTouches[0];
		document.getElementById("desc");
		console.log("Touch evento ends at (" + evento.pageX + ", "+ evento.pageY + ")");
		alert("Touch evento ends at (" + evento.pageX + ", "+ evento.pageY + ")");
	},
	touchMove : function (evento) {
		var touchobj = e.changedTouches[0];
		console.log("Touch is moving in (" + evento.pageX + ", "+ evento.pageY + ")");
	}
};