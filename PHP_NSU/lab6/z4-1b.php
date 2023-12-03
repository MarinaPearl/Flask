<!DOCTYPE html>
<html>
<body>

<?php
// Получим значения align и valign из POST запроса
$align = $_POST['align'];
$valign = $_POST['valign'];

echo '<table width="100px" height="100px" border="1">';
echo    "<tr>";
echo        "<td align='$align' valign='$valign'>Текст</td>";
echo    "</tr>";
echo "</table>";
?>

<a href="z4-1a.php">Назад</a>

</body>
</html>