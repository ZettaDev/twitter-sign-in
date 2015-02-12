<?php   
    session_start();   
    // importamos la librería de Twitter Oauth   
    require_once( 'libs/twitteroauth.php' );  
    // definimos 3 constantes: copia los datos del registro de aplicación en Twitter
    require_once('config/config.php');
    // si no es un usuario logeado --> generamos el botón de login   
    if (!isset($_SESSION['logeado']) or (!$_SESSION['logeado'])) {           
        // creamos el objeto twitter para autenticar la aplicación           
        $twitter = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);  
        // creamos una variable para obtener el token temporal de usuario           
        $token_temporal = $twitter->getRequestToken(OAUTH_CALLBACK);  
        // guardamos el token temporal del usuario y su secreto usarlos después en callBack.php           
        $_SESSION['token_temporal'] = $token_temporal["oauth_token"];           
        $_SESSION['secreto_temporal'] = $token_temporal["oauth_token_secret"];                    
        // por último obtenemos la URL para que los usuarios puedan iniciar sesión           
        $url = $twitter->getAuthorizeURL ($token_temporal["oauth_token"]);  
        // aquí mostraremos el botón de login    
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
<li><a href="<?=$url?>" class="button">Login</a></li>
</ul>
</div>
</div>
</div>
<div class="hero">
<div class="row">
<div class="large-12 columns intro-text">
<?php
        if (isset($_GET['error'])) {                 
            echo "<p>Error en tus datos de Twitter. Vuelve a intentarlo<p>";
        } else {
            echo "<p>Twitter!<br>Test de inicio de session.</p>";
        }
    } else {     
        header('Location: principal.php');   
    } 
?>
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