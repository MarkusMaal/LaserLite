
<?php
$remote = true;
if ($remote == true) {
$user    = "username_here";
$pass    = "password_here";
} else {
$user    = "username_here";
$pass    = "password_here";
}
$host    = "localhost";
$db_name = "database_name";

//create connection
$connection = mysqli_connect($host, $user, $pass, $db_name);

$connection_error = 0;
//test if connection failed
if(mysqli_connect_errno()){
    $connection_error = 1;
}
if ($connection_error) {
	echo "<p>Well, this is embarassing!</p>";
}
?>
