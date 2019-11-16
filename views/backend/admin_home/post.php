<?php $title = 'admin - détail post'; ?>

<h2>admin - Détail du post</h2>
<hr>
<a href='<?= $this->url('admin_home', 'index'); ?>'>Retour</a> - 
<a href='<?= $this->url('admin_home', 'update_post', array($post->idPost())); ?>'>Modifier l'article</a> - 
<a href='<?= $this->url('admin_home', 'delete_post', array($post->idPost())); ?>'>Supprimer l'article</a>

<h3><?= $post->title(); ?></h3>
<p>Châpo: <?= $post->headnote(); ?></p>
<p>Contenu: <?= $post->content(); ?></p>
<hr class="spacer">
<p>Auteur: <?= $user->username(); ?></p>
<hr class="spacer">
<p>Date dernière mise à jour: <?= date('d/m/Y', strtotime($post->revisionTime())); ?></p>
