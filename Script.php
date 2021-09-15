<?php
$start = microtime(true);
date_default_timezone_set("Europe/Moscow");
$current_time = date("H:i:s");
$x = floatval(htmlspecialchars($_GET["x"]));
$y = floatval(htmlspecialchars($_GET["y"]));
$r = floatval(htmlspecialchars($_GET["r"]));
$class = "No";
$true = "Точка находится в зоне";
$false = "Точка находится вне зоны";
$message = "";

if ($x > $r || $x < -$r / 2 || $y > $r / 2 || $y < -$r)
    $message = $false;
else if ($x < 0 && $y > 0)
    $message = $false;
else if ($x < 0 && $y > 0 && $x > $r / sqrt(2) && $y < -$r / sqrt(2))
    $message = $false;
else if ($x < 0 && $y < 0 && $x * 2 < $y)
    $message = $false;
else if (($x < 0 && $y < 0) && ((-2 * $x >= 0 && -$y >= 0 && 2 + 2 * $x + $y >= 0) || (-2 * $x <= 0 && -$y <= 0 && 2 + 2 * $x + $y <= 0)))
    $message = $true;
else{
    $class = "Yes";
    $message = $true;
}

print_r('<tr><td>'.$x.'</td><td>'.$y.'</td><td>'.$r.'</td><td class="'.$class.'">'.$message.'</td><td>'.$current_time.'</td></tr>');