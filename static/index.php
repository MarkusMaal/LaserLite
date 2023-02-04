<!DOCTYPE html>
<html>
	<head>
		<title>.</title>
		<style>
            html, body {
				height: 100%;
				overflow: hidden;
                margin: 0px;
            }
            a [id="col"] {
                display: none;
            }
            div {
				position: fixed;
				width: 100%;
			}
			img[alt="www.000webhost.com"] {
				display: none;
			}
			.disclaimer
			{
				display:none;
			}
		</style>
	</head>
	<body >
		<div id="asdf">
		</div>
		<script src="script.js"></script>
		<?php
            if (!empty($_GET["type"])) {
                if ($_GET["type"] == "bnw") {
                    echo '<script>stop_play();</script>';
                } else if ($_GET["type"] == "color") {
                    echo '<script>set_color(); stop_play();</script>';
                }
            }
		?>
	</body>
</html>
