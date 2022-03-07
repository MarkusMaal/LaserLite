<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if (!empty($_POST["options"])) {
    /* Attempt MySQL server connection. Assuming you are running MySQL
    server with default setting (user 'root' with no password) */
	include("common/connect.php");
    
    // Check connection
    if($connection === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
        echo '<p><span style="color: red;">Viga: </span>Serveriga ühendumine nurjus. Palun proovige hiljem uuesti.</p>';
    }
    
    // Escape user inputs for security
    $name = mysqli_real_escape_string($connection, $_REQUEST['question']);
    $comment = mysqli_real_escape_string($connection, $_REQUEST['options']);
    $passwd = md5(mysqli_real_escape_string($connection, $_REQUEST['options']) . '_' . mysqli_real_escape_string($connection, $_REQUEST['close']));
    if ($name == "@Markus [DELCOMMENT]") {
        $conn = $connection;
        $result = mysqli_query($conn, "SELECT * FROM poll");
        $all_property = array();
        while ($property = mysqli_fetch_field($result)) {
            array_push($all_property, $property->name);  //save those to array
        }
        $happy = FALSE;
        while ($row = mysqli_fetch_array($result)) {
            if ($row["public"] == "1") {
                if ($row["options"] == $comment) {
                    if ($row["close"] == $passwd) {
                        $sql = "DELETE FROM poll WHERE options=\"" . $row["options"] . "\"";
                        if ($conn->query($sql) === TRUE) {
                            echo '<p>Kommentaar "'. strip_tags($row["question"]) . '" kustutati</p>';
							$happy = TRUE;
                        } else {
                            echo '<p><span style="color: red;">Viga: </span> Kommentaaride kustutamine nurjus teadmata põhjusel.';
                            $happy = TRUE;
                        }
                    } else {
                        echo '<p><span style="color: red;">Viga: </span>Vale kasutajanimi ja/või parool</p>';
                        $happy = TRUE;
                    }
                }
            }
        }
        if ($happy == FALSE) {
            echo '<p><span style="color: red;">Viga: </span>Sellel kasutajal pole kommentaare, mida kustutada.</p>';
        }
    }
    else if ($name == "@Markus [HIDECOMMENT]") {
        echo '<p>Funktsiooni pole veel implementeeritud.</p>';
    } else {
        $ptime = (string)(time());
        // Attempt insert query execution
        $sql = "INSERT INTO poll (question, options, last_vote_date, close, public) VALUES ('$name', '$comment', '$ptime', '$passwd', '1')";
        if(mysqli_query($connection, $sql)){
            echo '<p><span style="color: green;">Õnnestus: </span>Kommentaar postitatud.</p>';
        } else{
            echo '<p><span style="color: red;">Viga: </span> Palun proovige hiljem uuesti.</p>';
            echo $connection->error;
        }
    }        
	echo '<a href="index.php">Tagasi avalehele</a>';
    // Close connection
    mysqli_close($connection);
    die();
}

include("common/connect.php");

//get results from database
$result = mysqli_query($connection,"SELECT * FROM poll ORDER BY last_vote_date DESC");
$all_property = array();  //declare an array for saving property

//showing property
/* echo '<table class="data-table">
        <tr class="data-heading">';  //initialize table tag*/
while ($property = mysqli_fetch_field($result)) {
    array_push($all_property, $property->name);  //save those to array
}
// echo '</tr>'; //end tr tag

//showing all data
echo '<h2 id="Comments">Kommentaarid ja tagasiside</h2>';
$visual_comments = 1;
while ($row = mysqli_fetch_array($result)) {
    if ((!empty($_SESSION["level"])) || ($row["public"] == "1")) {
        if ($row["options"] == "Markus Maal[id_admin]") {
            echo '<p> <span style="background-color: deepskyblue; padding: 2px; color: white;">Administraator</span> ütles';
        } else {
            echo '<p> <span style="background-color: black; padding: 2px; color: white;">' . strip_tags($row["options"]) . '</span> ütles';
        }
        if (!empty($_SESSION["level"])) {
        	if ($row["public"] == "0") {
        		echo ' <span style="color: #ff0000">(peidetud kommentaar)</span>';
        		if ($_SESSION["level"] == "owner") {
        			echo '<a href="?doc=development&s=6&id=' . $row["id"] . '"> taasta</a>';
        			echo '<a href="?doc=development&s=7&id=' . $row["id"] . '"> kustuta</a>';
        			echo '<a href="?doc=development&s=8&id=' . $row["id"] . '&usr=' . $row["options"] . '"> eemalda.parool</a>';
        		}
        	} else {
        		echo '<a href="?doc=development&s=5&id=' . $row["id"] . '"> peida</a>';
        	}
        }
        echo '</p>';
        echo '<p style="font-size: 10px;">' . str_replace("Z", "", str_replace("T", ", kell ", gmdate("Y-m-d\TH:i:s\Z", $row["last_vote_date"]))) . ' UTC+0</p>'; 
        echo '<span>' . strip_tags(str_replace("@", "<span style=\"color: deepskyblue;\">@", $row["question"]), '<p><a><b><i><u><h3><h4><br><ol><ul><li>') . '</span><br/><br/>';
		if ($visual_comments == 5) {
			echo '<a href="?s=5">Kuva kõik kommentaarid</a>';
			break;
		} else {
			$visual_comments++;
			echo '<hr>';
		}
    }
}
?>
<div id="newcomment">
<h2 >Uus kommentaar</h2>
<form action="?s=5" method="post">
    <p>
        <label for="options">Nimi/hüüdnimi</label><input style="width: 100%;" name="options"></input>
    </p>
    <p>
        <label for="question">Sisu</label><br/><textarea style="width: 100%;" name="question" cols="100" rows="5"></textarea>
    </p>
    <p>
        <label for="close">Parool haldamiseks</label><br/><input style="width: 100%;" name="close" type="password"></input>
    </p>
    <p>
        <br/>
        <a href="#/" class="listitems" onclick="this.closest('form').submit();return false;">Postita kommentaar</a>
    </p>
</div>
</form>

