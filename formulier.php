<?php
$success = $_GET["success"] ?? "";
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulier - Talent Show</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="stylesheet.css">
</head>
<body>

<div class="topnav" id="myTopnav">
  <span class="brand">Ugur & Dmytro</span>
  <a href="index.html">Home</a>
  <a href="contact.html">Contact</a>
  <a href="about.html">About</a>
  <a href="formulier.php#tickets">Tickets</a>
  <a href="admin.php">Admin</a>
  <a href="javascript:void(0);" class="icon" onclick="myFunction()">
    <i class="fa fa-bars"></i>
  </a>
</div>

<main class="form-page">
  <section class="form-hero">
    <h1>Inschrijven Talent Show</h1>
    <p>Kies hieronder of je tickets wilt reserveren of mee wilt doen als deelnemer.</p>
    <div class="form-choice">
      <a href="#tickets" class="button form-tab" data-form-tab="tickets">Ticket Reserveren</a>
      <a href="#meedoen" class="button form-tab" data-form-tab="meedoen">Mee Doen</a>
    </div>
  </section>

  <section class="form-section" id="tickets">
    <h2>Ticket Reserveren</h2>
    <p>Vul je gegevens in om tickets te reserveren.</p>

    <?php if ($success === "ticket"): ?>
      <p class="form-message is-visible">Bedankt! Je ticket reservering is opgeslagen.</p>
    <?php endif; ?>

    <form class="talent-form" id="ticket-form" method="post" action="save_reservation.php">
      <input type="hidden" name="type" value="ticket">

      <label for="ticket-name">Volledige naam</label>
      <input type="text" id="ticket-name" name="naam" placeholder="Jouw naam" required>

      <label for="ticket-email">E-mail</label>
      <input type="email" id="ticket-email" name="email" placeholder="naam@example.com" required>

      <label for="ticket-phone">Telefoonnummer</label>
      <input type="tel" id="ticket-phone" name="telefoon" placeholder="06 12345678" required>

      <label for="ticket-count">Aantal tickets</label>
      <input type="number" id="ticket-count" name="aantal_tickets" min="1" max="10" value="1" required>

      <button type="submit" class="form-submit">Reserveren</button>
    </form>
  </section>

  <section class="form-section" id="meedoen">
    <h2>Mee Doen</h2>
    <p>Vul je gegevens in om je aan te melden voor de talentenavond.</p>

    <?php if ($success === "participant"): ?>
      <p class="form-message is-visible">Bedankt! Je aanmelding is opgeslagen.</p>
    <?php endif; ?>

    <form class="talent-form" id="participant-form" method="post" action="save_reservation.php">
      <input type="hidden" name="type" value="participant">

      <label for="participant-name">Volledige naam</label>
      <input type="text" id="participant-name" name="naam" placeholder="Jouw naam" required>

      <label for="participant-age">Leeftijd</label>
      <input type="number" id="participant-age" name="leeftijd" min="6" max="99" placeholder="16" required>

      <label for="participant-email">E-mail</label>
      <input type="email" id="participant-email" name="email" placeholder="naam@example.com" required>

      <label for="participant-talent">Talent</label>
      <select id="participant-talent" name="talent" required>
        <option value="">Kies jouw talent</option>
        <option value="Zingen">Zingen</option>
        <option value="Dansen">Dansen</option>
        <option value="Comedie">Comedie</option>
        <option value="Muziek">Muziek</option>
        <option value="Anders">Anders</option>
      </select>

      <label for="participant-info">Korte uitleg over je act</label>
      <textarea id="participant-info" name="uitleg" rows="4" placeholder="Vertel kort wat je gaat doen" required></textarea>

      <button type="submit" class="form-submit">Aanmelden</button>
    </form>
  </section>
</main>

<script>
function showSelectedForm() {
  const selectedForm = window.location.hash === "#meedoen" ? "meedoen" : "tickets";

  document.querySelectorAll(".form-section").forEach(function(section) {
    section.classList.toggle("is-active", section.id === selectedForm);
  });

  document.querySelectorAll(".form-tab").forEach(function(tab) {
    tab.classList.toggle("is-active", tab.dataset.formTab === selectedForm);
  });
}

window.addEventListener("hashchange", showSelectedForm);
showSelectedForm();
</script>

</body>
</html>
