<!DOCTYPE html>
<html>
<body>

<?php
// Если форма была отправлена, возьмите значения align и valign
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $align = $_POST['align'];
    $valign = $_POST['valign'];
    // Создайте таблицу и заполните её
    echo '<table width="100px" height="100px" border="1">';
    echo    "<tr>";
    echo        "<td align='$align' valign='$valign'>Текст</td>";
    echo    "</tr>";
    echo "</table>";
} else {
    // Если форма не была отправлена, установите align на 'left' и valign на 'top'
    $align = 'left';
    $valign = 'top';
}
?>

<form action="z4-2.php" method="post">
  <p>Горизонтальное расположение текста:</p>
  <input type="radio" id="left" name="align" value="left" <?php echo $align == 'left' ? 'checked' : ''; ?>>
  <label for="left">слева</label><br>
  <input type="radio" id="center" name="align" value="center" <?php echo $align == 'center' ? 'checked' : ''; ?>>
  <label for="center">центр</label><br>
  <input type="radio" id="right" name="align" value="right" <?php echo $align == 'right' ? 'checked' : ''; ?>>
  <label for="right">справа</label>

  <p>Вертикальное расположение текста:</p>
  <input type="checkbox" id="top" name="valign" value="top" <?php echo $valign == 'top' ? 'checked' : ''; ?>>
  <label for="top">сверху</label><br>
  <input type="checkbox" id="middle" name="valign" value="middle" <?php echo $valign == 'middle' ? 'checked' : ''; ?>>
  <label for="middle">середина</label><br>
  <input type="checkbox" id="bottom" name="valign" value="bottom" <?php echo $valign == 'bottom' ? 'checked' : ''; ?>>
  <label for="bottom">снизу</label><br>

  <input type="submit" value="Выполнить">
</form>

</body>
</html>