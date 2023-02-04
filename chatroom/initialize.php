<?php
	include($_SERVER["DOCUMENT_ROOT"] . "/connect.php");
	$connection->close();
	$user = "username";
	$pass = "password";
	$connection = new mysqli($host, $user, $pass, "u712253692_chatroom");
    $chatrooms = array();
	$users = array();
	$chatters = array();
	$messages = array();
	$attachments = array();
	$room_q = "SELECT * FROM chatrooms";
	$user_q = "SELECT * FROM members";
	$chtr_q = "SELECT * FROM chatters";
	$attachment_q = "SELECT * FROM attachments";
	$msgs_q = "SELECT * FROM messages ORDER BY(ID) ASC";
	$chatrooms_r = mysqli_query($connection, $room_q);
	$users_r = mysqli_query($connection, $user_q);
	$chatters_r = mysqli_query($connection, $chtr_q);
	$messages_r = mysqli_query($connection, $msgs_q);
	$attachment_r = mysqli_query($connection, $attachment_q);
	while ($row = mysqli_fetch_array($chatrooms_r)) { $chatrooms[] = $row; }
	while ($row = mysqli_fetch_array($users_r)) { $users[] = $row; }
	while ($row = mysqli_fetch_array($chatters_r)) { $chatters[] = $row; }
	while ($row = mysqli_fetch_array($messages_r)) { $messages[] = $row; }
	while ($row = mysqli_fetch_array($attachment_r)) { $attachments[] = $row; }
?>