<?php
	require 'vendor/autoload.php';
	$client = new MongoDB\Client;
	$collection = $client->dbforlab->literature;

	$start_date = $_GET['start_date'];
	$end_date = $_GET['end_date'];
	$result=$collection->find(array('year' => array('$gt' =>  intval($start_date), '$lt' => intval($end_date))));
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
			if(!array_key_exists("$value", $r)) echo " ";
			else if($value == "authors" or $value == "resources"){
				foreach($r["$value"] as $v)
					echo $v;
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
		var key = '<?php echo $end_date;?>'; 
		localStorage.setItem(key, arr);
	}
</script>
<body onload = "add();"></body>