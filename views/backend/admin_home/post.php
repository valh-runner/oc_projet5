<?php $title = 'admin - détail post'; ?>

<h2>admin - Détail du post</h2>
<hr>
<a href='<?= $this->url('admin_home', 'index'); ?>'>Retour</a> - 
<a href='<?= $this->url('admin_home', 'update_post', array($post->idPost())); ?>'>Modifier l'article</a> - 
<a href='<?= $this->url('admin_home', 'delete_post', array($post->idPost())); ?>'>Supprimer l'article</a>

<p class="text-right">Créé le <?= date('d/m/y à H:i', strtotime($post->creationTime())); ?></p>
<p class="text-right">Mis à jour le <?= date('d/m/Y à H:i', strtotime($post->revisionTime())); ?></p>
<p class="text-right">Auteur : <?= $user->username(); ?></p>

<div class="spacer"></div>

<h3><?= $post->title(); ?></h3>
<p><?= $post->headnote(); ?></p>
<div class="spacer"></div>
<p><?= $post->content(); ?></p>