<?php $title = 'admin - modification post'; ?>

<h2>admin - Modification d'un post</h2>
<hr>
<a href='<?= $this->url('admin_home', 'index'); ?>'>Retour</a>
<hr class="spacer">
<form method="post" action="/admin_home/update_post/<?= $post->idPost(); ?>">
    <div class="form-group">
        <label for "title">Titre<span class="red">*</span> : </label>
        <p><input type="text" name="title" value="<?= $post->title(); ?>"/></p>
    </div>
    <div class="form-group">
        <label for "headnote">Chapô<span class="red">*</span> : </label>
        <p><input type="text" name="headnote" value="<?= $post->headnote(); ?>"/></p>
    </div>
    <div class="form-group">
        <label for "content">Contenu<span class="red">*</span> : </label>
        <p><textarea name="content"/><?= $post->content(); ?></textarea>
    </div>
    <button class="btn pull-right">Envoyer</button>
    <div class="clearfix"></div>
    <div class="red">* Champs obligatoires</div>
</form>
<?= $feedback ?>
