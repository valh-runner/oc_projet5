<?php $title = 'admin - commentaires en attente'; ?>

<h2>admin - Commentaires en attente</h2>
<hr>
<a href='<?php $this->url('admin_home', 'index'); ?>'>Retour</a>
<hr>

<?php foreach($comments as $comment): ?>
<div>
    <p>Auteur du commentaire: <?= $usersWhoCommented[$comment->idUser()]->username(); ?></p>
    <p><?= nl2br($comment->content()); ?></p>
    <p>Date du commentaire: ???</p>
    
    <form method="post" action="/admin_home/waiting_comments/<?= $comment->idPost(); ?>">
        <input type="hidden" name="id_comment" value="<?= $comment->idComment(); ?>"/>
        <input type="submit" name="action_delete" value="Supprimer"/>
        <input type="submit" name="action_validate" value="Valider"/>
    </form>
</div>
<?php endforeach; ?>
