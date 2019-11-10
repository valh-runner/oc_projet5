<?php $title = 'inscription'; ?>

<h2>Page d'inscription</h2>
<hr>

<form method="post" action="/signup/index">
    <p>email*: <input type="text" name="email"/></p>
    <p>pseudo*: <input type="text" name="username"/></p>
    <p>mot de passe*: <input type="password" name="password"/></p>
    <p><input type="submit"/></p>
</form>

<?= $feedback ?>
