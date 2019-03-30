<?php
$connection = new mysqli('localhost', 'root', '', 'phpajax');
if(!$connection){
	die("Database Connection Failed" . $connection->error);
}

?>
 
<!DOCTYPE html>
<html>
<head>
	<title>Ajax Country State Select List</title>
	<style type="text/css">
		#state-select,#city-select{
			display: none;
		}
	</style>
</head>
<body>
<div id="form">
	<h2>Select the Country & State</h2>
	<select id="country-select">
		<option  selected>Please Select Country</option>
		<?php
			$sql = "SELECT * FROM countries";
			$result = mysqli_query($connection, $sql);
			while($row = mysqli_fetch_assoc($result)){
		?>
		<option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
		<?php } ?>
	</select>
	<br/>
	<select id="state-select">
		
	</select>
	<select id="city-select">
		
	</select>
	<script type="text/javascript">
		function getStatesSelectList(){
			var country_select = document.getElementById("country-select");
			var city_select = document.getElementById("city-select");
			
			var country_id = country_select.value;
			console.log('CountryId : ' + country_id);
 
			var xhr = new XMLHttpRequest();
			var url = 'states.php?country_id=' + country_id;
			// open function
			xhr.open('GET', url, true);
			xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			
			// check response is ready with response states = 4
			xhr.onreadystatechange = function(){
				if(xhr.readyState == 4 && xhr.status == 200){
			 		var text = xhr.responseText;
					//console.log('response from states.php : ' + xhr.responseText);
					var state_select = document.getElementById("state-select");
					state_select.innerHTML = text;
					state_select.style.display='inline';
					city_select.style.display='none';
				}
			}
 
			xhr.send();
		}
 
		function getCitySelectList(){
			var state_select = document.getElementById("state-select");
 
			var state_id = state_select.value;
			console.log('StateId : ' + state_id);
 
			var xhr = new XMLHttpRequest();
			var url = 'cities.php?state_id=' + state_id;
			// open function
			xhr.open('GET', url, true);
			xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			
			// check response is ready with response states = 4
			xhr.onreadystatechange = function(){
				if(xhr.readyState == 4 && xhr.status == 200){
					var text = xhr.responseText;
					//console.log('response from cities.php : ' + xhr.responseText);
					var city_select = document.getElementById("city-select");
					city_select.innerHTML = text;
					city_select.style.display='inline';
				}
			}
 
			xhr.send();
		}
 
		var country_select = document.getElementById("country-select");
		country_select.addEventListener("change", getStatesSelectList);
 
		var state_select = document.getElementById("state-select");
		state_select.addEventListener("change", getCitySelectList);
	</script>
</div>
</body>
</html>