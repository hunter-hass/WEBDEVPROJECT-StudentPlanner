<?php
if (!isset($_SESSION["userName"])) {
    $userName = "none";
}
else {
    $userName = $_SESSION["userName"];
}
?>
<footer>
    <p>&copy; Disclaimer:This site is under development by UW-Oshkosh students as a prototype for(<?= $userName  ?>).
        Nothing on the site should be construed in
        any way as being officially connected with or representative of (Hunter Hass).
    </p>
</footer>