window.onload = function(){
	document.body.onclick = handleClick;
	test.baseClass = document.body.className;
	console.log("body classes are "+test.baseClass);
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
	baseClass : 'uninit',
	phases : [
			{
				name : "uninitialized",
				instruction : "Touch anywhere in the screen to begin with the test",
				number : 0
			},
			{
				name : "singleClick",
				instruction : "Touch anywhere in the screen",
				number : 1
			},
			{
				name : "doubleClick",
				instruction : "Touch twice anywhere in the screen",
				number : 2
			},
			{
				name : "slideLeft",
				instruction : "Slide to the left anywhere in the screen",
				number : 3
			},
			{
				name : "slideRight",
				instruction : "Slide to the right anywhere in the screen",
				number : 4
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
					document.body.onclick = doubleTap;
					// document.body.ondblclick = handleClick;
					nextPhase();
				break;

				case 2:
					window.clearTimeout(test.timeout);
					success();
					mouse.resetConsecutiveClicks();
					document.body.onclick = handleClick;
					nextPhase();
				break;
			};
		}else{
			if (test.get_status()===2) {
				alert("Please wait until the next test begins");
			}else{
				startTest();
			}
		}
	}
};

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
	document.body.style.className = test.baseClass + 'error';
	test.set_status(3);
	updateLabels();
	document.body.onclick = handleClick;
};

function success(){
	console.log("Should paint bg to green");
	document.body.style.className = test.baseClass + 'success';
	test.set_status(2);
	updateLabels();
};

function waiting(time){
	time = ((typeof time === 'number') && (time > 0)) ? time : 5000;
	console.log("Waiting " + time/1000 + " seconds for this test");
	document.body.classList.add('waiting');
	test.set_status(1);
	updateLabels();
	test.timeout = setTimeout(error, time);
};

function nextPhase(){
	test.timeout = setTimeout(function(){
		test.set_phase(test.get_phase()+1);
		waiting();
	}, 2000);
};

function startTest(){
	document.body.style.backgroundColor = "#777";
	document.body.style.border = "3px solid black";
	// document.getElementById("instructions").innerHTML = "Touch anywhere in the screen to start"
	test.set_status(0);
	test.set_phase(0);
	updateLabels();
}