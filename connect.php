<?php
$remote = false;
$isSsl = false;
$hacking_time = '<iframe width="560" height="315" src="https://www.youtube-nocookie.com/embed/pgl37R7hILE?autoplay=1&amp;showinfo=0&amp;loop=1&amp;start=2&amp;list=PL6WkVx7vhlogvj4kxSizthqQgxq3j0BmD&amp;rel=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
if (isset($_SERVER['HTTP_CF_VISITOR'])) {
    $cfDecode = json_decode($_SERVER['HTTP_CF_VISITOR']);
    if (!empty($cfDecode) && !empty($cfDecode->scheme) && $cfDecode->scheme == 'https') {
        $isSsl = true;
    }
} else if (!empty($_SERVER["HTTPS"])) {
    $isSsl = true;
}
if ($isSsl || empty($_POST) || ($remote == false)) {
    if (empty($_SESSION["level"]) || ($_SESSION["level"] != "owner")) {
        foreach($_GET as $key => $value) {
            if (str_contains($value, "<script>") || str_contains($value, "';") || str_contains($value, "\";")) {
                echo '<p>You are just a dirty hacker, aren\'t you?</p>';
                echo $hacking_time;
                die();
            }
        }
        if (!empty($_POST)) {
            foreach($_POST as $key => $value) {
                if (str_contains($value, "<script>") || str_contains($value, "';") || str_contains($value, "\";")) {
                    echo '<head><style>body { background: #000; color: #0f0; }</style></head><body><p>You are just a dirty hacker, aren\'t you?</p>';
                    echo $hacking_time;
                    echo '</body>';
                    die();
                }
            }
        }
        if (!empty($_SESSION)) {
            foreach($_SESSION as $key => $value) {
                if (str_contains($value, "<script>") || str_contains($value, "';") || str_contains($value, "\";")) {
                    echo '<p>You are just a dirty hacker, aren\'t you?</p>';
                    echo $hacking_time;
                    die();
                }
            }
        }
        if (!empty($_COOKIE)) {
            foreach($_COOKIE as $key => $value) {
                if (str_contains($value, "<script>") || str_contains($value, "';") || str_contains($value, "\";")) {
                    echo '<p>You are just a dirty hacker, aren\'t you?</p>';
                    echo $hacking_time;
                    die();
                }
            }
        }
    }



    if ($remote) {
        $user    = "";
        $pass    = "";
        $db_name = "";
    } else {
        $user    = "root";
        $pass    = "defPassWD345";
        $db_name = "markustegelane";
    }
    $host    = "localhost";
    #$db_name = "id17352682_id14214583_asdf";

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
    if (!function_exists("getUserIPs")) {
        include($_SERVER["DOCUMENT_ROOT"] . "/markustegelane/common/checktokens.php");
    }
    include($_SERVER["DOCUMENT_ROOT"] . "/markustegelane/common/emailer.php");
} else {
    $lang = "en-US";
    if (!empty($_COOKIE["lang"])) {
        $lang = $_COOKIE["lang"];
    }
    if ($lang == "en-US") {
        include($_SERVER["DOCUMENT_ROOT"] . "/markustegelane/errors/en-US/nonsecure.php");
        die();
    } else {
        include($_SERVER["DOCUMENT_ROOT"] . "/markustegelane/errors/et-EE/nonsecure.php");
        die();
    }
}
?>
