<h2>Console Système</h2>

<form action="index.php?action=shell" method="post">
    <label>Entrez une commande :</label>
    <input type="text" name="command" placeholder="ex: ls -la" style="width: 300px;">
    <button type="submit">Exécuter</button>
</form>

<?php if (isset($result)): ?>
    <h3>Résultat (Code retour : <?php echo $result['status']; ?>)</h3>
    <pre style="background: #000; color: #fff; padding: 15px; border-radius: 5px;">
<?php
if (!empty($result['output'])) {
    echo htmlspecialchars(implode("\n", $result['output']));
} else {
    echo "Aucune sortie.";
}
?>
    </pre>
<?php endif; ?>