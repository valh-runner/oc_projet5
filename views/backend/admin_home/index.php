<?php $title = 'admin - accueil'; ?>

<h2>admin - Page d'accueil</h2>
<hr>
<a href="<?php $this->url('admin_home', 'add_post'); ?>">Ajouter un article</a> - 
<a href="<?php $this->url('admin_home', 'accounts'); ?>">Gestion des utilisateurs</a>
<hr>

<?php foreach($posts as $post): ?>
<div>
    <h3><?= $post->title(); ?></h3>
    <p>Châpo: <?= $post->headnote(); ?></p>
    <p>Date dernière modification: <?= $post->revisionDate(); ?></p>
    <p>
        <a href='<?php $this->url('admin_home', 'post', array($post->idPost())); ?>'>Voir l'article</a> - 
        <a href='<?php $this->url('admin_home', 'validated_comments', array($post->idPost())); ?>'>Voir les commentaires validés</a> - 
        <a href='<?php $this->url('admin_home', 'waiting_comments', array($post->idPost())); ?>'>Voir les commentaires en attente</a>
    </p>
</div>
<?php endforeach; ?>


