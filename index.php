<?php
header(header: 'Access-Control-Allow-Origin: http://localhost:3000');
header(header: 'Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, PATCH, DELETE');
header(header: 'Access-Control-Allow-Headers: Content-Type');
$headers = getallheaders();

?>
