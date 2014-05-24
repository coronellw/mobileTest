window.onload = function(){
	test.baseClass = document.body.className;
	test.container = document.getElementsByClassName("ui-page")[0]
	test.container.classList.add('uninitialized');
	if( isMobile.any() ) {
		console.log("You are using "+ navigator.userAgent);
		jQuery(".ui-page").on("tap", handleClick);
		test.set_devise(isMobile.deviseName());
		document.getElementById("equipment").innerHTML = test.get_devise();
	}else{
		document.body.onclick = handleClick;
	};
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
	status : 0,
	phase : 0,
	timeout : 0,
	devise : 'undefined',
	baseClass : 'uninit',
	container :  'undefined',
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
				name : "slideLeft",
				instruction : "Slide left",
				number : 3
			},
			{
				name : "slideRight",
				instruction : "Slide right",
				number : 4
			},
			{
				name : "testCompleted",
				instruction : "All test passed",
				number : 5
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
	}
};

var mouse = {
	consecutiveClicks : 0,
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
					if( isMobile.any() ) {
						jQuery(".ui-page").on("tap", null);
						jQuery(".ui-page").on("doubletap", doubleTap);
						console.log("mobile detected");
					}else{
						document.body.onclick = doubleTap;
					};
				break;

				case 2:
					window.clearTimeout(test.timeout);
					success();
					mouse.resetConsecutiveClicks();
					test.container.onclick = null;
					nextPhase();
					$(test.container).on("swipe", swipeHandler);
				break;

				case 3:
					window.clearTimeout(test.timeout);
					success();
					nextPhase();
					// test.container.onclick = handleClick;
				break;

				case 4:
					window.clearTimeout(test.timeout);
					success();
					nextPhase();
					test.container.onclick = handleClick;
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
	test.container.classList.add('uninitialized');
	// document.getElementById("instructions").innerHTML = "Touch anywhere in the screen to start"
	test.set_status(0);
	test.set_phase(0);
	updateLabels();
}

function doubleTap(evento){
	mouse.increaseConsecutiveClicks();
	console.log("doubleTap event on x = "+evento.pageX+" and y = "+evento.pageY);
	if (mouse.getConsecutiveClicks() == 1) {
		setTimeout(function(){
			if (mouse.getConsecutiveClicks() > 1) {
				handleClick();
			} else {
				mouse.resetConsecutiveClicks();
			};
		},500);
	};
};

function swipeHandler() {
	handleClick();
};

function testComplete() {
	test.container.classList.remove('success');
}