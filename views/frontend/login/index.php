<?php $title = 'connexion'; ?>

<h2>Page de connexion</h2>
<hr>

<form method="post" action="/login/index">
    <p>email*: <input type="text" name="email"/></p>
    <p>mot de passe*: <input type="password" name="password"/></p>
    <p><input type="submit" value="Se connecter"/></p>
</form>

<?= $feedback ?>