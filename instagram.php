<?php
$url = "https://api.instagram.com/v1/users/self/media/recent/?access_token=2281535.8c32365.f291c7b90e774db581de9adc965ffdf8";
$json = file_get_contents($url);

echo $json;

?>
