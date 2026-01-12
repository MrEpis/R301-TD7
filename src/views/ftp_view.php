<h2>Explorateur FTP</h2>
<p>Dossier actuel : <strong><?php echo htmlspecialchars($currentDir); ?></strong></p>

<?php if ($currentDir != '.' && $currentDir != '/'): ?>
    <a href="index.php?action=ftp&dir=<?php echo dirname($currentDir); ?>">.. (Remonter)</a><br><br>
<?php endif; ?>

<form action="index.php?action=ftp&dir=<?php echo $currentDir; ?>&sub=mkdir" method="post">
    <input type="text" name="dirname" placeholder="Nouveau dossier">
    <button type="submit">Créer</button>
</form>

<form action="index.php?action=ftp&dir=<?php echo $currentDir; ?>&sub=upload" method="post" enctype="multipart/form-data">
    <input type="file" name="file_upload">
    <button type="submit">Uploader ici</button>
</form>

<ul>
    <?php foreach ($files as $f):
        // On ignore . et ..
        if ($f == '.' || $f == '..') continue;
        // Distinction fichier/dossier simple (si extension = fichier)
        $isDir = (pathinfo($f, PATHINFO_EXTENSION) == '');
        ?>
        <li>
            <?php if ($isDir): ?>
                [D] <a href="index.php?action=ftp&dir=<?php echo $f; ?>"><?php echo basename($f); ?></a>
                <a href="index.php?action=ftp&sub=rmdir&file=<?php echo $f; ?>&dir=<?php echo $currentDir; ?>">[Suppr Dossier]</a>
            <?php else: ?>
                [F] <?php echo basename($f); ?>
                <a href="index.php?action=ftp&sub=download&file=<?php echo $f; ?>&dir=<?php echo $currentDir; ?>">[DL]</a>
                <a href="index.php?action=ftp&sub=delete&file=<?php echo $f; ?>&dir=<?php echo $currentDir; ?>">[Suppr]</a>
                <form style="display:inline" action="index.php?action=ftp&sub=chmod&file=<?php echo $f; ?>&dir=<?php echo $currentDir; ?>" method="post">
                    <input type="text" name="mode" size="3" placeholder="755">
                    <button type="submit">Chmod</button>
                </form>
            <?php endif; ?>
        </li>
    <?php endforeach; ?>
</ul>
<p><a href="index.php">Retour Accueil</a></p>