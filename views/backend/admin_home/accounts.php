<?php $title = 'admin - gestion utilisateurs'; ?>

<h2>admin - Gestion des utilisateurs</h2>
<hr>
<a href='<?php $this->url('admin_home', 'index'); ?>'>Retour</a>
<hr>

<table>
<tr>
    <td>id</td><td>username</td><td>e-mail</td><td>date d'inscription</td><td>admin</td><td>Gestion admin</td>
<?php foreach($users as $user): ?>
<tr>
    <td><?= $user->idUser(); ?></td>
    <td><?= $user->username(); ?></td>
    <td><?= $user->email(); ?></td>
    <td><?= $user->registerDate(); ?></td>
    <td><?= $user->adminGranted()?'oui':'non'; ?></td>
    <td>
        <form method="post" action="/admin_home/accounts">
            <input type="hidden" name="id_user" value="<?= $user->idUser(); ?>"/>
            <input type="submit" name="action_grant" value="attribuer"/>
            <input type="submit" name="action_revoke" value="revoquer"/>
        </form>
    </td>
</tr>
<?php endforeach; ?>
</table>

