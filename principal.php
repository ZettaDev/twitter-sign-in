<?php   
    session_start();  

    // importamos la librería de Twitter Oauth                   
    require_once( 'libs/twitteroauth.php' );                   
    // definimos 3 constantes y copiamos los datos de la aplicación                           
    require_once( 'config/config.php' );                 
    // volvemos a crear objeto twitter con el token del usuario                   
    $twitter = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $_SESSION['token_usuario'], $_SESSION['secreto_usuario']);                   
    // accedemos a las credenciales del usuario (tienen toda la información que buscamos)                   
    $info = $twitter->get('account/verify_credentials'); 
    $id_amigos = $twitter->get('friends/ids', array('screen_name' => $info->screen_name));
    $id_seguidores = $twitter->get('followers/ids', array('screen_name' => $info->screen_name));
    $amigos="";
    //print_r($info);
    foreach ($id_amigos->ids  as $id_actual) {  
        $usuario = $twitter->get('users/show',  array('user_id' => $id_actual));       
        $amigos=$amigos."<br/>".$usuario->name;  
    }
    $seguidores="";
    foreach ($id_seguidores->ids  as $id_actual) {  
        $usuario = $twitter->get('users/show',  array('user_id' => $id_actual));       
        $seguidores=$seguidores."<br/>".$usuario->name;  
    }
    $_SESSION = $info;  
?>

<!doctype html>
<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
<html class="no-js" lang="en" data-useragent="Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.2; Trident/6.0)">
<head>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Foundation Template | Portfolio Theme</title>
<meta name="description" content="Documentation and reference library for ZURB Foundation. JavaScript, CSS, components, grid and more."/>
<meta name="author" content="ZURB, inc. ZURB network also includes zurb.com"/>
<meta name="copyright" content="ZURB, inc. Copyright (c) 2015"/>
<link rel="stylesheet" href="css/foundation.css"/>
<link rel="stylesheet" href="css/portfolio-theme.css"/>
<script src="js/vendor/modernizr.js"></script>
</head>
<body>
<link href="http://fonts.googleapis.com/css?family=Raleway:600,400,200" rel="stylesheet" type="text/css">
<link href="http://fonts.googleapis.com/css?family=Shadows+Into+Light" rel="stylesheet" type="text/css">
<div class="row">
<div class="small-12 medium-4 large-6 columns namelogo">
<h1>Twitter Login</h1>
</div>
<div class="small-12 medium-8 large-6 columns">
<div class="nav-bar">
<ul class="button-group">
<li><a href="cerrar.php" class="button">Cerrar</a></li>
</ul>
</div>
</div>
</div>
<div class="row about">
<div class="medium-6 large-8 columns">
<h4><?=$info->name?></h4>
<p><?=$info->description?></p>
</div>
<div class="medium-6 large-4 columns">
<img src="<?=$info->profile_image_url?>">
</div>
</div>
<div class="row work">   
    <hr>
    <div class="large-12 columns">
        <div>
            <h3>Amigos <?=$info->friends_count?></h3>
            <div>
                <p>
                <?=$amigos?>
                </p>
            </div>
            <h3>Seguidores <?=$info->followers_count?></h3>
            <div>
                <p>
                <?=$seguidores?>
                </p>
            </div>
        </div>
    </div>
</div>
<footer class="row">
<div class="large-12 columns">
<div class="row">
<div class="large-6 columns">
<p>© Ezequiel y Mika.</p>
</div>
</div>
</div>
</footer>
<script>
  document.write('<script src=' +
  ('__proto__' in {} ? 'js/vendor/zepto' : 'js/vendor/jquery') +
  '.js><\/script>')
</script>
<script src="js/vendor/jquery.js"></script>
<script src="js/foundation.min.js"></script>
<script src="js/foundation/foundation.js"></script>
<script src="js/foundation/foundation.clearing.js"></script>
<script>
  $(document).foundation();
</script>
</body>
</html>