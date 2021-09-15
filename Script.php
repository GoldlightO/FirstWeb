<?php
session_start();
$start = microtime(true);
date_default_timezone_set("Europe/Moscow");
$current_time = date("H:i:s");
$X = $_GET['X'];
$Y = $_GET['Y'];
$R = $_GET['R'];

$true = "Точка находится в зоне";
$false = "Точка находится вне зоны";

$message = "";

if ($X > $R || $X < -$R / 2 || $Y > $R / 2 || $Y < -$R)
    $message = $false;
else if ($X < 0 && $Y > 0)
    $message = $false;
else if ($X < 0 && $Y > 0 && $X > $R / sqrt(2) && $Y < -$R / sqrt(2))
    $message = $false;
else if ($X < 0 && $Y < 0 && $X * 2 < $Y)
    $message = $false;
else if (($X < 0 && $Y < 0) && ((-2 * $X >= 0 && -$Y >= 0 && 2 + 2 * $X + $Y >= 0) || (-2 * $X <= 0 && -$Y <= 0 && 2 + 2 * $X + $Y <= 0)))
    $message = $true;
else
    $message = $true;

$time = number_format(microtime(true) - $start, 10, ".", "") * 1000 . 'ms';

// Сохранение в сессию
$result = array($X, $Y, $R, $message, $time, $current_time);
if (!isset($_SESSION['results'])) {
    $_SESSION['results'] = array();
}
array_push($_SESSION['results'], $result);
?>

<?php
if (isset($_SESSION['results'])) {
    foreach ($_SESSION['results'] as $result) { ?>
        <table class="secondTable">
            <tr>
                <td><?php echo $result[0] ?></td>
                <td><?php echo $result[1] ?></td>
                <td><?php echo $result[2] ?></td>
                <td><?php echo $result[3] ?></td>
                <td><?php echo $result[4] ?></td>
                <td><?php echo $result[5] ?></td>
            </tr>
        </table>
    <?php }
} ?>
<?php
unset($_SESSION['results']); ?>