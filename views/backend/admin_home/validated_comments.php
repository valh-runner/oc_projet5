<?php $title = 'admin - commentaires validés'; ?>

<h2>admin - Commentaires validés</h2>
<hr>
<a href='<?php $this->url('admin_home', 'index'); ?>'>Retour</a>
<hr>

<?php foreach($comments as $comment): ?>
<div class="col-xs-12 comment">
    <p class="col-xs-12"><?= nl2br($comment->content()); ?></p>
    <p class="col-xs-12 text-right comment-source">
        par <span class="bold"><?= $usersWhoCommented[$comment->idUser()]->username(); ?></span> - le 
        <?= date('d/m/Y à H:i', strtotime($comment->creationTime())); ?>
    </p>
    <form method="post" action="/admin_home/validated_comments/<?= $comment->idPost(); ?>">
        <input type="hidden" name="id_comment" value="<?= $comment->idComment(); ?>"/>
        <input type="submit" name="action_unvalidate" value="Dévalider"/>
    </form>
</div>
<?php endforeach; ?>


