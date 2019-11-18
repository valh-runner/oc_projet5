<?php $title = 'inscription'; ?>

<h2 class="text-center">Inscription</h2>
<hr>

<form method="post" action="/signup/index" id="form-signup" class="col-sm-offset-2 col-sm-8">
    <legend>Formulaire d'inscription</legend>
    <div class="form-group">
        <label for "email">Email <span class="red">*</span> : </label>
        <p><input type="text" class="form-control" name="email" id="email"/></p>
    </div>
    <div class="form-group">
        <label for "username">Pseudo <span class="red">*</span> : </label>
        <p><input type="text" class="form-control" name="username" id="username"/></p>
    </div>
    <div class="form-group">
        <label for "password">Mot de passe <span class="red">*</span> : </label>
        <p><input type="password" class="form-control" name="password" id="password"/></p>
    </div>
    <button class="btn pull-right">S'inscrire</button>
    <div class="clearfix"></div>
    <div class="red">* Champs obligatoires</div>
    <?= $feedback ?>
</form>
