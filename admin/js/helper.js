/* EVALUATIONS */
function createNewEvaluation(name, description, time, tests) {
    console.log("Preparing to create a new evaluation...");
    console.log("name: " + name + "\ndescription: " + description + "\ntime: " + time + "\ntests: " + tests);

    jQuery.ajax({
        type: "GET",
        url: "/mobile/admin/requests/createEvaluation.php",
        data: {"name": name, "description": description, "time": time, "tests": tests}
    }).done(function(data) {
        console.log("No error was detected recieved " + data);
        if (!confirm('Click accept to create another evaluation')) {
            window.location.href = "/mobile/admin/evaluations/";
        }
    }).fail(function(data) {
        console.log("There was an error while creating this test, please check the logs " + data);
    });
}

function deleteEvaluation(id_evaluation) {
    console.log("Preparing to delete evaluation...");
    jQuery.ajax({
        type: "POST",
        url: "/mobile/admin/requests/deleteEvaluation.php",
        data: {"id_evaluation": id_evaluation}
    }).done(function(data) {
        window.location.href = "/mobile/admin/evaluations/";
        console.log(id_evaluation + " was deleted from the database");
    }).fail(function(data) {
        console.log("There was an error while deleting the test " + data);
    });
}

function updateEvaluation(id, name, description, time, tests) {
    console.log("Preparing to edit an evaluation...");
    console.log("name: " + name + "\ndescription: " + description + "\ntime: " + time + "\ntests: " + tests);

    jQuery.ajax({
        type: "GET",
        url: "/mobile/admin/requests/updateEvaluation.php",
        data: {"id_evaluation": id, "name": name, "description": description, "time": time, "tests": tests}
    }).done(function(data) {
        console.log("No error was detected recieved " + data);
        window.location.href = "/mobile/admin/evaluations/view.php?evaluation=" + id;
    }).fail(function(data) {
        console.log("There was an error while updating this evaluation, please check the logs " + data);
    });
}

function toggleEvaluation(id_evaluation, options) {
    var redirect = typeof options === 'undefined' ? true : options.redirect;
    console.log("Preparing to toggle evaluation...");
    console.log(redirect);

    jQuery.ajax({
        type: "POST",
        url: "/mobile/admin/requests/toggleEvaluation.php",
        data: {"id_evaluation": id_evaluation}
    }).done(function() {
        if (redirect) {
            window.location.href = "/mobile/admin/evaluations/";
        } else {
            window.location.reload();
        }
        console.log(id_evaluation + " was deleted from the database");
    }).fail(function(data) {
        console.log("There was an error while deleting the test " + data);
    });
}

function getEvaluationDetail(fecha, id_device) {
    jQuery.ajax({
        type: "POST",
        url: "/mobile/admin/requests/getTests.php",
        data: {"fecha": fecha, "id_device": id_device}
    }).done(function(data) {
        document.getElementById("tbody").innerHTML = data;
    }).fail(function(data) {
        document.getElementById("tbody").innerHTML = "There was an error while retrieving the associated test " + data;
    });
}
/* DEVICES */
function deleteDevice(id_device) {
    console.log("Preparing to delete  device...");
    jQuery.ajax({
        type: "POST",
        url: "/mobile/admin/requests/deleteDevice.php",
        data: {"id_device": id_device}
    }).done(function(data) {
        window.location.href = "/mobile/admin/";
        console.log(id_device + " was deleted from the database");
    }).fail(function(data) {
        console.log("There was an error while deleting the element");
    });
}

function updateDevice(id, name, imei, model, brand) {
    console.log("Preparing to edit a device...");
    console.log("id: " + id + "\nname: " + name + "\nimei: " + imei + "\nid_model: " + model + "\nid_brand: " + brand);

    jQuery.ajax({
        type: "GET",
        url: "/mobile/admin/requests/updateDevice.php",
        data: {"id_device": id, "name": name, "imei": imei, "id_model": model, "id_brand": brand}
    }).done(function(data) {
//        alert("check the response now!");
        console.log("No error was detected recieved " + data);
        window.location.href = "/mobile/admin/index.php";
    }).fail(function(data) {
        console.log("There was an error while updating this device, please check the logs " + data);
    });
}

/* TESTS */
function createNewTest(name, action, description, tag, evaluation) {
    console.log("Preparing to create a new test...");
    console.log("name: " + name + "\naction: " + action + "\ndescription: " + description + "\ntag: " + tag + "\nevaluation: " + evaluation);
    evaluation = typeof evaluation !== 'undefined' ? evaluation : null;
    jQuery.ajax({
        type: "GET",
        url: "/mobile/admin/requests/createTest.php",
        data: {"name": name, "action": action, "description": description, "tag": tag, "evaluation": evaluation}
    }).done(function(data) {
        console.log("No error was detected recieved " + data);
        if (!confirm('Click accept to create another test')) {
            window.location.href = "/mobile/admin/tests/";
        }
    }).fail(function(data) {
        console.log("There was an error while creating this test, please check the logs " + data);
    });
}

function updateTest(id, name, action, description, tag) {
    console.log("Preparing to edit a test...");
    console.log("id: " + id + "\nname: " + name + "\naction: " + action + "\ndescription: " + description + "\ntag: " + tag);

    jQuery.ajax({
        type: "GET",
        url: "/mobile/admin/requests/updateTest.php",
        data: {"id_test": id, "name": name, "action": action, "description": description, "tag": tag}
    }).done(function(data) {
//        alert("check the response now!");
        console.log("No error was detected recieved " + data);
        window.location.href = "/mobile/admin/tests/";
        alert("id: " + id + "\nname: " + name + "\naction: " + action + "\ndescription: " + description + "\ntag: " + tag);
    }).fail(function(data) {
        console.log("There was an error while updating this test, please check the logs " + data);
    });
}

function deleteTest(id_test) {
    console.log("Preparing to delete test...");
    jQuery.ajax({
        type: "POST",
        url: "/mobile/admin/requests/deleteTest.php",
        data: {"id_test": id_test}
    }).done(function(data) {
        window.location.href = "/mobile/admin/tests/";
        console.log(id_test + " was requested to be deleted from the database");
    }).fail(function(data) {
        console.log("There was an error while deleting the test " + data);
    });
}

/* SUPPORTED EVENTS */
function createNewEvent(name, description) {
    console.log("Preparing to create a new supported event...");
    console.log("{name: " + name + "\ndescription: " + description + "}");

    jQuery.ajax({
        type: "GET",
        url: "/mobile/admin/requests/createEvent.php",
        data: {"name": name, "description": description}
    }).done(function(data) {
        console.log("No error was detected recieved " + data);
        window.location.href = "/mobile/admin/events/";

    }).fail(function(data) {
        console.log("There was an error while creating this test, please check the logs " + data);
    });
}

function updateEvent(id, name, description) {
    console.log("Preparing to update an event...");
    console.log("id: " + id + "\nname: " + name + "\ndescription: " + description);

    jQuery.ajax({
        type: "GET",
        url: "/mobile/admin/requests/updateEvent.php",
        data: {"id_event": id, "name": name, "description": description}
    }).done(function(data) {
        console.log("No error was detected recieved " + data);
        window.location.href = "/mobile/admin/events/";
        alert("id: " + id + "\nname: " + name + "\naction: " + action + "\ndescription: " + description + "\ntag: " + tag);
    }).fail(function(data) {
        console.log("There was an error while updating this test, please check the logs " + data);
    });
}

function deleteEvent(id_event) {
    jQuery.ajax({
        type: "POST",
        url: "/mobile/admin/requests/deleteEvent.php",
        data: {"id_event": id_event}
    }).done(function() {
        console.log("Event(" + id_event + ") was requested to be delted");
        window.location.href = "/mobile/admin/events";
    }).fail(function(data) {
        alert("event could not be deleted");
        console.log("There was an error while deleting the test " + data);
    });
}

/* BRANDS */
function createNewBrand(name, description) {
    console.log("Preparing to create a new brand...");
    console.log("{name: " + name + "\ndescription: " + description + "}");

    jQuery.ajax({
        type: "GET",
        url: "/mobile/admin/requests/createBrand.php",
        data: {"name": name, "description": description}
    }).done(function(data) {
        console.log("No error was detected recieved " + data);
        window.location.href = "/mobile/admin/brands/";
    }).fail(function(data) {
        console.log("There was an error while creating this test, please check the logs " + data);
    });
}

function updateBrand(id, name, description) {
    console.log("Preparing to update a brand...");
    console.log("id: " + id + "\nname: " + name + "\ndescription: " + description);

    jQuery.ajax({
        type: "GET",
        url: "/mobile/admin/requests/updateBrand.php",
        data: {"id_brand": id, "name": name, "description": description}
    }).done(function(data) {
        console.log("No error was detected recieved " + data);
        window.location.href = "/mobile/admin/brands/";
        alert("id: " + id + "\nname: " + name + "\naction: " + action + "\ndescription: " + description + "\ntag: " + tag);
    }).fail(function(data) {
        console.log("There was an error while updating this test, please check the logs " + data);
    });
}

function deleteBrand(id_brand) {
    jQuery.ajax({
        type: "POST",
        url: "/mobile/admin/requests/deleteBrand.php",
        data: {"id_brand": id_brand}
    }).done(function() {
        console.log("Brand(" + id_brand + ") was requested to be delted");
        window.location.href = "/mobile/admin/brands";
    }).fail(function(data) {
        alert("Brand could not be deleted");
        console.log("There was an error while deleting the brand " + data);
    });
}

/* MODELS */
function createNewModel(name, model, brand) {
    console.log("Preparing to create a new model...");
    console.log("{name: " + name + "\nmodel: " + model + "\nid_brand:" + brand + "}");

    jQuery.ajax({
        type: "GET",
        url: "/mobile/admin/requests/createModel.php",
        data: {"name": name, "model": model, "id_brand": brand}
    }).done(function(data) {
        console.log("No error was detected recieved " + data);
        window.location.href = "/mobile/admin/models/";
    }).fail(function(data) {
        console.log("There was an error while creating this model, please check the logs " + data);
    });
}

function updateModel(id, name, model, brand) {
    console.log("Preparing to edit a model...");
    console.log("\nid: " + id + "\nname: " + name + "\nmodel: " + model + "\nbrand: " + brand);

    jQuery.ajax({
        type: "GET",
        url: "/mobile/admin/requests/updateModel.php",
        data: {"id_model": id, "name": name, "model": model, "brand": brand}
    }).done(function(data) {
        console.log("No error was detected recieved " + data);
        window.location.href = "/mobile/admin/models/";
    }).fail(function(data) {
        console.log("There was an error while updating this evaluation, please check the logs " + data);
    });
}

function updateModels(id_model) {
    id_model = typeof id_model !== 'undefined' ? id_model : null;
    jQuery.ajax({
        type: "GET",
        url: "/mobile/admin/requests/getModels.php",
        data: {"id_brand": document.getElementById("brand").value, "id_model": id_model}
    }).done(function(data) {
        document.getElementById("model").innerHTML = data;
    }).fail(function(data) {
        alert("Unable to load " + data);
    });
}

function deleteModel(id_model) {
    jQuery.ajax({
        type: "POST",
        url: "/mobile/admin/requests/deleteModel.php",
        data: {"id_model": id_model}
    }).done(function() {
        console.log("Model(" + id_model + ") was requested to be delted");
        window.location.href = "/mobile/admin/models";
    }).fail(function(data) {
        alert("Model could not be deleted");
        console.log("There was an error while deleting the model " + data);
    });
}