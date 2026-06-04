<?php
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: formulier.php#tickets");
    exit;
}

$type = $_POST["type"] ?? "";

if ($type !== "ticket" && $type !== "participant") {
    header("Location: formulier.php#tickets");
    exit;
}

$dataDirectory = __DIR__ . "/data";
$dataFile = $dataDirectory . "/reservations.json";

if (!is_dir($dataDirectory)) {
    mkdir($dataDirectory, 0777, true);
}

if (!file_exists($dataFile)) {
    file_put_contents($dataFile, "[]");
}

$reservations = json_decode(file_get_contents($dataFile), true);

if (!is_array($reservations)) {
    $reservations = [];
}

$reservation = [
    "id" => uniqid(),
    "type" => $type,
    "naam" => trim($_POST["naam"] ?? ""),
    "email" => trim($_POST["email"] ?? ""),
    "gemaakt_op" => date("Y-m-d H:i:s"),
];

if ($type === "ticket") {
    $reservation["telefoon"] = trim($_POST["telefoon"] ?? "");
    $reservation["aantal_tickets"] = (int) ($_POST["aantal_tickets"] ?? 1);
    $redirect = "formulier.php?success=ticket#tickets";
} else {
    $reservation["leeftijd"] = (int) ($_POST["leeftijd"] ?? 0);
    $reservation["talent"] = trim($_POST["talent"] ?? "");
    $reservation["uitleg"] = trim($_POST["uitleg"] ?? "");
    $redirect = "formulier.php?success=participant#meedoen";
}

$reservations[] = $reservation;

file_put_contents(
    $dataFile,
    json_encode($reservations, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE),
    LOCK_EX
);

header("Location: " . $redirect);
exit;
?>
