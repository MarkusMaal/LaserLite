<h2>Link image with a download</h2>
<?php

include("common/connect.php");
if (!empty($_POST) && ($_SESSION["level"] == "owner")) {
    $id = $_POST["id"];
    $image = "images/dloads/" . $_POST["img"];    
    $insertquery = 'INSERT INTO dscrnshots (URI, DLOAD) VALUES ("' . $image . '", ' . $id . ')';
    if ($connection->query($insertquery) === TRUE) {
        echo '<p style="color: #00ff00">Thumbnail successfully added</p>';
        $_POST = array();
    } else {
        die($insertquery . ' -> Something went wrong. Task cancelled');
    }
} else {
    if (!empty($_POST)) {
        $_POST = array();
        echo '<p style="color: #ff0000">Please log in with an owner account first</p>';
    }
}
?>
<form method="post" type="submit">
Uploaded image: images/dloads/<select name="img">
<?php
if ($handle = opendir($_SERVER["DOCUMENT_ROOT"] . '/markustegelane/images/dloads/')) {

    while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != "..") {
            echo '\t<option value="' . $entry . '">' . $entry . '</option>\n';
        }
    }

    closedir($handle);
}
?>
</select>
<br/><br/>
Download ID: <select name="id">
<?php
    $query = "SELECT * FROM dloads";
    $result = mysqli_query($connection, $query);
    while ($c = mysqli_fetch_array($result)) {
        echo '\t<option value="' . $c[0] . '">' . $c["DTITLE"] . ' [' .  $c[0] . ']</option>\n';
    }
?>
</select><br/><br/>
<input type="submit" value="Add"></input>
</form>
