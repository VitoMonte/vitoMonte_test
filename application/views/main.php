<?php /** Основной шаблон =============== $title - заголовок $content - HTML страницы */ ?> 
<!DOCTYPE html> 
<html lang="ru"> 
    <head> <meta charset="UTF-8"> 
        <title><?=$title?></title> 
        <link rel="stylesheet" type="text/css" media="screen" href="css/style.css" /> 
    </head>
    <body>
        <div class="wrapper">
            <header>
             <h1><?=$title?></h1>
            </header>

            <div class="content_wrap">
                <div class="content"><?=$content?></div>
            </div>

            <footer>

            </footer>
        </div>
    </body>
</html>