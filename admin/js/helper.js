/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


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

function createNewTest(name, action, description, tag, evaluation) {
    console.log("Preparing to create a new test...");
    console.log("name:" + name + "\naction:" + action + "\ndescription:" + description + "\ntag:" + tag);
    evaluation = typeof evaluation === 'number' ? evaluation : null;
    jQuery.ajax({
        type: "GET",
        url: "/mobile/admin/requests/createTest.php",
        data: {"name": name, "action": action, "description": description, "tag": tag, "evaluation": evaluation}
    }).done(function(data) {
        console.log("No error was detected recieved " + data);
        if (!confirm('Click accept to create another test')) {
//            window.location.href = "/mobile/admin/tests/";
        }
    }).fail(function(data) {
        console.log("There was an error while creating this test, please check the logs " + data);
    });
}