<?php $title = 'blog'; ?>

<h2 class="col-xs-12 text-center" id="title">Liste des articles</h2>

<?php foreach($posts as $post): ?>
<div class="col-xs-12 post">
    <div class="col-xs-12 text-right">Mis à jour le <?= date('d/m/Y', strtotime($post->revisionTime())); ?></div>
    <div class="col-xs-12"><h3><?= $post->title(); ?></h3></div>
    <div class="col-xs-12 post-headnote"><p><?= $post->headnote(); ?></p></div>
    <div class="col-xs-12 text-center"><p>
        <a href='<?php $this->url('blog', 'post', array($post->idPost())); ?>'>Voir l'article</a>
    </p></div>
</div>
<?php endforeach; ?>
