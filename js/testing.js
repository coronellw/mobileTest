var elapsedTime = 0, timeToCompleteTest = 0, errorCounter = 0;
var listeners = new Array();
window.onload = function() {
    test.container = document.getElementsByClassName("ui-page")[0];

    if (typeof test.container !== 'undefined') {
        test.container.classList.add('global');
        timeToCompleteTest = (typeof eval_time === 'number') ? eval_time : 10000;

        test.globalTimeout = setTimeout(function() {
            console.log("Time is up, data will be sent");
            clearInterval(test.interval);
            jQuery("#send_btn").click();
            document.getElementById("timer").innerHTML = 0;
        }, timeToCompleteTest);

        elapsedTime = 1;

        test.interval = setInterval(function() {
            document.getElementById("timer").innerHTML = (timeToCompleteTest / 1000) - elapsedTime;
            elapsedTime++;
        }, 1000);

        if (pruebas && pruebas !== 'undefined') {
            for (var index in pruebas) {
                var prueba = pruebas[index];
                if (prueba.action !== 'default') {
                    Hammer(test.container, {doubleTapInterval: 700}).on(prueba.action, function(prueba) {
                        return function() {
                            document.getElementById(prueba.tag).classList.add("passed");
                            prueba.passed = true;
                        };
                    }(prueba));
                }
            }
        }
        if (isMobile.any()) {

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

Function.prototype.method = function(name, func) {
    this.prototype[name] = func;
    return this;
};

Number.method('integer', function( ) {
    return Math[this < 0 ? 'ceil' : 'floor'](this);
});

var mouse = {
    consecutiveClicks: 0,
    initialX: 0,
    initialY: 0,
    finalX: 0,
    finalY: 0,
    currentX: 'undefined',
    currentY: 'undefined',
    active: false,
    increaseConsecutiveClicks: function() {
        this.consecutiveClicks += 1;
        console.log("consecutiveClicks increased to " + this.consecutiveClicks);
    },
    getConsecutiveClicks: function() {
        return this.consecutiveClicks;
    },
    resetConsecutiveClicks: function() {
        this.consecutiveClicks = 0;
    }
};

var test = {
    imei: 0,
    status: 0,
    phase: 0,
    timeout: 0,
    interval: 0,
    globalTimeout: 0,
    devise: 'undefined',
    baseClass: 'uninit',
    container: 'undefined',
    isMobile: false
};

function savePosition(e) {
    var touchobj = e.changedTouches[0];
    mouse.initialX = touchobj.clientX;
    mouse.initialY = touchobj.clientY;
    document.getElementById("initialx").innerHTML = mouse.initialX;
    document.getElementById("initialy").innerHTML = mouse.initialY;
    e.preventDefault();
}

function moving(e) {
    var touchobj = e.changedTouches[0];
    mouse.currentX = touchobj.clientX;
    mouse.currentY = touchobj.clientY;
    document.getElementById("currentx").innerHTML = mouse.currentX;
    document.getElementById("currenty").innerHTML = mouse.currentY;
    e.preventDefault();
}

function saveEndingPosition(e) {
    var touchobj = e.changedTouches[0];
    mouse.currentX = 'undefined';
    mouse.currentY = 'undefined';
    mouse.finalX = touchobj.clientX;
    mouse.finalY = touchobj.clientY;
    document.getElementById("finalx").innerHTML = mouse.finalX;
    document.getElementById("finaly").innerHTML = mouse.finalY;
    e.preventDefault();
}

function checkIMEI() {
    var retrievedIMEI = document.getElementById("imei").value;
    var eval_type = document.getElementById("eval_type").value;

    if (isNaN(parseInt(retrievedIMEI))) {
        alert("IMEI is INVALID");
    } else {
        test.imei = retrievedIMEI;
        window.location.href = "test.php?imei=" + retrievedIMEI + "&eval_type=" + eval_type;
    }
}

function getParameterByName(name) {
    var match = RegExp('[?&]' + name + '=([^&]*)').exec(window.location.search);
    return match && decodeURIComponent(match[1].replace(/\+/g, ' '));
}

function send_results() {
    var resultados = [];
    var eval_status = 3; // 3 means that the test was not performed at all
    jQuery("#send_btn").attr("disabled", true); // desabilita el envio de pruebas temporalmente
    stopTest(); //detiene los contadores

    for (var index in pruebas) {
        var prueba = pruebas[index];
        if (prueba.passed) {
            resultados.push(prueba.name);
        } else {
            prueba.passed = false;
        }
    }
    
    if (resultados.length === pruebas.length) {
        console.log("all test passed!!!");
        eval_status = 1; // 1 means all test were passed
        test.container.classList.remove("error");
        test.container.classList.remove("success");
        test.container.classList.add("waiting");
        jQuery("#reset").html("Siguiente prueba");
        jQuery("#reset").attr("onclick","screenTest()");
    } else {
        //verifica cuantas veces ha fallado la prueba
        errorCounter++;
        if (errorCounter >= 3) {
            jQuery("#send_btn").html("PRUEBA FALLIDA");
            test.container.classList.remove("success");
            test.container.classList.remove("waiting");
            test.container.classList.add("error");
        } else {
            if (resultados.length === 0) {
                console.log("You haven't complete any test");
            } else {
                console.log("Passed : " + resultados.length + "\nFailed : " + (pruebas.length - resultados.length) + "\nTotal : " + pruebas.length);
                eval_status = 2; //2 means some test passed but not all of them
            }
        }

    }

    jQuery.ajax({
        type: "POST",
        url: "save.php",
        data: {"pruebas": pruebas, "device": id_device, "eval_type": id_evaluation, "eval_status": eval_status}
    }).done(function() {
        console.log("The test data was sent successfully");
    }).fail(function() {
        console.log("There was an error while sending the results to the database");
    });
}

function stopTest(){
    // resetea los contadores
    window.clearInterval(test.interval);
    window.clearTimeout(test.globalTimeout);    
}

function reset() {
    if (errorCounter < 3) {
        // Habilita el envio de pruebas nuevamente
        jQuery("#send_btn").attr("disabled", false);
        
        // Este ciclo resetea el status de todas las pruebas
        for (var index in pruebas) {
            var prueba = pruebas[index];
            document.getElementById(prueba.tag).classList.remove("passed");
            prueba.passed = false;
        }

        // resetea los contadores
        stopTest();
        test.globalTimeout = setTimeout(function() {
            clearInterval(test.interval);
            jQuery("#send_btn").click();
            document.getElementById("timer").innerHTML = 0;
        }, timeToCompleteTest);
        elapsedTime = 1;
        test.interval = setInterval(function() {
            document.getElementById("timer").innerHTML = (timeToCompleteTest / 1000) - elapsedTime;
            elapsedTime++;
        }, 1000);

        // retira los colores de fondo de la pagina
        test.container.classList.remove("success");
        test.container.classList.remove("error");
        test.container.classList.remove("waiting");
    } else {
        alert("You already have 3 error, if you wish to re-do this test, please reload this page.");
        jQuery("#reset").attr("disabled", true);
    }
}

function updateModels(id_model) {
    id_model = typeof id_model !== 'undefined' ? id_model : null;
    jQuery.ajax({
        type: "GET",
        url: "/admin/requests/getModels.php",
        data: {"id_brand": document.getElementById("brand").value, "id_model": id_model}
    }).done(function(data) {
        document.getElementById("model").innerHTML = data;
    }).fail(function(data) {
        alert("Unable to load " + data);
    });
}

function searchDevice() {
    jQuery.ajax({
        type: "GET",
        url: "/admin/requests/getDevice.php",
        data: {"imei": document.getElementById("imei").value}
    }).done(function(data) {
        if (data !== 'null') {
            var datos = JSON.parse(data);

            document.getElementById("brand").value = datos.id_brand;
            jQuery.ajax(updateModels()).done(function() {
                jQuery("#model").val(datos.id_model);
            });

            console.log("Found that imei with brand " + datos["id_brand"] + " while model is " + datos["id_model"]);
//            document.getElementById("model").value = datos.id_model;
        } else {
            document.getElementById("brand").value = null;
            updateModels();
            console.log("IMEI not found");
        }
    });
}

function screenTest(){
    location.href="screen.php";
}