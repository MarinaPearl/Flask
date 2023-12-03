<html>
<body>
<?php
     $lang = isset($_GET['lang']) ? $_GET['lang'] : 'Ru';// Задаём значение по умолчанию
        if($lang == "ru") {
            echo "Русский";
        } elseif($lang == "en") {
            echo "Aнглийский";
        } elseif($lang == "fr") {
            echo "Французский";
        } elseif($lang == "de") {
            echo "Немецкий";
        } else {
            echo "Язык неизвестен";
        }
?>
</body> 
</html>