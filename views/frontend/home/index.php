<?php $title = 'accueil'; ?>

<p>Bienvenu sur mon site perso d'actualités IT</p>

<h3>Qui suis je?</h3>
<div class="col-xs-1 spacer">
    <img id="logo" src="/public/img/logo.png"></img>
</div>
<div class="col-xs-11 spacer">
    <img id="fullname" src="/public/img/fullname.png"></img>
    <p>Make your wishes functionnal</p>
</div>
<div class="col-xs-12 spacer">
    <p><a href="/public/docs/cv.pdf" target="_blank">Voir mon CV</a></p>
</div>
<h3>Réseaux sociaux</h3>
<div class="col-xs-12 spacer">
    <a class="btn btn-default" href="https://github.com/valh-runner/oc_projet5" target="_blank"><i class="fa fa-github fa-2x"></i></a>
    <a class="btn btn-default" href="https://linkedin.com/in/val-hlz" target="_blank"><i class="fa fa-linkedin fa-2x"></i></a>
</div>
<h3>Me contacter</h3>
<div class="col-xs-12 spacer">
    <form method="post" action="/home/index" id="form-contact">
        <legend>Formulaire de contact (fonctionnel)</legend>
        <div class="form-group">
            <label for "name">Nom <span class="red">*</span> : </label>
            <p><input type="text" name="name" id="name"/></p>
        </div>
        <div class="form-group">
            <label for "firstname">Prénom <span class="red">*</span> : </label>
            <p><input type="text" name="firstname" id="firstname"/></p>
        </div>
        <div class="form-group">
            <label for "email">E-mail <span class="red">*</span> : </label>
            <p><input type="text" name="email" id="email"/></p>
        </div>
        <div class="form-group">
            <label for "message">Message <span class="red">*</span> : </label>
            <p><textarea name="message" id="message"/></textarea>
        </div>
        <button class="btn pull-right">Envoyer</button>
        <div class="clearfix"></div>
        <div class="red">* Champs obligatoires</div>
    </form>
    <?= $feedback ?>
</div>
<!--<a href='<?php //$this->url('contact', 'index'); ?>'>Page de contact</a><br/>-->