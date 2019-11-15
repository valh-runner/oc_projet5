<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>my blog - <?= $title ?></title>
        <link href="public/css/style.css" rel="stylesheet" /> 
    </head>
        
    <body>
        <div>
            <a href="<?= $this->url('home', 'index') ?>">Accueil</a> - 
            <a href="<?= $this->url('blog', 'index') ?>">Blog</a> - 
            <?php if (isset($_SESSION['connected'])): ?>
            <span>connecté</span> - 
            <a href="<?= $this->url('login', 'logout') ?>">Se déconnecter</a>
            <?php else: ?>
            <a href="<?= $this->url('login', 'index') ?>">Connexion</a> - 
            <a href="<?= $this->url('signup', 'index') ?>">Inscription</a>
            <?php endif; ?>
        </div>
        <hr>
        <?= $content_for_layout ?>
        <hr>
        <footer><a href="<?= $this->url('admin_home', 'index') ?>">admin blog</a></footer>
    </body>
</html>