<?php
require_once 'includes/config.php';

$redirectUri = $website['redirect_url'];

if (isset($_SESSION['discord']) || isset($_GET['error'])) {
    header('Location: ' . $website['url']);
    exit;
} elseif (isset($_GET['code'])) {
    $auth = $discordOAuth->exchangeCode(
        $website['discord_client'],
        $website['discord_secret'],
        $website['discord_scopes'],
        $_GET['code'],
        $redirectUri
    );

    if ($auth) {
        $user = $discordOAuth->getUserInfo($auth['access_token']);
        if ($user) {
            $_SESSION['discord']['access_token']     = $auth['access_token'];
            $_SESSION['discord']['refresh_token']    = $auth['refresh_token'];
            $_SESSION['discord']['token_expiration'] = time() + $auth['expires_in'];
            $_SESSION['discord']['user_id']          = $user['id'];
            $_SESSION['discord']['avatar_id']        = $user['avatar'];
            $_SESSION['discord']['username']         = $user['username'];
            $_SESSION['discord']['discriminator']    = $user['discriminator'];
            header('Location: ' . $website['url']);
            exit;
        }
    }
} else {
    $authUrl = $discordOAuth->getAuthorizationUrl($website['discord_client'], $website['discord_scopes'], $redirectUri);
    header('Location: ' . $authUrl);
    exit;
}