<?php $title = 'admin - modification post'; ?>

<h2>admin - Modification d'un post</h2>
<hr>
<a href='<?php $this->url('admin_home', 'index'); ?>'>Retour</a>

<form method="post" action="/admin_home/update_post/<?= $post->idPost(); ?>">
    <p>Titre*: <input type="text" name="title" value="<?= $post->title(); ?>"/></p>
    <p>Chapô*: <input type="text" name="headnote" value="<?= $post->headnote(); ?>"/></p>
    <p>Contenu*: <textarea name="content"/><?= $post->content(); ?></textarea>
    <p><input type="submit"/></p>
</form>
<?= $feedback ?>
