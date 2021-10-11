<?php
ini_set ('display_errors',1);
error_reporting (E_ALL ^E_NOTICE);

session_start();
$start = microtime(true);
$validX = array(-5, -4, -3, -2, -1, 0, 1, 2, 3);
$x = floatval(htmlspecialchars($_GET["x"]));
$y = floatval(htmlspecialchars($_GET["y"]));
$r = floatval(htmlspecialchars($_GET["r"]));
date_default_timezone_set("Europe/Moscow");
$current_time = date("H:i:s");
$message = "";
$false = "Не принадлежит";
$true = "Принадлежит";
$class = "No";


if (!is_null($x)) {
    if (!in_array($x, $validX)) {
        $message = "X выходит за пределы!";
    }
} else {
    $message = "X не введён или введён неверно!";
}

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
else {
    $class = "Yes";
    $message = $true;
}

$result = array($x, $y, $r, $message, $current_time);
if (!isset($_SESSION['results'])) {
    $_SESSION['results'] = array();
}
array_push($_SESSION['results'], $result);

print_r('<tr><td>' . $x . '</td><td>' . $y . '</td><td>' . $r . '</td><td class="' . $class . '">' . $message . '</td><td>' . $current_time . '</td></tr>');
?>