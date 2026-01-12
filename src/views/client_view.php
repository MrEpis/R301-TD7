<h2>Gestion des Clients</h2>

<h3><?php echo $clientToEdit ? 'Modifier' : 'Ajouter'; ?> un client</h3>
<form action="index.php?action=client&sub=<?php echo $clientToEdit ? 'edit' : 'add'; ?>" method="post">
    <?php if ($clientToEdit): ?>
        <input type="hidden" name="id" value="<?php echo $clientToEdit['id']; ?>">
    <?php endif; ?>
    <input type="text" name="nom" placeholder="Nom" value="<?php echo $clientToEdit['nom'] ?? ''; ?>" required>
    <input type="email" name="email" placeholder="Email" value="<?php echo $clientToEdit['email'] ?? ''; ?>" required>
    <button type="submit">Enregistrer</button>
</form>

<h3>Liste des clients</h3>
<table border="1" cellpadding="5">
    <tr><th>ID</th><th>Nom</th><th>Email</th><th>Actions</th></tr>
    <?php foreach ($clients as $c): ?>
        <tr>
            <td><?php echo $c['id']; ?></td>
            <td><?php echo htmlspecialchars($c['nom']); ?></td>
            <td><?php echo htmlspecialchars($c['email']); ?></td>
            <td>
                <a href="index.php?action=client&sub=editForm&id=<?php echo $c['id']; ?>">Modifier</a> |
                <a href="index.php?action=client&sub=delete&id=<?php echo $c['id']; ?>" onclick="return confirm('Confirmer ?');">Supprimer</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<p><a href="index.php">Retour Accueil</a></p>