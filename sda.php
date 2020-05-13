<?php
include "include/db_config.php";

$query = "SELECT * FROM admins";
if(!$conn) {
    echo mysqli_error($conn);
}
$row = mysqli_fetch_assoc(mysqli_query($conn,$query));

echo $row['pass'];

mysqli_close($conn);
?>
