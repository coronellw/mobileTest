<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Mobile testing app</title>
		<script type="text/javascript" src="js/checkDevise.js" ></script>
		<script type="text/javascript" src="js/customMouseEvents.js" ></script>
		<script type="text/javascript" src="js/testing.js"></script>
	</head>
	<body>
		<?php 
			include 'db_info.php';
			$link = mysqli_connect($hst, $usrnm, $psswrd, $schm) or die("Error " . mysqli_error($link));
			$query = "SELECT * FROM evaluations" or die("Error ".mysqli_error($link));
			$result = $link->query($query);
		?>
		<center>
			<form action="test.php" method="get">
				Antes de continuar por favor ingrese el número de imei
				<table>
					<tr>
						<td>
							<label>IMEI / ESN : </label>
						</td>
						<td>
							<input id="imei" type="number" name="imei" value="<?php echo $imei ?>" required>
						</td>
					</tr>
					<tr>
						<td>
							<label>Evaluation type:</label>
						</td>
						<td>
							<select id="eval_type" name="eval_type" >
								<?php while($row = mysqli_fetch_array($result)){ ?>
									<option value="<?php echo $row['id_evaluation'] ?>"><?php echo $row["name"] ?></option>
								<?php } ?>
							</select>
						</td>
					</tr>
				</table>
				<button type="button" onclick="checkIMEI();">Start testing</button>
			</form>
		</center>
	</body>
</html>