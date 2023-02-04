	<style>
		body {
			<?php
			include($_SERVER["DOCUMENT_ROOT"] . "/mobcheck.php");
			if (($theme != "light") && ($theme != "dark") && ($theme != "blue")) {
				$theme = "dark";
			}
			switch ($theme) {
				case "light":
					echo 'background: #bbb;';
					echo 'color: #000;';
					echo 'background-color: #fff;';
					break;
				case "dark":
					echo 'background: #222;';
					echo 'color: #fff;';
					echo 'background-color: #222;';
					break;
				default:
					echo 'background: #008;';
					echo 'color: #fff;';
					echo 'background-color: #008;';
					break;
			}
			?>
			background-size: 50% 100%;
			font-family: "Segoe UI", "Microsoft Sans Serif", "Ubuntu", "Sans";
		}
		h1 {
			font-style: normal;
			font-weight: normal;
			text-align: left;
			padding-top: 1em;
			float: left;
			width: 100%;
		}
		
		p {
			float: left;
			width: 100%;
		}
		
		hr {
			float: left;
			width: 100%;
		}
		
		h2 {
			font-style: normal;
			font-weight: normal;
			text-align: left;
		}
		
		.cont {
			margin-left: auto;
			margin-right: auto;
			vertical-align: bottom;
			padding: 3em;
			<?php if (!$isMob) {
				echo 'padding: 3em;';
			} else {
				echo 'padding: 1em;';
			} ?>
			width: 90%;
			background: #<?php
				if ($theme == "dark") {
					echo '333';
				} else {
					echo "fff";
				}
			?>;
			margin-top: 1em;
			color: #<?php
				if ($theme == "dark") {
					echo 'fff';
				} else {
					echo "000";
				}
			?>;
			float: left;
			margin-bottom: 5em;
		}
		
		.cont a {
			color: #<?php
				if ($theme == "dark") {
					echo '088';
				} else {
					echo "008";
				}
			?>;
		}
		
		table {
			border-collapse: collapse;
			margin:0 auto;
			width: 100%;			
			display: flex;
			overflow-x: auto;
		}
		.thumb {
			border: 0.15em solid;
			border-color: #fff #888 #888 #fff;
			margin: 0em;
			padding: 0em;
			width: 96px;
			height: 96px;
		}
		
		.thumb:active {
			border: 0.17em solid;
			border-color: #888 #fff #fff #888;
			width: 95px;
			height: 95px;
			filter: brightness(95%);
		}
		
		img {
			margin: 0em;
			padding: 0em;
		}
		
		.desc {
			text-align: center;
		}
		
		td {
			margin: 1.5em;
			text-align: center;
			padding: 0.5em;
		}
		
		a {
			transition: 0.2s;
			text-decoration: none;
			<?php
				if ($theme == "light") {
					echo 'color: #0f8;';
				} else {
					echo 'color: #0ff;';
				}
			?>
		}
		
		a:hover {
			color: #0ff;
		}
		
		p.copy {
			color: #0aa;
			text-align: center;
		}
		
		p.copy:hover {
			animation: hover 1s linear infinite;
			cursor: default;
		}
		
		.blink {
			animation: blink 1s linear infinite;
		}
		.blink-soft {
			animation: teeter 1s linear infinite;
			color: #f00;
		}
		.sizable {
			animation: zoom 20s linear infinite;
		}
		.colorful {
			animation: colors 5s linear infinite;
		}
		.unlogic {
			position: fixed;
			font-family: "Comic Sans MS", "Segoe UI", "Microsoft Sans Serif", "Ubuntu", "Sans";
			animation: fun 4s linear infinite;
		}
		
		@keyframes fun {
			0%{ font-size: 1em; left: 0em; top: 0em; color: #ff0; }
			15%{ font-size: 8em; left: 1.4em; top: 0em; -webkit-transform: rotate(-45deg); -moz-transform: rotate(-45deg); color: #0ff; }
			50%{ font-size: 0.5em; left: 18em; top: 20em; -webkit-transform: rotate(80deg); -moz-transform: rotate(80deg); color: #f0f; }
			75%{ font-size: 8em; left: 0em; top: 4em; -webkit-transform: rotate(-100deg); -moz-transform: rotate(-100deg); color: #f00; }
			100%{ font-size: 1em; left: 0em; top: 0em; -webkit-transform: rotate(0deg); -moz-transform: rotate(0deg); color: #ff0; }
		}
		
		@keyframes zoom{
			0%{
				font-size: 0.5em;
			}
			50%{
				font-size: 8em;
			}
			100%{
				font-size: 0.5em;
			}
		}
		@keyframes colors{
			0%{
				color: #f00;
			}
			16%{
				color: #ff0;
			}
			32%{
				color: #0f0;
			}
			49%{
				color: #0ff;
			}
			66%{
				color: #00f;
			}
			84%{
				color: #f0f;
			}
			100%{
				color: #f00;
			}
		}
		@keyframes blink{
			0%{
				opacity: 1;
			}
			49%{
				opacity: 1;
			}
			50%{
				opacity: 0;
			}
			99%{
				opacity: 0;
			}
			100%{
				opacity: 1;
			}
		}
		@keyframes hover {
			50%{
				color: #0cc;
			}
			100%{
				color: #0aa;
			}
		}
		
		@keyframes teeter{
			0%{
				opacity: 1;
			}
			50%{
				opacity: 0;
			}
			100%{
				opacity: 1;
			}
		}
		img[alt="www.000webhost.com"]
		{
			display:none;
		}

		.disclaimer
		{
			display:none;
		}
		
		hr {
			border: solid 0.15em;
			border-color: <?php
		
		switch ($theme) {
			default:
				echo '#00a';
				break;
			case "light":
				echo '#aaa';
				break;
			case "dark":
				echo '#555';
				break;
		}
				?>;
			margin: 0.15em;
		}
		
		div.setting {
			background: <?php
		
		switch ($theme) {
			default:
				echo '#eee;';
				break;
			case "light":
				echo '#efefef;';
				break;
			case "dark":
				echo '#222;';
				break;
		}
				?>
			<?php if (!$isMob) {
				echo 'padding: 3em;';
			} else {
				echo 'padding: 2em;';
			}
			?>
			box-sizing: border-box;
			float: left;
			width: 100%;
			<?php if ($theme == "dark") { echo "color: #fff;"; } else { echo "color: #000;"; }?>
		}
		
		div.button, div.backbutton, div.nobutton, input[type="submit"], div.redbutton, div.ratebutton, a.listitems {
			background-clip: content-box;
			background: <?php
		
		switch ($theme) {
			default:
				echo '#008';
				break;
			case "light":
				echo '#225';
				break;
			case "dark":
				echo '#333';
				break;
		}
				?>;
			padding: 1em;
			margin-top: 1em;
			color: #fff;
			transition: 0.5s;
			display: block;
			box-sizing: content-box;
			float: left;
			cursor: pointer;
			border: solid 0.1em;
			border-color: #0ff0;
			margin-right: 1em;
			<?php 
				if ($isMob) {
					echo 'width: 85%;';
				}
			?>
		}
		
		input[type="submit"] {
			border-radius: 0px;
		}
		
		.normaltable {
			<?php 
				if ($theme == "blue") {
					echo "color: #000;";
				}
			?>
		}
		
		td.normaltable {
			text-align: left;
			padding-left: 1em;
		}
		
		th.normaltable {
			padding-left: 1em;
			font-weight: normal;
		}
		
		div.redbutton {
			background: #800;
		}
		
		div.redbutton:hover {
			background: #f00;
			border-color: #ff0f;
		}
		
		input[type="text"], input[type="password"], select, textarea {
			background: #<?php
		
		switch ($theme) {
			default:
				echo 'ccc';
				break;
			case "light":
				echo 'fff';
				break;
			case "dark":
				echo '333';
				break;
		}
				?>;
			color: #<?php
		
		switch ($theme) {
			default:
				echo '000';
				break;
			case "dark":
				echo 'fff';
				break;
		}
				?>;
			border: solid 0.2em;
			padding: 1em;
			border-radius:  1.5em;
			float: left;
			margin-top: 0.5em;
			transition: 0.2s;
			border-color: #<?php
		
		switch ($theme) {
			default:
				echo '003';
				break;
			case "light":
				echo '555';
				break;
			case "dark":
				echo '222';
				break;
		}
				?>;
		}
		
		input[type="text"]:hover, input[type="password"]:hover, select:hover, textarea:hover {
			background: #<?php
		
		switch ($theme) {
			default:
				echo 'eee';
				break;
			case "light":
				echo 'bbb';
				break;
			case "dark":
				echo '555';
				break;
		}
				?>;
		}
		input[type="checkbox"] {
			-webkit-appearance:none;
			border-radius:4em;
			background-color:#003;
			height:1.5em;
			width:1.5em;
			cursor:pointer;
			position:relative;
			-webkit-transition: .10s;
			vertical-align: middle;
		}
		input[type="checkbox"]:hover {
			background-color:#00f;
		}
		input[type="checkbox"]:checked {
			background-color:blue;
		}
		input[type="checkbox"]:before, input[type="checkbox"]:checked:before {
			position:absolute;
			top:0;
			left:0;
			width:100%;
			height:100%;
			line-height:1.5em;
			text-align:center;
			color:#0f0;
		}
		input[type="checkbox"]:checked:before {
			content: '✔';
		}
		
		input[type="submit"]:hover {
			background: #<?php
		
		switch ($theme) {
			default:
				echo '00f';
				break;
			case "light":
				echo '00f';
				break;
			case "dark":
				echo '666';
				break;
		}
				?>;
			border-color: #<?php
		
		switch ($theme) {
			default:
				echo '0ff';
				break;
			case "light":
				echo '0ff';
				break;
			case "dark":
				echo '222';
				break;
		}
				?>;
			animation-name: glow;
			animation-duration: 5s;
			animation-iteration-count: infinite;
		}
		
		
		
		div.backbutton {
			padding: 0.5em;
			background: #005;
			border: solid 0.1em;
			border-color: #0ff0;
			transition: 0.4s;
		}
		
		div.backbutton:hover
		{
			background: #00f;
			border-color: #0ff;
			animation-name: glow;
			animation-duration: 5s;
			animation-iteration-count: infinite;
		}
		
		table.normaltable {
			margin-left: 0px;
			text-align: left;
		}
		
		@keyframes glow {
			<?php
		
		switch ($theme) {
			default:
				echo '
			0% {border-color: #0ff;}
			50% {border-color: #088;}
			100% {border-color: #0ff;}';
				break;
			case "dark":
				echo '
			0% {border-color: #aaa;}
			50% {border-color: #555;}
			100% {border-color: #aaa;}';
				break;
		}
				?>
		}
		
		div.nobutton {
			background: <?php
		
		switch ($theme) {
			default:
				echo '#008a';
				break;
			case "light":
				echo '#225a';
				break;
			case "dark":
				echo '#3333';
				break;
		}
				?>;
			border: solid 0.1em;
			border-color: #0ff0;
			cursor: not-allowed;
			<?php 
				if ($isMob) {
					echo 'width: 85%;';
				}
			?>
		}
		
		div.button:hover, div.backbutton:hover, a.listitems:hover {
			background: #<?php
		
		switch ($theme) {
			default:
				echo '00f';
				break;
			case "light":
				echo '00f';
				break;
			case "dark":
				echo '666';
				break;
		}
				?>;
			border-color: #<?php
		
		switch ($theme) {
			default:
				echo '0ff';
				break;
			case "light":
				echo '0ff';
				break;
			case "dark":
				echo '222';
				break;
		}
				?>;
			animation-name: glow;
			animation-duration: 5s;
			animation-iteration-count: infinite;
		}
		
		div.cut {
			width: 90%;
			margin: auto;
		}
		
		div.comment_section {
			float: left;
		}
		
		div.inline-cont {
			display: inline;
			float: none;
		}
		
		div.inline-cont a, div.inline-cont p, div.inline-cont hr, div.inline-cont input, div.inline-cont textarea, div.inline-cont a.listitems {
			float: none;
			display: inline-block;
		}
		
		.inline-cont.listitems {
			display: inline-block;
		}
		
	</style>