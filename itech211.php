<?php
	require 'vendor/autoload.php';
	$client = new MongoDB\Client;
	$collection = $client->dbforlab->literature;

	$publisher=$_GET["publisher"];
	$result=$collection->find(array('publisher' => $publisher));
	$array = iterator_to_array($result);
	
	$json = json_encode($array);
	
	$keys = array();
	foreach ($array as $k => $v) {
        foreach ($v as $a => $b) {
                $keys[] = $a;
        }
	}
	$keys = array_values(array_unique($keys));
	echo "<table border = 1><tr>";
	foreach (array_slice($keys,1) as $key => $value) {
		echo "<td>", $value, "</td>";
	}
	echo "</tr>";
	
	
	foreach ($array as $r){
		echo "<tr>";
	foreach (array_slice($keys,1) as $key => $value) {
			echo "<td>";
			if($value == "authors" or $value == "resources"){
				if(!array_key_exists("$value", $r)) echo " ";
				else
				foreach($r["$value"] as $v)
					echo $v, " ";
			}
			else echo ($r["$value"]);
			echo "</td>";
		}
		echo "</tr>";
	}
	echo "</table>";
?>

<script type="text/javascript">
	function add(){
		var arr =  '<?php echo $json; ?>';
		var key = '<?php echo $publisher;?>'; 
		localStorage.setItem(key, arr);
		
	}
</script>
<body onload = "add();"></body>

