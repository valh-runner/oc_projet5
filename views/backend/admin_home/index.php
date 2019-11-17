<?php $title = 'admin - accueil'; ?>

<h2>admin - Accueil</h2>
<hr>
<a href="<?= $this->url('admin_home', 'add_post'); ?>">Ajouter un article</a> - 
<a href="<?= $this->url('admin_home', 'accounts'); ?>">Gestion des utilisateurs</a>
<hr>

<?php foreach ($posts as $post): ?>
<div class="col-xs-12 post">
    <div class="col-xs-12 text-right">Mis à jour le <?= date('d/m/Y', strtotime($post->revisionTime())); ?></div>
    <div class="col-xs-12"><h3><?= $post->title(); ?></h3></div>
    <div class="col-xs-12 post-headnote"><p><?= $post->headnote(); ?></p></div>
    <div class="col-xs-12 text-center">
        <p>
            <a href='<?= $this->url('admin_home', 'post', array($post->idPost())); ?>'>L'article</a> - 
            <a href='<?= $this->url('admin_home', 'validated_comments', array($post->idPost())); ?>'>Commentaires validés</a> - 
            <a href='<?= $this->url('admin_home', 'waiting_comments', array($post->idPost())); ?>'>Commentaires en attente</a>
        </p>
    </div>
</div>
<?php endforeach; ?>
