<?php
    ob_start();
    require_once 'router.php';
    $content = ob_get_contents();
    ob_end_clean();
?><!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <title></title>
  <meta name="description" content="">
</head>

<body>
    <?php
    echo $content;
    ?>
</body>

</html>