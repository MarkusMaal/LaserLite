<?php 
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
if ((empty($_SESSION)) || ($_SESSION["level"] != "owner")) {
	$_POST = array();
	die("Session not started yet. Please <a href=\"../markustegelane/common/config/login.php?redir=mysql_console\">log in</a>.");
}
ini_set('display_errors', '1'); ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>mysql_console</title>
		<style>
            body {
                font-family: "Segoe UI";
                background: #000;
                color: #0a0;
            }
            
            p:hover, li:hover {
                color: #aa0;
            }
            
            h1 {
                font-weight: normal;
            }
            a {
                color: #b0b;
                text-decoration: none;
            }
            
            a:hover {
                text-decoration: underline;
                text-decoration-color: #aaa;
            }
            
            h2 {
                font-weight: normal;
                font-size: 14pt;
                color: #0aa;
            }
            
            input, textarea {
                color: #fff;
                background: #000;
                padding: 10px;
                border: #00a;
                border-style: solid;
                border-width: 2px;
                font-size: 12pt;
            }
            
            input:hover, textarea:hover {
                border-color: #00f;
            }
            
            li {
                list-style: none;
            }
            
            th {
                background: #aaa;
                margin: 10px;
                padding: 2px;
                font-weight: normal;
                color: #00a;
            }
            
            th:hover {
                color: #00f;
                background: #fff;
            }
            
            
            td:hover {
                background: #222;
                color: #fff;
            }
            
            table {
                color: #aaa;
            }
            
            img.mt {
                position: fixed;
                bottom: 40px;
                right: 40px;
                width: 300px;
                opacity: 0.25;
            }
            
            img.mt:hover {
                opacity: 1.0;
            }
            
            div.cmd {
                <?php 
                    if (!empty($_GET["cmd"])) {
                        echo 'display: block;';
                    } else {
                        echo 'display: none;';
                    }
                ?>
                
            }
		</style>
	</head>
	<body>
	<h1>MySQL console</h1>
        <div class="cmd">
            <form action="index.php" method="post" name="form1">
                <textarea style="width: 90%; height: 50px;" name="command"></textarea><br/>
                <input type="submit" value="Run"></input>
            </form>
		</div>
		<br/>
		<?php 
            if (empty($_GET["cmd"])) {
                echo '<a href="?cmd=1">Run command</a><br/>';
            }?>
            
		<a href="export.php">Export database</a><br/>
		<a href="index.php">List tables</a><br/>
		<a href="/index.php">Go back</a>
		<?php 
            include("../connect.php");
			if ((!empty($_POST)) || (!empty($_GET["table"]))) {
                if (!empty($_POST)) { $cmd = $_POST["command"]; }
                else { $cmd = "SELECT * FROM " . $_GET["table"]; }
				if (substr( strtoupper($cmd), 0, 6 )  == "SELECT") {
					$display_table = true;
				} else {
					$display_table = false;
				}
				if ($display_table) {
                    echo '<h2>Table query</h2>';
                    echo '<p>' . $cmd . '</p>';
					$result = mysqli_query($connection, $cmd);
					echo '<table>';
					echo '<tr>';
					$cols = 0;
					while ($property = mysqli_fetch_field($result)) {
			    			echo '<th>' . $property->name . '</td>';
			    			$cols++;
				    	}
					echo '</tr>';
					while ($row = mysqli_fetch_array($result)) {
						echo '<tr>';
						for ($i = 0; $i < $cols; $i++)
						{
							echo '<td>' . htmlspecialchars($row[$i], ENT_QUOTES, 'UTF-8') . '</td>';
						}
						echo '</tr>';
					}
					echo '</table>';
				} else {
                    echo '<h2>Database command</h2>';
                    echo '<p>' . $cmd . '</p>';
					if ($connection->query($cmd) === TRUE) {
						echo '<span style="color: #0f0">Query completed successfully</span>';
					} else {
						echo '<span style="color: #f00">Query failed</span><br/><p>Reason: ' . $connection->error . '</p>';
					}
					echo '<br/>';
				}
			} else {
                echo '<h2>List of tables</h2><ul>';
                $sql = "SHOW TABLES FROM $db_name";
                $result = mysqli_query($connection, $sql);
                if (!$result) {
                    echo "<span style=\"color: red\">Warning: Cannot fetch tables!<span><br/>\n";
                    echo 'MySQL Error: ' . mysql_error();
                    exit;
                }
                while ($row = mysqli_fetch_row($result)) {
                    echo '<li><a href="?table=' . $row[0] . '">' . $row[0] . '</a></li>';
                }
                echo '</ul>';
			}
		?>
		<img class="mt" src="/markustegelane/images/jsoftware-en.png"/>
	</body>
</html>
		
