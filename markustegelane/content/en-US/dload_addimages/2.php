<h2>Unlink image from a download</h2>
<?php
include("common/connect.php");
if (!empty($_POST) && ($_SESSION["level"] == "owner")) {
    $id = $_POST["id"];
    $image = "images/dloads/" . $_POST["img"];    
    $insertquery = 'DELETE FROM dscrnshots WHERE ID = ' . $id;
    if ($connection->query($insertquery) === TRUE) {
        echo '<p style="color: #00ff00">Thumbnail unlinked successfully</p>';
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
<br/><br/>
Screenshot ID: <select name="id">
<?php
    $query = "SELECT * FROM dscrnshots";
    $result = mysqli_query($connection, $query);
    while ($c = mysqli_fetch_array($result)) {
        echo '\t<option value="' . $c[0] . '">' . $c["URI"] . ' [' .  $c[0] . ' -&gt; ' . $c["DLOAD"] . ']</option>\n';
    }
?>
</select><br/><br/>
<input type="submit" value="Remove"></input>
</form>
