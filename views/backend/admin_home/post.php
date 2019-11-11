<?php $title = 'admin - détail post'; ?>

<h2>admin - Détail du post</h2>
<hr>
<a href='<?php $this->url('admin_home', 'index'); ?>'>Retour</a> - 
<a href='<?php $this->url('admin_home', 'update_post', array($post->idPost())); ?>'>Modifier l'article</a> - 
<a href='<?php $this->url('admin_home', 'delete_post', array($post->idPost())); ?>'>Supprimer l'article</a>

<h3><?= $post->title(); ?></h3>
<p>Châpo: <?= $post->headnote(); ?></p>
<p>Contenu: <?= $post->content(); ?></p>
<p>Auteur: <?= $user->username(); ?></p>
<p>Date dernière mise à jour: <?= $post->revisionTime(); ?></p>
