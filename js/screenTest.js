window.onload = function() {
    init();
};

var canvas, ctx, hammerTime, flag = false,
        prevX = 0,
        currX = 0,
        prevY = 0,
        currY = 0,
        initX = 0,
        initY = 0,
        xTolerance = 20,
        yTolerance = 40,
        dot_flag = false;

var x = "black",
        y = 2;

function init() {

    canvas = document.createElement('canvas');
    canvas.width = screen.availWidth;
    canvas.height = screen.availHeight;
    ctx = canvas.getContext("2d");
    w = canvas.width;
    h = canvas.height;
    hammerTime = new Hammer(canvas, {preventDefault: true});

    document.getElementById('can').appendChild(canvas);
    console.log("w: " + w + "\nh: " + h);

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
        ctx.clearRect(0, 0, w, h);
        document.getElementById("canvasimg").style.display = "none";
    }
}

function findxy(res, e) {
    if (res === 'down') {
        prevX = currX;
        prevY = currY;
        currX = e.gesture.center.pageX;
        currY = e.gesture.center.pageY;
        initX = currX;
        initY = currY;

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
        ctx.clearRect(0, 0, w, h);
        var error = "";
        if (e.gesture.center.pageX < (screen.width - xTolerance)) {
            error += "\nTest failed, x didn't reach the limit, released at " + e.gesture.center.pageX + " when limit is " + screen.width;
        }

        if (e.gesture.center.pageY < (screen.height - yTolerance)) {
            error += "\nTest failed, y didn't reach the limit " + e.gesture.center.pageY + " when limit is " + screen.height;
        }

        if (initX > xTolerance) {
            error += "\nYou didn't start within the tolerance rate, you started x at "+initX;
        }

        if (initY > yTolerance) {
            error += "\nYou didn't start within the tolerance rate, you started y at "+initY;
        }

        if (error.length > 0) {
            alert(error);
        }else{
            alert("Test passed, data saved");
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