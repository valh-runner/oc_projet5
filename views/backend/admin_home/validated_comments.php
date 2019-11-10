<?php $title = 'admin - commentaires validés'; ?>

<h2>admin - Commentaires validés</h2>
<hr>
<a href='<?php $this->url('admin_home', 'index'); ?>'>Retour</a>
<hr>

<?php foreach($comments as $comment): ?>
<div>
    <p>Auteur du commentaire: <?= $usersWhoCommented[$comment->idUser()]->username(); ?></p>
    <p><?= $comment->content(); //TODO: nblr() ??? ?></p>
    <p>Date du commentaire: ???</p>
    
    <form method="post" action="/admin_home/validated_comments/<?= $comment->idPost(); ?>">
        <input type="hidden" name="id_comment" value="<?= $comment->idComment(); ?>"/>
        <input type="submit" name="action_unvalidate" value="Dévalider"/>
    </form>
</div>
<?php endforeach; ?>


