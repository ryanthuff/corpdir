<?php
require_once 'functions.class.php';
$functions = new functions();
$functions->router();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="styles.css">
        <title>Corporate Directory</title>
    </head>
    <body>
        <?php if (!$functions->bypass) { ?>
        <div class="container">
            <span class="titletext"><?=$functions->appName;?></span>
            <div class="parent">
                <div class="leftbox">
                    <a class="btnLinks" href="?guid=238523946387438737834">View phone book</a>
                </div>
                <div class="rightbox">
                    <a class="btnLinks" href="?guid=892382932266243634636">Search for someone</a>
                </div>
            </div>
        </div>
        <?php } ?>
        <div class="footer">&copy;<?= date('Y') . ' ' . $functions->companyName;?>, All rights reserved</div>
    </body>
</html>
