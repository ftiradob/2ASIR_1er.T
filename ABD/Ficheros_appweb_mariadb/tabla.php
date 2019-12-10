<?php

$server = "localhost";
$user = $_POST['user'];
$pw = $_POST['pw'];
$db = $_POST['db'];
$connect = new mysqli($server, $user, $pw, $db);

if ($connect->connect_error) {
        die("ERROR. <br> Alguno de los parametros introducidos son incorrectos.");
}

$hola = $_POST['table'];
$sql = "select column_name from information_schema.columns where table_schema='$db' and table_name='$hola'";
$sqlsegundo = "select * from $hola";

echo '<html>';
echo '<body style= "background: blue">';
$result = $connect->query($sql);
if ($result->num_rows > 0) {
        echo "Tabla $hola";
        echo "<br>";
        echo "<br>";
	echo "<table>";
	echo "<tr>";
        while($row = $result->fetch_assoc()) {
		$campo = $row["column_name"];
                echo "<th>". $row["column_name"]. "</th>";
	$result2 = $connect->query($sqlsegundo);
	while($row = $result2->fetch_assoc()) {
                echo "<td>". $row["$campo"]. "</td>";
        }
	echo "</tr>";
        }
	echo "</table>";
} else {
        echo "La tabla esta vacia";
}

echo '</body>';
echo '</html>';

$connect->close();

?>

