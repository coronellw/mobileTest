window.onload = function() {
    init();
};

var canvas, ctx, hammerTime, 
        flag = false,
        prevX = 0,
        currX = 0,
        prevY = 0,
        currY = 0,
        initX = 0,
        initY = 0,
        xTolerance = 50,
        yTolerance = 50,
        dot_flag = false,
        st = {};

var x = "black",
    y = 2;


function init() {
    st.container = document.getElementById('can');
    canvas = document.createElement('canvas');
    canvas.width = jQuery(window).width();//screen.availWidth;
    canvas.height = jQuery(window).height();//screen.availHeight;
    ctx = canvas.getContext("2d");
    w = canvas.width;
    h = canvas.height;
    st.w = canvas.width;
    st.h = canvas.height;
    hammerTime = new Hammer(canvas, {preventDefault: true});

    st.container.appendChild(canvas);
    console.log("w: " + st.w + "\nh: " + st.h);
    console.log("xTolerance: "+xTolerance+"\nyTolerance: "+yTolerance);

    hammerTime.on("dragup dragdown dragleft dragright", function(e) {
        findxy('move', e);
    });

    hammerTime.on("dragstart", function(e) {
        findxy('down', e);
    });
    hammerTime.on("release", function(e) {
        findxy('up', e);
    });
}

function setFullScreen() {
    rfs = canvas.requestFullScreen || canvas.webkitRequestFullScreen
            || canvas.mozRequestFullScreen
            || canvas.msRequestFullScreen;

    if (typeof rfs !== "undefined" && rfs) {
        rfs.call(canvas);
    } else if (typeof window.ActiveXObject !== "undefined") {
        var wscript = new ActiveXObject("WScript.Shell");
        if (wscript !== null) {
            wscript.SendKeys("{F11}");
        }
    }
}


function draw() {
    ctx.beginPath();
//    console.log("Drawing from (" + prevX + ", " + prevY + ") to (" + currX + ", " + currY + ")");
    ctx.clearRect(0, 0, w, h);
    ctx.moveTo(currX, currY);
    ctx.lineTo(currX, 0);
    ctx.strokeStyle = "green";
    ctx.lineWidth = 2;
    ctx.stroke();
    ctx.moveTo(currX, currY);
    ctx.lineTo(currX, screen.height);
    ctx.strokeStyle = "green";
    ctx.lineWidth = 2;
    ctx.stroke();
    ctx.moveTo(currX, currY);
    ctx.lineTo(0, currY);
    ctx.strokeStyle = "green";
    ctx.lineWidth = 2;
    ctx.stroke();
    ctx.moveTo(currX, currY);
    ctx.lineTo(screen.width, currY);
    ctx.strokeStyle = "green";
    ctx.lineWidth = 2;
    ctx.stroke();
    ctx.closePath();
}

function erase() {
    var m = confirm("Want to clear");
    if (m) {
        ctx.clearRect(0, 0, st.w, st.h);
        document.getElementById("canvasimg").style.display = "none";
    }
}

function findxy(res, e) {
    currX = e.gesture.center.pageX;
    currY = e.gesture.center.pageY;
    
    if (res === 'down') {
        prevX = currX;
        prevY = currY;
        initX = currX;
        initY = currY;
        console.log("initial point is ("+initX+", "+initY+")");
        st.container.classList.remove("error");
        st.container.classList.remove("success");
        st.container.classList.remove("waiting");

        if (initX <= xTolerance && initY <= yTolerance) {
            st.container.classList.add("waiting");
        }

        flag = true;
        dot_flag = true;
        if (dot_flag) {
            ctx.beginPath();
            ctx.fillStyle = "black";
            ctx.fillRect(currX, currY, 2, 2);
            ctx.closePath();
            dot_flag = false;
        }
    }

    if (res === 'up' || res === "out") {
        flag = false;
        ctx.clearRect(0, 0, st.w, st.h);
        console.log("release point is ("+currX+", "+currY+")");
        var errors = [];
        var error = "";
        errorMsg = "";

        if (currX < (st.w - xTolerance)) {
            errorMsg = "x didn't reach the limiet at " + currX + " when limit is " + st.w;
            error += "\nTest failed, " + errorMsg;
            errors.push({code: 1, message: errorMsg});
        }

        if (currY < (st.h - yTolerance)) {
            errorMsg = "y didn't reach the limit " + currY + " when limit is " + st.h;
            error += "\nTest failed, " + errorMsg;
            errors.push({code:2, message: errorMsg});
        }

        if (initX > xTolerance) {
            errorMsg = "The test didn't start within the tolerance rate, you started x at "+initX;
            error += "\n"+errorMsg;
            errors.push({code:3, message: errorMsg});
        }

        if (initY > yTolerance) {
            errorMsg = "You didn't start within the tolerance rate, you started y at "+initY;
            error += "\n" + errorMsg;
            errors.push({code:4, message: errorMsg});

        }

        if (errors.length > 0) {
            console.log("Test failed");
            st.container.classList.remove("success");
            st.container.classList.remove("waiting");
            st.container.classList.add('error');
        }else{
            console.log("Test passed, data saved");
            st.container.classList.remove("error");
            st.container.classList.remove("waiting");
            st.container.classList.add('success');
        }
    }
    if (res === 'move') {
        if (flag) {
            prevX = currX;
            prevY = currY;
            currX = e.gesture.center.pageX;
            currY = e.gesture.center.pageY;
            draw();
        }
    }
}