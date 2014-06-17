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
    }).fail(function(data){
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