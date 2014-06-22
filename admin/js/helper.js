/* EVALUATIONS */
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
    console.log("Preparing to edit a new test...");
    console.log("id: " + id + "\nname: " + name + "\naction: " + action + "\ndescription: " + description + "\ntag: " + tag);

    jQuery.ajax({
        type: "GET",
        url: "/mobile/admin/requests/updateTest.php",
        data: {"id_test": id, "name": name, "action": action, "description": description, "tag": tag}
    }).done(function(data) {
//        alert("check the response now!");
        console.log("No error was detected recieved " + data);
        window.location.href = "/mobile/admin/tests/";
    }).fail(function(data) {
        console.log("There was an error while creating this test, please check the logs " + data);
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
        console.log(id_test + " was deleted from the database");
    }).fail(function(data) {
        console.log("There was an error while deleting the test " + data);
    });
}