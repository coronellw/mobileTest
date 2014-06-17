/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function getEvaluationDetail(fecha, id_device) {
    console.log("About to send ajax request");
    jQuery.ajax({
        type: "POST",
        url: "../requests/getTests.php",
        data: {"fecha": fecha, "id_device": id_device}
    }).done(function(data) {
        document.getElementById("tbody").innerHTML = data;
    });
    console.log("Ajax request was sent");
}