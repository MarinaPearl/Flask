<!DOCTYPE html>
<html>
<?php

function Ru($color) {
    echo "<p style='color: $color;'>Здравствуйте!</p>";
}

function En($color) {
    echo "<p style='color: $color;'>Hello!</p>";
}

function Fr($color) {
    echo "<p style='color: $color;'>Bonjour!</p>";
}

function De($color) {
    echo "<p style='color: $color;'>Guten Tag!</p>";
}
$lang = isset($_GET['lang']) ? $_GET['lang'] : 'Ru';
$color = isset($_GET['color']) ? $_GET['color'] : 'Black';
$lang($color);
?>


</body>
</html>