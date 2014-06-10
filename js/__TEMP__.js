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