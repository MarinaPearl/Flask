<!DOCTYPE html>
<html>
<head>
    <style>
        table { border-collapse: collapse; }
        td { border: 1px solid black; padding: 5px; }
        .diagonal { background-color: #0f0;; } /* Cюда вставьте желаемый цвет фона диагональных ячеек */
    </style>
</head>
<body>

 <table>
 <?php
 $i = 1;
 while ($i <= 10) {
     echo "\t<tr>\n";
     $j = 1;
     while ($j <= 10) {
         $class = ($i == $j) ? " class='diagonal'" : ''; // Определение класса для диагональных ячеек
         echo "\t\t<td$class>" . $i * $j . "</td>\n";
         $j++;
     }
     echo "\t</tr>\n";
     $i++;
 }
 ?>
 </table>

</body>
</html>