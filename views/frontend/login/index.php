<?php $title = 'connexion'; ?>

<h2 class="text-center">Connexion</h2>
<hr>

<form method="post" action="/login/index" id="form-login" class="col-sm-offset-2 col-sm-8 panel">
    <div class="form-group">
        <label for "email">Email : </label>
        <p><input type="text" class="form-control" name="email" id="email"/></p>
    </div>
    <div class="form-group">
        <label for "password">Mot de passe : </label>
        <p><input type="password" class="form-control" name="password" id="password"/></p>
    </div>
    <button class="btn pull-right">Se connecter</button>
    <div class="clearfix"></div>
</form>
<?= $feedback ?>