
<form name = "query1" action = "itech211.php" method = "get">
			<br>
			<a>издательство: 			 </a><input type = "text" name = "publisher" id = "pb">
			<br>
			<p><input type="submit" value="ввести"></p>
</form>

			<input type="button" value="показать прошлый запрос" onclick="f('pb', 'publishers', 'publisher');">
			
<script type="text/javascript" method = "get">
	function f(id, tableId, elementId){
		var item = document.getElementById(id).value;
        var arr = localStorage.getItem(item);
		var result = JSON.parse(arr);
		//for(var i in result){
		var keys = Object.keys(result[0]);
		document.getElementById(elementId).innerHTML = '<table border = 1 id = ' + tableId +'><tr>';
		var table = document.getElementById(tableId); 
		var tr = document.createElement("tr");
		for(var i = 1; i<keys.length; i++){		
			tr.innerHTML += '<td>'+ keys[i] +'</td>';				
		}table.appendChild(tr);
		for(var j = 0; j < result.length; j ++){
			var tr = document.createElement("tr");
			for(var i=1; i<keys.length; i++){
				if (result[j][keys[i]] == null ){
					tr.innerHTML += '<td> </td>';
				} else{
					tr.innerHTML += '<td>' + result[j][keys[i]] + '</td>';
				}
			}table.appendChild(tr);
		}
		document.getElementById(elementId).innerHTML += '</table>';
	}
</script>			
<div id = "publisher"></div>

<form name = "query2" action = "itech212.php" method = "get">
			<br>
			<a>автор книги:              </a><input type = "text" name = "author" id = 'a'>
			<br>
			<p><input type="submit" value="ввести"></p>
			
</form>
<input type="submit" value="показать прошлый запрос" onclick = "f('a', 'authors', 'author');">
<div id = "author"></div>

<form name = "query3" action = "itech213.php" method = "get">
			<br>
			<a>начальный год: 			 </a><input type = "date" name = "start_date"><br>
			<br>
			<a>конечный год:            </a><input type = "date" name = "end_date" id = 'e'><br>
			<br>
			<p><input type="submit" value="ввести"></p>
			
</form>
<input type="submit" value="показать прошлый запрос" onclick = "f('e', 'dates', 'date');">
<div id = "date"></div>



