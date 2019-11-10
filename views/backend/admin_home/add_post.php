<?php $title = 'admin - ajout post'; ?>

<h2>admin - Ajout d'un post</h2>
<hr>
<a href='<?php $this->url('admin_home', 'index'); ?>'>Retour</a>

<form method="post" action="/admin_home/add_post">
    <p>Titre*: <input type="text" name="title"/></p>
    <p>Chapô*: <input type="text" name="headnote"/></p>
    <p>Contenu*: <textarea name="content"/></textarea>
    <p><input type="submit"/></p>
</form>
<?= $feedback ?>
