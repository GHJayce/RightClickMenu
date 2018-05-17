<?php

require 'autoload.php';

use php\Business;

$extended = json_decode($_POST['extended'], true);
$options = json_decode($_POST['options'], true);

$business = new Business();
$result = $business->main($_POST['item_name'], $_POST['show_name'], $_POST['path'], $_POST['icon'], $extended, $options);

// dump($result);

echo json_encode($result);
