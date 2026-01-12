<h2>Test d'Envoi de Mail</h2>
<?php if(isset($msg)) echo "<p><b>$msg</b></p>"; ?>

<form action="index.php?action=mail" method="post">
    <label>Destinataire :</label><br>
    <input type="email" name="to" required><br>

    <label>Sujet :</label><br>
    <input type="text" name="subject" required><br>

    <label>Message :</label><br>
    <textarea name="message" rows="5" required></textarea><br>

    <button type="submit">Envoyer</button>
</form>
<p><a href="index.php">Retour Accueil</a></p>