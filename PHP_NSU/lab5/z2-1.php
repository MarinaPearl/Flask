<html>
<body>
<?php
    $size = isset($_GET['size']) ? $_GET['size'] : '20px';
    $color = isset($_GET['color']) ? $_GET['color'] : 'Black';
    echo "<p style='color: $color; font-size: $size;'>Привет, мир!</p>";
?>
</body> 
</html>