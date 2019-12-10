<?php

$server = "localhost";
$user = $_POST['user'];
$pw = $_POST['pw'];
$db = $_POST['db'];
$connect = new mysqli($server, $user, $pw, $db);

if ($connect->connect_error) {
        die("ERROR. <br> Alguno de los parametros introducidos son incorrectos.");
}


$sql = "select table_name from information_schema.tables where table_schema like '$db'";

echo '<html>';
echo '<body style= "background: blue">';

$result = $connect->query($sql);
if ($result->num_rows > 0) {
        echo "Base de datos $db";
        echo "<br>";
        echo "<br>";
        while($row = $result->fetch_assoc()) {
                echo "<form method=post action=tabla.php>";
                echo "<input type=hidden name=user value={$user}>";
                echo "<input type=hidden name=pw value={$pw}>";
                echo "<input type=hidden name=db value={$db}>";
                echo "<input type=submit name=table value={$row['table_name']}>";
                echo "<br>";
                echo "</form>";

        }
} else {
        echo "La tabla esta vacia";
}

echo '</body>';
echo '</html>';

$connect->close();

?>
