<!DOCTYPE html>
<html>
<head>
    <style>
        table { border-collapse: collapse; }
        td { border: 1px solid black; padding: 5px; }
    </style>
</head>
<body>

<table>
<?php
$color = 'blue';

for ($i = 0; $i <= 10; $i++) {
    echo '<tr>';
    for ($j = 0; $j <= 10; $j++) {
        if ($i == 0 && $j == 0) {
            echo "<td style='color:red;'>+</td>";
        } elseif ($i == 0) {
            echo "<td style='color:$color;'>" . $j . '</td>';
        } elseif ($j == 0) {
            echo "<td style='color:$color;'>" . $i . '</td>';
        } else {
            echo '<td>' . ($i + $j) . '</td>';
        }
    }
    echo '</tr>';
} 
?>
</table>

</body>
</html>