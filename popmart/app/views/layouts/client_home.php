<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WEB</title>
    <link rel="stylesheet" href="<?= _WEB_ROOT_?>/app/assets/css/style.css">
    <link rel="stylesheet" href="<?= _WEB_ROOT_ ?>/app/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= _WEB_ROOT_ ?>/app/assets/css/bootstrap-icons.css">
    <link rel="stylesheet" href="<?= _WEB_ROOT_ ?>/app/assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= _WEB_ROOT_ ?>/app/assets/css/font-awesome/css/all.min.css">
</head>
<body>
<?php
$this->render('partials/header');
$this->render($content, $sub_content);
$this->render('partials/footer');
?>
</body>
<script src="<?= _WEB_ROOT_ ?>/app/assets/js/bootstrap.bundle.min.js"></script>
<script src="<?= _WEB_ROOT_?>/app/assets/js/script.js"></script>
</html>