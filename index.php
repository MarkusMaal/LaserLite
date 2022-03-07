<?php

function welcomeback() {
    unset($_COOKIE['cookie_ok']); 
    setcookie('cookie_ok', "o", -1, '/'); 
    if ($_COOKIE["theme"] != "dark") {
        setcookie("theme", "light", time()+2678400, "/");
    }
    echo '<meta http-equiv="Refresh" content="0; URL=/markustegelane?doc=welcomeback">';
}
$display_placeholder = false;
include("maintenance.php");
if ((!empty($_COOKIE["cookie_ok"])) && ($_COOKIE["cookie_ok"] == "true")) {
    welcomeback();
} else if (empty($_COOKIE["lang"])) {
    echo '<meta http-equiv="Refresh" content="0; URL=/markustegelane/common/config/cookie">';
} else if ((!empty($_COOKIE["theme"])) && (!(($_COOKIE["theme"] == "dark") || ($_COOKIE["theme"] == "light") || ($_COOKIE["theme"] == "blue")))) {
    welcomeback();
} else if ($display_placeholder == false) {
    echo '<meta http-equiv="Refresh" content="0; URL=/markustegelane">';
}
?>
