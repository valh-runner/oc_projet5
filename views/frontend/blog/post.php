<?php $title = 'détail du post'; ?>

<a href='<?php $this->url('blog', 'index'); ?>'>Retour</a>

<p class="text-right">Créé le <?= $newDate = date('d/m/Y', strtotime($post->revisionTime())); ?></p>
<p class="text-right">Mis à jour le <?= $newDate = date('d/m/Y', strtotime($post->revisionTime())); ?></p>
<p class="text-right">Auteur : <?= $user->username(); ?></p>
<h2 class="col-xs-12 text-center" id="title"><?= $post->title(); ?></h2>
<h3><?= $post->headnote(); ?></h3>
<p><?= $post->content(); ?></p>
---

<?php if(isset($_SESSION['connected'])): ?>
    <p>Formulaire ajout commentaire (soumis pour validation)</p>
    <form method="post" action="/blog/post/<?= $post->idPost(); ?>">
        <p>Votre commentaire*: <textarea name="comment"/></textarea>
        <p><input type="submit"/></p>
    </form>
    <?= $feedback ?>
<?php else: ?>
    <p>Connectez-vous pour déposer un commentaire</p>
<?php endif; ?>
---
<p>Commentaires</p>
<?php foreach($comments as $comment): ?>
<div class="col-xs-12 comment">
    <p class="col-xs-12"><?= $comment->content(); //TODO: nblr() ??? ?></p>
    <p class="col-xs-12 text-right comment-source">
        par <span class="bold"><?= $usersWhoCommented[$comment->idUser()]->username(); ?></span> - le ??? (date commentaire)
    </p>
</div>
<?php endforeach; ?>
