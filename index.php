<?php
$units = include("getUnits.php");
echo '<pre>';
echo json_encode($units, JSON_PRETTY_PRINT);
