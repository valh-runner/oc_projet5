<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>ActuBlog - <?= $title ?></title>
    <link href="/public/css/bootstrap.css" rel="stylesheet">
    <link href="/public/css/main.css" rel="stylesheet">
	
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  
    <!-- Guide de formatage -->
    <div style="background-color: #aaa;"><div class="container" style="background-color: #000; color:#eee;"><div class="row">
      <div class="visible-xs col-lg-12">Smartphone</div>
      <div class="visible-sm col-lg-12">Tablette</div>
      <div class="visible-md col-lg-12">Moyen écran</div>
      <div class="visible-lg col-lg-12">Grand écran</div>
    </div></div></div>
    
    <div class="container">
      
      <header class="row">
        <div class="col-xs-12 text-center" id="banner"><a href="index.shtml">IT-actublog</a></div>
        
        <div class="col-xs-12" id="navigation">
          <div class="navbar navbar-default" role="navigation">
              <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand"><div></div></a>
              </div>
              <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-center">
                  <li><a href="<?= $this->url('home', 'index') ?>">Accueil</a></li>
                  <li><a href="<?= $this->url('blog', 'index') ?>">Blog</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <?php if(isset($_SESSION['connected'])): ?>
                    <li><a>connecté</a></li>
                    <li><a href="<?= $this->url('login', 'logout') ?>">Se déconnecter</a></li>
                    <?php else: ?>
                    <li><a href="<?= $this->url('signup', 'index') ?>">Inscription</a></li>
                    <li><a href="<?= $this->url('login', 'index') ?>">Connexion</a></li>
                    <?php endif; ?>
                </ul>
              </div>
          </div>
        </div>
        
        <div class="col-xs-12 text-left" id="sub-bar"><?= $title ?></div>
      </header>
      
      <div class="row" id="content">
        <div class="col-xs-12 col-md-offset-1 col-md-10 col-lg-offset-2 col-lg-8">
            <?= $content_for_layout ?>
        </div>
      </div>
      
      <footer class="row">
        <div class="col-xs-12">
            <div class="pull-left"><a href="<?= $this->url('admin_home', 'index') ?>">administration blog</a></div>
            <div class="pull-right">IT-actublog - Tous droits réservés</div>
        </div>
      </footer>
    </div>
    
    <script src="js/jquery-1.12.4.js"></script> <!-- necessary for bootstrap javascript plugins -->
    <script src="js/bootstrap.js"></script> <!-- bootstrap javascript plugins -->
  </body>
</html>
