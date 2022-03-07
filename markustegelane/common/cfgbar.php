
<?php
if ($lang == "et-EE") {
	$lo = "Vasakud_alumised_nupud";
} else {
	$lo = "Bottom_left_buttons";
}
echo '<section id="' . $lo . '">';
echo '<a tabindex="30" href="common/config"><div class="floatie">&#9881;&#65039;</div></a>';
if ($isMob) {
    echo '<a tabindex="31" href="common/lucky"><div class="floatie2">?</div></a>';
} else {
    echo '<a tabindex="31" href="common/lucky"><div class="floatie" style="margin-left: 45px; padding-bottom: 11px; padding-left: 12px; padding-right: 12px;">?</div></a>';
}
echo '</section>';
?>
