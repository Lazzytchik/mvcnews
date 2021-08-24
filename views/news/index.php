<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>News</title>
    <link href="/template/css/style.css" rel="stylesheet" type="text/css">
</head>

<body>

<?php

require ROOT . '/views/news/menu/mainMenu.php';

foreach ($newsList as $article){
    require ROOT.'/views/news/newsForm.php';
}

require 'pagination.php';

?>

</body>
</html>