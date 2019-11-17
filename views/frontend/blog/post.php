<?php $title = 'blog > détail du post'; ?>

<a href='<?= $this->url('blog', 'index'); ?>'>Retour</a>

<p class="text-right">Créé le <?= date('d/m/y', strtotime($post->revisionTime())); ?></p>
<p class="text-right">Mis à jour le <?= date('d/m/y', strtotime($post->revisionTime())); ?></p>
<p class="text-right">Auteur : <?= $user->username(); ?></p>
<h2 class="col-xs-12 text-center" id="title"><?= $post->title(); ?></h2>
<h3><?= $post->headnote(); ?></h3>
<p><?= $post->content(); ?></p>

<hr class="spacer">

<div class="col-xs-12 panel">
    <h3>Poster un commentaire</h3>
    <?php if ($this->session->isSession('connected')): ?>
        <form method="post" action="/blog/post/<?= $post->idPost(); ?>">
            <div class="form-group">
                <p><textarea class="form-control" name="comment" placeholder="Votre commentaire"/></textarea></p>
            </div>
            <button class="btn pull-right">Envoyer</button>
            <div class="clearfix"></div>
        </form>
        <?= $feedback ?>
    <?php else: ?>
        <p>Connectez-vous pour déposer un commentaire</p>
    <?php endif; ?>
</div>

<hr class="spacer">

<h3>Commentaires</h3>
<?php if(empty($comments)): ?>
Pas de commentaires
<?php endif; ?>
<?php foreach ($comments as $comment): ?>
<div class="col-xs-12 comment">
    <p class="col-xs-12"><?= nl2br($comment->content()); ?></p>
    <p class="col-xs-12 text-right comment-source">
        par <span class="bold"><?= $usersWhoCommented[$comment->idUser()]->username(); ?></span> - le <?= date('d/m/y à H:i', strtotime($post->revisionTime())); ?>
    </p>
</div>
<?php endforeach; ?>
