<?php $title = 'accueil'; ?>

<p class="text-center">Bienvenu sur mon site perso d'actualités IT</p>


<div class="col-xs-12 col-sm-6 nopad-left">
    <div class="col-xs-12 spacer panel">
        <h3 class="col-xs-12 text-center spacer">Qui suis je?</h3>
        <div class="col-xs-3 col-sm-3 text-right spacer">
            <img id="logo" src="/public/img/logo.png"></img>
        </div>
        <div class="col-xs-9 col-sm-9 spacer">
            <img id="fullname" src="/public/img/fullname.png"></img>
            <p>Make your wishes functionnal</p>
        </div>
        <div class="col-xs-12 col-sm-12 spacer">
            <p><a href="/public/docs/cv.pdf" target="_blank">Voir mon CV</a></p>
        </div>
    </div>
    
    <div class="col-xs-12 panel">
        <h3 class="text-center spacer">Réseaux sociaux</h3>
            <div class="text-center">
            <a class="btn btn-default spacer" href="https://github.com/valh-runner/oc_projet5" target="_blank">
                <i class="fab fa-github-square fa-2x"></i>
            </a>
            <a class="btn btn-default spacer" href="https://linkedin.com/in/val-hlz" target="_blank">
                <i class="fab fa-linkedin fa-2x"></i>
            </a>
        </div>
    </div>
</div>
<div class="col-xs-12 col-sm-6 spacer nopad-right">
    <div class="col-xs-12 panel">
        <h3 class="col-xs-12 spacer">Me contacter</h3>
        <form method="post" action="/home/index" id="form-contact">
            <div class="form-group">
                <label for "name">Nom <span class="red">*</span> : </label>
                <p><input type="text" class="form-control" name="name" id="name"/></p>
            </div>
            <div class="form-group">
                <label for "firstname">Prénom <span class="red">*</span> : </label>
                <p><input type="text" class="form-control" name="firstname" id="firstname"/></p>
            </div>
            <div class="form-group">
                <label for "email">E-mail <span class="red">*</span> : </label>
                <p><input type="text" class="form-control" name="email" id="email"/></p>
            </div>
            <div class="form-group">
                <label for "message">Message <span class="red">*</span> : </label>
                <p><textarea class="form-control" name="message" id="message"/></textarea>
            </div>
            <button class="btn pull-right">Envoyer</button>
            <div class="clearfix"></div>
            <div class="red">* Champs obligatoires</div>
        </form>
        <?= $feedback ?>
    </div>
</div>
