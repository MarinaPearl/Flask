<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
</head>
<body>
<?php
// Создаем массив треугольных чисел
$treug = [];
for ($n = 1; $n <= 10; $n++) {
    $treug[] = $n * ($n + 1) / 2;
}
echo "<p>".implode('  ', $treug)."</p>";

// Создаем массив квадратов чисел
$kvd = [];
for ($n = 1; $n <= 10; $n++) {
    $kvd[] = $n * $n;
}
echo "<p>".implode('  ', $kvd)."</p>";

// Объединяем два массива
$rez = array_merge($treug, $kvd);
echo "<p>".implode('  ', $rez)."</p>";

// Сортируем массив
sort($rez);
echo "<p>".implode('  ', $rez)."</p>";

// Удаляем первый элемент массива
array_shift($rez);
echo "<p>".implode('  ', $rez)."</p>";

// Удаляем повторяющиеся элементы и выводим результат
$rez1 = array_unique($rez);
echo "<p>".implode('  ', $rez1)."</p>";
?>
</body>
</html>