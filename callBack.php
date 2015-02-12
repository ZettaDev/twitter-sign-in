<?php
    session_start();
    // importamos la librería de Twitter Oauth
    require_once( 'libs/twitteroauth.php' );
    // definimos 3 constantes y copiamos los datos de la aplicación
    require_once('config/config.php');
    // creamos el objeto twitter pero en este caso para autenticar al usuario en la aplicación
    $twitter = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $_SESSION['token_temporal'], $_SESSION['secreto_temporal']);
    // conseguimos el token definitivo con el parámetro oauth_verifier que nos envía twitter
    $token_final = $twitter->getAccessToken($_GET['oauth_verifier']);
    
    if ($twitter->http_code == 200) {
        // el inicio de sesión es correcto, guardamos en la sesión datos del usuario
        $_SESSION['token_usuario'] = $token_final['oauth_token'];
        $_SESSION['secreto_usuario'] = $token_final['oauth_token_secret'];
        $_SESSION['nombre'] = $token_final['screen_name'];
        $_SESSION['user_id'] = $token_final['user_id'];
        $_SESSION['logeado'] = true;
        // usuario logeado con éxito  redirigimos a principal.php
        header('Location: principal.php');
        } else {
        // hubo algún error  redirigimos de nuevo a index.php pasando por get el parámetro error=1
    header('Location: index.php?error=1');
    }
?>