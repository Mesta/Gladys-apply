<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Include Bootstrap & jQuery from a CDN-->
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/js/bootstrap.min.js"></script>

    <!-- Local css-->
    <link rel="stylesheet" href="/assets/css/default.css">
</head>
<body>
<?php include_once "header.php" ?>

<div class="container">
    <div class="notice">
        <?php include_once "message.php" ?>
    </div>

    <?php include($this->view); ?>
</div>

</body>
</html>