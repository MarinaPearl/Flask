<!DOCTYPE html>
<html>
<body>

<form action="z4-1b.php" method="post">
  <p>Горизонтальное расположение текста:</p>
  <input type="radio" id="left" name="align" value="left">
  <label for="left">cлева</label><br>
  <input type="radio" id="center" name="align" value="center">
  <label for="center">по центру</label><br>
  <input type="radio" id="right" name="align" value="right">
  <label for="right">справа</label>

  <p>Вертикальное расположение текста:</p>
  <input type="checkbox" id="top" name="valign" value="top">
  <label for="top">сверху</label><br>
  <input type="checkbox" id="middle" name="valign" value="middle">
  <label for="middle">посередине</label><br>
  <input type="checkbox" id="bottom" name="valign" value="bottom">
  <label for="bottom">внизу</label><br>

  <input type="submit" value="Выполнить">
</form>

</body>
</html>