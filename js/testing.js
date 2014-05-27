window.onload = function(){
	test.baseClass = document.body.className;
	test.container = document.getElementsByClassName("ui-page")[0];
	if ( typeof test.container !== 'undefined') {
		test.container.classList.add('uninitialized');
		if( isMobile.any() ) {
			test.container.addEventListener('touchstart', startEvent, false);
			test.set_devise(isMobile.deviseName());
			document.getElementById("equipment").innerHTML = test.get_devise();
			document.getElementById("imei").innerHTML = getParameterByName("imei");;

			test.isMobile = true;
		}else{
			document.body.onclick = handleClick;
		};
	}
	document.body.style.width = screen.width;
	document.body.style.height = screen.height;
};

Function.prototype.method = function(name, func){
	this.prototype[name] = func;
	return this;
};

Number.method('integer', function ( ) {
	return Math[this < 0 ? 'ceil' : 'floor'](this);
});

var test = {
	imei : 0,
	status : 0,
	phase : 0,
	timeout : 0,
	devise : 'undefined',
	baseClass : 'uninit',
	container :  'undefined',
	isMobile : false,
	phases : [
			{
				name : "uninitialized",
				instruction : "( Click to start )",
				number : 0
			},
			{
				name : "singleClick",
				instruction : "Single tap",
				number : 1
			},
			{
				name : "doubleClick",
				instruction : "Double tap",
				number : 2
			},
			{
				name : "swipeLeft",
				instruction : "Swipe left",
				number : 3
			},
			{
				name : "swipeRight",
				instruction : "Swipe right",
				number : 4
			},
			{
				name : "swipeUp",
				instruction : "Swipe Up",
				number : 5
			},
			{
				name : "swipeDown",
				instruction : "Swipe Down",
				number : 6
			},
			{
				name : "testCompleted",
				instruction : "All test passed",
				number : 7
			}
	],
	set_status : function(status){
		this.status = status;
	},
	get_status : function(){
		return this.status;
	},
	get_status_text : function(){
		console.log("current status is " + this.status);
				switch(this.status){
					case 0:
						return "Uninitialized test";
						break;
					case 1:
						return "Waiting for response test";
						break;
					case 2:
						return "Successful test";
						break;
					case 3:
						return "Unsuccessful test";
						break;
					default:
						return "Unknown state";

				};
			},
	set_phase : function(phase){
		this.phase = phase;
	},
	get_phase : function(){
		return this.phase;
	},
	set_devise : function(devise){
		this.devise = devise;
	},
	get_devise : function(){
		return this.devise;
	},
	set_IMEI : function(imei) {
		this.imei = imei;
	},
	get_IMEI : function() {
		return this.imei;
	}
};

var mouse = {
	consecutiveClicks : 0,
	initialX : 0,
	initialY : 0,
	lastX : 0,
	lastY : 0,
	increaseConsecutiveClicks : function(){
		this.consecutiveClicks+=1;
		console.log("consecutiveClicks increased to " + this.consecutiveClicks);
	},
	getConsecutiveClicks : function(){
		return this.consecutiveClicks;
	},
	resetConsecutiveClicks : function(){
		this.consecutiveClicks = 0;
	}
};

function handleClick(){
	if (test.get_status() === 0) {
		test.set_phase(1);
		waiting();
	}else {
		if (test.get_status() === 1) {
			switch(test.get_phase()){
				case 1:
					window.clearTimeout(test.timeout);
					success();
					// document.body.ondblclick = handleClick;
					nextPhase();
					if( test.isMobile ) {
						test.container.removeEventListener('touchstart',startEvent, false);
						test.container.addEventListener('touchstart', doubleTapFunc, false);
					}else{
						document.body.onclick = doubleTapFunc;
					};
				break;

				case 2:
					window.clearTimeout(test.timeout);
					success();
					mouse.resetConsecutiveClicks();
					test.container.onclick = null;
					nextPhase();
					test.container.removeEventListener('touchstart', doubleTapFunc, false);
					test.container.addEventListener('touchstart', savePosition, false);
					test.container.addEventListener('touchend', verifyLeftSwipe, false);
				break;

				case 3:
					window.clearTimeout(test.timeout);
					success();
					nextPhase();
					test.container.removeEventListener('touchend', verifyLeftSwipe, false);
					test.container.addEventListener('touchend', verifyRightSwipe, false);
					// test.container.onclick = handleClick;
				break;

				case 4:
					window.clearTimeout(test.timeout);
					success();
					nextPhase();
					test.container.removeEventListener('touchend', verifyRightSwipe, false);
					test.container.addEventListener('touchend', verifySwipeUp, false);
					// test.container.onclick = handleClick;
				break;

				case 5:
					window.clearTimeout(test.timeout);
					success();
					nextPhase();
					test.container.removeEventListener('touchend', verifySwipeUp, false);
					test.container.addEventListener('touchend', verifySwipeDown, false);
				break;

				case 6:
					window.clearTimeout(test.timeout);
					success();
					nextPhase();
					test.container.removeEventListener('touchstart', savePosition, false);
					test.container.removeEventListener('touchend', verifySwipeDown, false);
					test.container.addEventListener('touchstart', startEvent, false);
				break;

				case 7:
					window.clearTimeout(test.timeout);
					clearListeners();
					test.set_phase(0);
				break;
			};
		}else{
			if (test.get_status()===2) {
				console.log("Please wait until the next test begins");
			}else{
				startTest();
			}
		}
	}
};

function randomColorChange(){
	var r = Math.random()*256;
	var g = Math.random()*256;
	var b = Math.random()*256;
	document.body.style.backgroundColor = "#"+r.integer().toString(16)+b.integer().toString(16)+g.integer().toString(16);
	// document.body.style.background = "rbg("+ r.integer() + ", " + b.integer() + ", " + g.integer() + ")";
	console.log("Changed color to r:" + r.integer() + ", b: " + b.integer() + ", g: " + g.integer());
};

function updateLabels(){
	document.getElementById("phase").innerHTML = test.get_phase();
	document.getElementById("status").innerHTML = test.get_status_text();
	document.getElementById("instructions").innerHTML = test.phases[test.get_phase()].instruction;
}

function error(){
	test.container.classList.add('error');
	test.container.classList.remove('waiting');
	test.set_status(3);
	updateLabels();
	clearListeners();
	document.body.onclick = handleClick;
};

function success(){
	console.log("Should paint bg to green");
	test.container.classList.add('success');
	test.container.classList.remove('waiting');
	test.set_status(2);
	updateLabels();
};

function waiting(time){
	time = ((typeof time === 'number') && (time > 0)) ? time : 5000;
	console.log("Waiting " + time/1000 + " seconds for this test");
	test.container.classList.add('waiting');
	test.container.classList.remove('success','uninitialized');
	test.set_status(1);
	updateLabels();
	test.timeout = setTimeout(error, time);
};

function nextPhase(){
	test.timeout = setTimeout(function(){
		test.set_phase(test.get_phase()+1);
		if (test.phases[test.get_phase()].name === "testCompleted") {
			testComplete();
		}else{
			waiting();
		};
	}, 2000);
};

function startTest(){
	alert("startTest");
	test.container.classList.add('uninitialized');
	test.container.removeEventListener('touchstart', startTest, false);
	test.container.addEventListener('touchstart', startEvent, false);
	test.set_status(0);
	test.set_phase(0);
	updateLabels();
}

function doubleTapFunc(evento){
	mouse.increaseConsecutiveClicks();
	if (mouse.getConsecutiveClicks() == 1) {
		setTimeout(function(){
			if (mouse.getConsecutiveClicks() > 1) {
				handleClick();
			} else {
				mouse.resetConsecutiveClicks();
			};
		},500);
	};
	e.preventDefault();
};

function testComplete() {
	test.container.classList.remove('success');
	updateLabels();
};

function startEvent(e){
	var touchobj = e.changedTouches[0];
	e.preventDefault();
	handleClick();
	console.log("Single tap triggered");
};

function savePosition(e){
	var touchobj = e.changedTouches[0];
	mouse.initialX = touchobj.clientX;
	mouse.initialY = touchobj.clientY;
	e.preventDefault();
};

function verifyLeftSwipe(e){
	var touchobj = e.changedTouches[0];
	if ((touchobj.clientX - mouse.initialX)<-75) {
		handleClick();
	}else{
		console.log(touchobj.clientX - mouse.initialX);
	};
	e.preventDefault();
};

function verifyRightSwipe(e){
	var touchobj = e.changedTouches[0];
	if ((touchobj.clientX - mouse.initialX)>75) {
		handleClick();
	} else{
		console.log(touchobj.clientX - mouse.initialX);		
	};
};
function verifySwipeUp(e){
	var touchobj = e.changedTouches[0];
	if ((touchobj.clientY - mouse.initialY)<-75) {
		handleClick();
	} else{
		alert(touchobj.clientY - mouse.initialY);		
	};
};
function verifySwipeDown(e){
	var touchobj = e.changedTouches[0];
	if ((touchobj.clientY - mouse.initialY)>75) {
		handleClick();
	} else{
		alert(touchobj.clientY - mouse.initialY);
	};
};

function clearListeners(){
	test.container.removeEventListener('touchstart', doubleTapFunc, false);
	test.container.removeEventListener('touchstart', savePosition, false);
	test.container.removeEventListener('touchend', verifyLeftSwipe, false);
	test.container.removeEventListener('touchend', verifyRightSwipe, false);
	test.container.removeEventListener('touchend', verifySwipeUp, false);
	test.container.removeEventListener('touchend', verifySwipeDown, false);
	test.container.addEventListener('touchstart', startTest, false);
};

function checkIMEI(){
	var retrievedIMEI = document.getElementById("imei").value;
	// alert(retrievedIMEI);
	if (isNaN(parseInt(retrievedIMEI))) {
		alert("IMEI is INVALID");
	}else{
		test.set_IMEI(retrievedIMEI);
		window.location.href="test.html?imei="+retrievedIMEI;
	};
};

function getParameterByName(name) {
    var match = RegExp('[?&]' + name + '=([^&]*)').exec(window.location.search);
    return match && decodeURIComponent(match[1].replace(/\+/g, ' '));
}