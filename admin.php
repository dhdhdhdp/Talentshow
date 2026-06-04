<?php
$dataFile = __DIR__ . "/data/reservations.json";
$reservations = [];

if (file_exists($dataFile)) {
    $reservations = json_decode(file_get_contents($dataFile), true);
}

if (!is_array($reservations)) {
    $reservations = [];
}

$tickets = array_filter($reservations, function ($reservation) {
    return ($reservation["type"] ?? "") === "ticket";
});

$participants = array_filter($reservations, function ($reservation) {
    return ($reservation["type"] ?? "") === "participant";
});

function clean($value) {
    return htmlspecialchars((string) $value, ENT_QUOTES, "UTF-8");
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Talent Show</title>
    <link rel="stylesheet" href="stylesheet.css">
</head>
<body>

<div class="topnav" id="myTopnav">
  <span class="brand">Ugur & Dmytro</span>
  <a href="index.html">Home</a>
  <a href="formulier.php#tickets">Tickets</a>
  <a href="formulier.php#meedoen">Mee Doen</a>
  <a href="admin.php">Admin</a>
</div>

<main class="form-page">
  <section class="form-hero">
    <h1>Admin Pagina</h1>
    <p>Hier zie je alle ticket reserveringen en aanmeldingen.</p>
  </section>

  <section class="admin-section">
    <h2>Ticket Reserveringen</h2>

    <?php if (count($tickets) === 0): ?>
      <p>Er zijn nog geen ticket reserveringen.</p>
    <?php else: ?>
      <div class="table-wrapper">
        <table class="admin-table">
          <thead>
            <tr>
              <th>Naam</th>
              <th>E-mail</th>
              <th>Telefoon</th>
              <th>Tickets</th>
              <th>Datum</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($tickets as $ticket): ?>
              <tr>
                <td><?= clean($ticket["naam"] ?? "") ?></td>
                <td><?= clean($ticket["email"] ?? "") ?></td>
                <td><?= clean($ticket["telefoon"] ?? "") ?></td>
                <td><?= clean($ticket["aantal_tickets"] ?? "") ?></td>
                <td><?= clean($ticket["gemaakt_op"] ?? "") ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    <?php endif; ?>
  </section>

  <section class="admin-section">
    <h2>Mee Doen Aanmeldingen</h2>

    <?php if (count($participants) === 0): ?>
      <p>Er zijn nog geen aanmeldingen.</p>
    <?php else: ?>
      <div class="table-wrapper">
        <table class="admin-table">
          <thead>
            <tr>
              <th>Naam</th>
              <th>Leeftijd</th>
              <th>E-mail</th>
              <th>Talent</th>
              <th>Act</th>
              <th>Datum</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($participants as $participant): ?>
              <tr>
                <td><?= clean($participant["naam"] ?? "") ?></td>
                <td><?= clean($participant["leeftijd"] ?? "") ?></td>
                <td><?= clean($participant["email"] ?? "") ?></td>
                <td><?= clean($participant["talent"] ?? "") ?></td>
                <td><?= clean($participant["uitleg"] ?? "") ?></td>
                <td><?= clean($participant["gemaakt_op"] ?? "") ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    <?php endif; ?>
  </section>
</main>

</body>
</html>
