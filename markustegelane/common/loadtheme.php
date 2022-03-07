 
<?php
if ($isMob == null) {
    include($_SERVER["DOCUMENT_ROOT"] . "/mobcheck.php");
}
if (empty($_COOKIE["theme"])) {
    $theme = 'light';
} else {
    $theme = $_COOKIE["theme"];
}
?>
<link rel="stylesheet" href="/markustegelane/common/themes/<?php echo $theme;	if ($isMob) {  echo "_m"; 	} ?>.css">
