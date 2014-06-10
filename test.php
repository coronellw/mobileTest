<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Mobile testing app</title>
		<link rel="stylesheet" type="text/css" href="css/jquery.mobile.css">
		<link rel="stylesheet" type="text/css" href="css/main.css">
		<script type="text/javascript" src="js/jquery.js" ></script>
		<script type="text/javascript" src="js/jquery.mobile.js" ></script>
		<script type="text/javascript" src="js/checkDevise.js" ></script>
		<script type="text/javascript" src="js/testing.js"></script>
	</head>
	<body>
		<div class="container">
			<?php 
				include 'db_info.php';
				$eval_type = $_GET["eval_type"];
				$imei = $_GET["imei"];
				$link = mysqli_connect($hst, $usrnm, $psswrd, $schm) or die("Error " . mysqli_error($link));
				
				// inserting the new IMEI into the database
				$query = "INSERT INTO devices(imei, last_use) VALUES ('".$imei."',NOW()) ON DUPLICATE KEY UPDATE last_use = NOW();";
				if (!mysqli_query($link, $query)) {
					die("Error: ".mysqli_error($link));
				}
				
				// retrieve inserted device ID
				$device_id = mysqli_insert_id($link);
				
				// insert relationship between IMEI and evaluation
				$query = "INSERT INTO device_evaluation(id_device, id_evaluation) VALUES ('".$device_id."','".$eval_type."');";
				$result = $link->query($query);
	
				// prepare query to retrieve all the tests related to the evaluation selected
				$query_tests = "SELECT t.name, t.tag, t.action, t.description, t.id_test FROM evaluation_test et, tests t WHERE et.id_test = t.id_test AND  et.id_evaluation = ".$eval_type;
				$tests = $link->query($query_tests);
			?>
			<center>
				<header>
					<button>Reset</button>
					<button id="send_btn" onclick="send_results();" >Enviar prueba</button>
				</header>
			</center>
			
			<center>
				<h1>Testing app for <span id="equipment"></span></h1>
	
				<table id="mainTable">
					<tr>
						<td class="label">IMEI :</td>
						<td id="imei" class="text"><?php echo $imei; ?></td>
						<td class="label">EVALUATION : </td>
						<td id="evaluation" class="text"><?php 
							$query = "SELECT e.name, e.time FROM evaluations e WHERE id_evaluation =".$eval_type or die("Error ".mysqli_error($link));
							$result = $link->query($query);
							$row = mysqli_fetch_array($result);
							echo $row["name"];
							$eval_time = $row["time"];
						?></td>
					</tr>
					
					<tr>
						<td class="label">STATUS : </td>
						<td id="status" class="text">Uninitialized</td>
						<td class="label">TIME REMAINING : </td>
						<td id="timer" class="text">Uninitialized</td>
					</tr>
				</table>
			</center>
	
			<div id="parent">
				<?php 
					$tests_array = array();
					$tests_array2 = array();
					while($row = mysqli_fetch_array($tests)){
						// prints the div that will store the tag
						echo "<div id='".$row["tag"]."' class='test' >".$row["name"]."</div>";
						// sets the timer of the test
						$tests_array[] = $row;
						$tests_array2[$row["tag"]][] = $row;
					}
				 ?>
				<script type="text/javascript">
					var pruebas = <?php echo json_encode($tests_array); ?>;
					var pruebas2 = <?php echo json_encode($tests_array2); ?>;
					var eval_time = <?php echo $eval_time ?>*1000;

					// console.dir(pruebas2);
					for (var objeto in pruebas2) {
						console.log(pruebas2[objeto][0].name + " has description : "+ pruebas2[objeto][0].description);
					};

					for (var i = 0; i < pruebas.length; i++) {
						var prueba = pruebas[i];
						that = this;

					 	prueba.funcion = function (prueba){
							return function() {
								console.log("{\nid_test: " + prueba.id_test + ",\nname : " + prueba.name + ",\ndescription : "+prueba.description+",\naction : " + prueba.action + "\ntag : " + prueba.tag + "\n};");
							};
						}(prueba);
					};
				</script>
			</div>
	
			<footer style="display: none;">
				<table id="debugger">
					<tr> 
						<td>X :</td>
						<td id="varx">0</td>
						<td></td>
						<td >Y :</td>
						<td id="vary">0</td>
						<td></td>
						<td >Z :</td>
						<td id="varz">0</td>
					</tr>
					<tr>
						<td >Initial x : </td>
						<td id="initialx">0</td>
						<td></td>
						<td >Initial y : </td>
						<td id="initialy">0</td>
						<td></td>
						<td >Final x : </td>
						<td id="finalx">0</td>
						<td></td>
						<td>Final y :</td>
						<td id="finaly">0</td>
					</tr>
					<tr>
						<td>Current x : </td>
						<td id="currentx">0</td>
						<td></td>
						<td>Current y : </td>
						<td id="currenty">0</td>
						<td></td>
						<td>Touch 1 : </td>
						<td id="touch1">inactive</td>
						<td></td>
						<td>Touch 2 :</td>
						<td id="touch2">inactive</td>
					</tr>
				</table>
			</footer>
		</div>
	</body>
</html>