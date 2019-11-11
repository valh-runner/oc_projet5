<?php $title = 'détail du post'; ?>

<a href='<?php $this->url('blog', 'index'); ?>'>Retour</a>

<p class="text-right">Créé le <?= date('d/m/Y', strtotime($post->revisionTime())); ?></p>
<p class="text-right">Mis à jour le <?= date('d/m/Y', strtotime($post->revisionTime())); ?></p>
<p class="text-right">Auteur : <?= $user->username(); ?></p>
<h2 class="col-xs-12 text-center" id="title"><?= $post->title(); ?></h2>
<h3><?= $post->headnote(); ?></h3>
<p><?= $post->content(); ?></p>

<hr class="spacer">

<h3>Formulaire ajout commentaire</h3>
<?php if(isset($_SESSION['connected'])): ?>
    <form method="post" action="/blog/post/<?= $post->idPost(); ?>">
        <div class="form-group">
            <label for "comment">Votre commentaire<span class="red">*</span> : </label>
            <p><textarea name="comment"/></textarea></p>
        </div>
        <button class="btn pull-right">Envoyer</button>
        <div class="clearfix"></div>
        <div class="red">* Champs obligatoires</div>
    </form>
    <?= $feedback ?>
<?php else: ?>
    <p>Connectez-vous pour déposer un commentaire</p>
<?php endif; ?>

<hr class="spacer">

<h3>Commentaires</h3>
<?php foreach($comments as $comment): ?>
<div class="col-xs-12 comment">
    <p class="col-xs-12"><?= nl2br($comment->content()); ?></p>
    <p class="col-xs-12 text-right comment-source">
        par <span class="bold"><?= $usersWhoCommented[$comment->idUser()]->username(); ?></span> - le ??? (date commentaire)
    </p>
</div>
<?php endforeach; ?>
