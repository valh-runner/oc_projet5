<?php $title = 'admin - ajout post'; ?>

<h2>admin - Ajout d'un post</h2>
<hr>
<a href='<?= $this->url('admin_home', 'index'); ?>'>Retour</a>
<hr class="spacer">
<form method="post" action="/admin_home/add_post">
    <div class="form-group">
        <label for "title">Titre<span class="red">*</span> : </label>
        <p><input type="text" class="form-control" name="title"/></p>
    </div>
    <div class="form-group">
        <label for "headnote">Chapô<span class="red">*</span> : </label>
        <p><input type="text" class="form-control" name="headnote"/></p>
    </div>
    <div class="form-group">
        <label for "content">Contenu<span class="red">*</span> : </label>
        <p><textarea class="form-control" name="content"/></textarea>
    </div>
    <button class="btn pull-right">Envoyer</button>
    <div class="clearfix"></div>
    <div class="red">* Champs obligatoires</div>

</form>
<?= $feedback ?>
