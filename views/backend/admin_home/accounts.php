<?php $title = 'admin - gestion utilisateurs'; ?>

<h2 class="text-center">admin - Gestion des utilisateurs</h2>
<hr>
<a href='<?= $this->url('admin_home', 'index'); ?>'>Retour</a>
<hr>

<table class="table table-striped">
<tr>
    <th>id</th><th>username</th><th>e-mail</th><th>date d'inscription</th><th>admin</th><th>Gestion admin</th>
<?php foreach ($users as $user): ?>
<tr>
    <td><?= $user->idUser(); ?></td>
    <td><?= $user->username(); ?></td>
    <td><?= $user->email(); ?></td>
    <td><?= $user->registerDate(); ?></td>
    <td><?= $user->adminGranted()?'<strong>oui</strong>':'non'; ?></td>
    <td>
        <form method="post" action="/admin_home/accounts">
            <input type="hidden" name="id_user" value="<?= $user->idUser(); ?>"/>
            <?php if ($user->adminGranted()): ?>
            <button name="action_revoke" class="btn">revoquer</button>
            <?php else: ?>
            <button name="action_grant" class="btn">attribuer</button>
            <?php endif; ?>
        </form>
    </td>
</tr>
<?php endforeach; ?>
</table>

