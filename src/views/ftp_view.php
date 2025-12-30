<h2>Liste des fichiers sur le serveur</h2>
<ul>
    <?php foreach ($files as $f): ?>
        <li>
            <?php echo $f; ?>
            <a href="index.php?action=ftp&sub=delete&file=<?php echo $f; ?>">Supprimer</a>
        </li>
    <?php endforeach; ?>
</ul>

<form action="index.php?action=ftp&sub=upload" method="post" enctype="multipart/form-data">
    <input type="file" name="file_upload">
    <button type="submit">Uploader</button>
</form>