var elapsedTime = 0, timeToCompleteTest = 0;
window.onload = function(){
	test.container = document.getElementsByClassName("ui-page")[0];
	timeToCompleteTest = eval_time;
	elapsedTime = setTimeout(function(){
		clearInterval(test.interval);
		jQuery("#send_btn").click();
		document.getElementById("timer").innerHTML = 0;
	}, timeToCompleteTest);
	elapsedTime = 1;
	test.interval = setInterval(function(){
		document.getElementById("timer").innerHTML = (timeToCompleteTest/1000) - elapsedTime;
		elapsedTime++;
	}, 1000);

	if ( typeof test.container !== 'undefined') {
		test.container.classList.add('uninitialized');
		if( isMobile.any() ) {
			
			test.container.addEventListener('touchstart', savePosition, false);
			test.container.addEventListener('touchend', saveEndingPosition, false);
			test.container.addEventListener('touchmove', moving, false);

			// test.container.addEventListener('touchstart', test.phases[1].action, false);
			// test.container.addEventListener('touchstart', test.phases[2].action, false);
			// test.container.addEventListener('touchend', test.phases[3].action, false);
			// test.container.addEventListener('touchend', test.phases[4].action, false);
			// test.container.addEventListener('touchend', test.phases[5].action, false);
			// test.container.addEventListener('touchend', test.phases[6].action, false);


			// window.ondevicemotion = function(e) {
			// 	var aX = e.accelerationIncludingGravity.x;
			// 	document.getElementById("varx").innerHTML = aX.toFixed(4);
			// 	if (aX > 7) {
			// 		document.getElementById("xpos").classList.add("passed");
			// 		test.phases[9].passed = true;
			// 	} else {
			// 		if (aX < -7) {
			// 			document.getElementById("xneg").classList.add("passed");
			// 			test.phases[10].passed = true;
			// 		};
			// 	};
			// 	var aY = e.accelerationIncludingGravity.y;
			// 	document.getElementById("vary").innerHTML = aY.toFixed(4);
			// 	if (aY > 7) {
			// 		test.phases[11].passed = true;
			// 		document.getElementById("ypos").classList.add("passed");
			// 	} else {
			// 		if (aY < -7) {
			// 			test.phases[12].passed = true;
			// 			document.getElementById("yneg").classList.add("passed");
			// 		};
			// 	};
			// 	var aZ = e.accelerationIncludingGravity.z;
			// 	document.getElementById("varz").innerHTML = aZ.toFixed(4);
			// 	if (aZ > 7) {
			// 		test.phases[13].passed = true;
			// 		document.getElementById("zpos").classList.add("passed");
			// 	} else {
			// 		if (aZ < -7) {
			// 			test.phases[14].passed = true;
			// 			document.getElementById("zneg").classList.add("passed");
			// 		};
			// 	};
			// };

			test.set_devise(isMobile.deviseName());
			document.getElementById("equipment").innerHTML = test.get_devise();
			document.getElementById("imei").innerHTML = getParameterByName("imei");
			document.getElementById("status").innerHTML = "Running tests...";

			test.isMobile = true;
		}
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

var mouse = {
	consecutiveClicks : 0,
	initialX : 0,
	initialY : 0,
	finalX : 0,
	finalY : 0,
	currentX : 'undefined',
	currentY : 'undefined',
	active : false,
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

var touch2 = {
	consecutiveClicks : 0,
	initialX : 0,
	initialY : 0,
	finalX : 0,
	finalY : 0,
	currentX : 'undefined',
	currentY : 'undefined',
	active : false,
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

var test = {
	imei : 0,
	status : 0,
	phase : 0,
	timeout : 0,
	interval : 0,
	devise : 'undefined',
	baseClass : 'uninit',
	container :  'undefined',
	isMobile : false,
	phases : [
			{
				name : "uninitialized",
				instruction : "( Click to start )",
				number : 0,
				passed : false,
				action : function (e) {
					
				}
			},
			{
				name : "singleClick",
				instruction : "Single tap",
				number : 1,
				passed : false,
				action : function (e) {
					var touchobj = e.changedTouches[0];
					this.passed = true;
					document.getElementById("singlet").classList.add("passed");
					e.preventDefault();
				}
			},
			{
				name : "doubleClick",
				instruction : "Double tap",
				number : 2,
				passed : false,
				action : function (e) {
					var touchobj = e.changedTouches[0];
					mouse.increaseConsecutiveClicks();
					if (mouse.getConsecutiveClicks() == 1) {
						setTimeout(function(){
							if (mouse.getConsecutiveClicks() > 1) {
								this.passed = true;
								document.getElementById("doublet").classList.add("passed");
							};
							mouse.resetConsecutiveClicks();
						},500);
					};
					e.preventDefault();
				}
			},
			{
				name : "swipeLeft",
				instruction : "Swipe left",
				number : 3,
				passed : false,
				action : function (e) {
					var touchobj = e.changedTouches[0];
					if ((touchobj.clientX - mouse.initialX)<-75) {
						this.passed = true;
						document.getElementById("sleft").classList.add("passed");
					}
					e.preventDefault();
				}
			},
			{
				name : "swipeRight",
				instruction : "Swipe right",
				number : 4,
				passed : false,
				action : function (e) {
					var touchobj = e.changedTouches[0];
					if ((touchobj.clientX - mouse.initialX)>75) {
						this.passed = true;
						document.getElementById("sright").classList.add("passed");
					}
					e.preventDefault();
				}
			},
			{
				name : "swipeUp",
				instruction : "Swipe Up",
				number : 5,
				passed : false,
				action : function (e) {
					var touchobj = e.changedTouches[0];
					if ((touchobj.clientY - mouse.initialY)<-75) {
						this.passed = true;
						document.getElementById("sup").classList.add("passed");
					}
					e.preventDefault();
				}
			},
			{
				name : "swipeDown",
				instruction : "Swipe Down",
				number : 6,
				passed : false,
				action : function (e) {
					var touchobj = e.changedTouches[0];
					if ((touchobj.clientY - mouse.initialY)>75) {
						this.passed = true;
						document.getElementById("sdown").classList.add("passed");
					}
					e.preventDefault();
				}
			},
			{
				name : "pitchIn",
				instruction : "Pitch in",
				number : 7,
				passed : false,
				action : function (e) {}
			},
			{
				name : "pitchOut",
				instruction : "Pitch out",
				number : 8,
				passed : false,
				action : function (e) {}
			},
			{
				name : "accelX+",
				instruction : "Place phone as shown",
				number : 9,
				passed : false
			},
			{
				name : "accelX-",
				instruction : "Place phone as shown",
				number : 10,
				passed : false
			},
			{
				name : "accelY+",
				instruction : "Place phone as shown",
				number : 11,
				passed : false
			},
			{
				name : "accelY-",
				instruction : "Place phone as shown",
				number : 12,
				passed : false
			},
			{
				name : "accelZ+",
				instruction : "Place phone as shown",
				number : 13,
				passed : false
			},
			{
				name : "accelZ-",
				instruction : "Place phone as shown",
				number : 14,
				passed : false
			},
			{
				name : "testCompleted",
				instruction : "All test passed",
				number : 20,
				passed : false,
				action : function (e) {}
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

function savePosition(e){
	var touchobj = e.changedTouches[0];
	mouse.initialX = touchobj.clientX;
	mouse.initialY = touchobj.clientY;
	document.getElementById("initialx").innerHTML = mouse.initialX;
	document.getElementById("initialy").innerHTML = mouse.initialY;
	e.preventDefault();
};

function moving(e) {
	var touchobj = e.changedTouches[0];
	var touchobj2 = e.changedTouches[1];
	mouse.currentX = touchobj.clientX;
	mouse.currentY = touchobj.clientY;
	document.getElementById("currentx").innerHTML = mouse.currentX;
	document.getElementById("currenty").innerHTML = mouse.currentY;
	e.preventDefault();
}

function saveEndingPosition(e){
	var touchobj = e.changedTouches[0];
	mouse.currentX = 'undefined';
	mouse.currentY = 'undefined';
	mouse.finalX = touchobj.clientX;
	mouse.finalY = touchobj.clientY;
	document.getElementById("finalx").innerHTML = mouse.finalX;
	document.getElementById("finaly").innerHTML = mouse.finalY;
	e.preventDefault();
};

function checkIMEI(){
	var retrievedIMEI = document.getElementById("imei").value;
	var eval_type = document.getElementById("eval_type").value;
	// alert(retrievedIMEI);
	if (isNaN(parseInt(retrievedIMEI))) {
		alert("IMEI is INVALID");
	}else{
		test.set_IMEI(retrievedIMEI);
		window.location.href="test.php?imei="+retrievedIMEI+"&eval_type="+eval_type;
	};
};

function getParameterByName(name) {
    var match = RegExp('[?&]' + name + '=([^&]*)').exec(window.location.search);
    return match && decodeURIComponent(match[1].replace(/\+/g, ' '));
};