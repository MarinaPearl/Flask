<!DOCTYPE html>
<html>
<body>
<?php
$cust = [
    'cnum' => 2001,
    'cname' => 'Hoffman',
    'city' => 'London',
    'snum' => 1001,
    'rating' => 100
];

// выводим исходный массив
echo "<pre>"; print_r($cust); echo "</pre>";

// сортируем массив по значениям и выводим его
asort($cust);
echo "<pre>"; print_r($cust); echo "</pre>";

// сортируем массив по ключам и выводим его
ksort($cust);
echo "<pre>"; print_r($cust); echo "</pre>";

// функция sort меняет порядок индексов вместо сохранения исходных ключей, что может вызвать нежелательные результаты при сортировке ассоциативного массива. Вместо этого вы можете использовать asort или arsort.
sort($cust);
echo "<pre>"; print_r($cust); echo "</pre>";
?>
</body>
</html>