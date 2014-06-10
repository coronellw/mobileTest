var elapsedTime = 0, timeToCompleteTest = 0;
window.onload = function(){
	test.container = document.getElementsByClassName("ui-page")[0];

	if ( typeof test.container !== 'undefined') {
		test.container.classList.add('uninitialized');
		timeToCompleteTest = (typeof eval_time === 'number') ? eval_time : 10000;
		
		test.globalTimeout = setTimeout(function(){
			clearInterval(test.interval);
			jQuery("#send_btn").click();
			document.getElementById("timer").innerHTML = 0;
		}, timeToCompleteTest);
		
		elapsedTime = 1;
		
		test.interval = setInterval(function(){
			document.getElementById("timer").innerHTML = (timeToCompleteTest/1000) - elapsedTime;
			elapsedTime++;
		}, 1000);

		if (pruebas && pruebas !== 'undefined' ) {
			for (var i = 0; i < pruebas.length; i++) {
				pruebas[i].funcion();
			};
		};
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
	globalTimeout : 0,
	devise : 'undefined',
	baseClass : 'uninit',
	container :  'undefined',
	isMobile : false
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
		test.imei = retrievedIMEI;
		window.location.href="test.php?imei="+retrievedIMEI+"&eval_type="+eval_type;
	};
};

function getParameterByName(name) {
    var match = RegExp('[?&]' + name + '=([^&]*)').exec(window.location.search);
    return match && decodeURIComponent(match[1].replace(/\+/g, ' '));
};

function send_results(){
	var resultados = [];
	for (var i = 0; i < pruebas.length; i++) {
		if (pruebas[i].passed === true){ 
			resultados.push(pruebas[i].id_test);
		}
	};
	console.log(resultados);
}