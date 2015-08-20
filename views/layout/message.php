<?php

# ---------------------------------
# File : message.php
# Creator : Jeremy Lardet
# Date : 20/08/2015
# ---------------------------------

$flash = FlashHelpers::getFlashHelpers();

$messages = $flash->getSuccess();
$flash->flushSuccess();
foreach($messages as $message){
    echo "<div class='alert alert-success' role='alert'>";
    echo $message;
    echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "</div>";
}

$messages = $flash->getInfo();
$flash->flushInfo();
foreach($messages as $message){
    echo "<div class='alert alert-info' role='alert'>";
    echo $message;
    echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "</div>";
}

$messages = $flash->getDanger();
$flash->flushDanger();
foreach($messages as $message){
    echo "<div class='alert alert-danger' role='alert'>";
    echo $message;
    echo "<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>";
    echo "</div>";
}

?>