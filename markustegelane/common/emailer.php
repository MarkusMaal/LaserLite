<?php
ini_set( 'display_errors', 1 );
error_reporting( E_ALL );
   $query = "SELECT * FROM general_comments LEFT JOIN sent_emails ON general_comments.ID = sent_emails.COMMENT_ID WHERE general_comments.ID > 165";
   $result = mysqli_query($connection, $query);

	while ($row = mysqli_fetch_array($result)) {
		if ($row["COMMENT_ID"] == NULL) {
			$from = "no-reply@markustegelane.online";
			$to = "markus.maal@gmail.com";
			$subject = "uus kommentaar kasutajalt " . $row["NAME"] . " [markustegelane veebileht]";
		   $message = "Uus kommentaar markustegelane veebilehel:\n\nSaatja: " . $row["NAME"] . "\nSisu: " . $row["COMMENT"] . "\n\nSee kiri saadeti teile, kuna olete veebilehe markustegelane.online administraator. Tegu on automaatse kirjaga, millele pole vaja vastata.";
		  // The content-type header must be set when sending HTML email
		   $headers = "MIME-Version: 1.0" . "\r\n";
		   $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		   $headers = "From:" . $from;
		   $query2 = "INSERT INTO sent_emails (COMMENT_ID) VALUES (" . $row[0] . ")";
		   if ($connection->query($query2) === TRUE) {
		   		echo "Kommentaar märgitud<br/>";
		   } else {
		   		die("Kommenaari märkimine nurjus<br/>");
		   }
		   mail($to,$subject,$message, $headers);
		}
	}
   
?>
