<html>
<head>
    <title> lab </title>
</head>

<body>

<?php
foreach ($_POST as $key=>$value) {
    if (gettype($value) == "array") {
        print "$key = <br>\n";
        foreach ($value as $v ) { print "$v<br>"; }
    }
    else {
        print "$key = $value<br>\n";
    }
}
?>

</body>
</html>