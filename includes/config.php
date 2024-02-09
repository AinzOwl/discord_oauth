<?php
require_once(__dir__ . '/DiscordOAuth.php'); // If not using Composer

use AinzOwl\DiscordOAuth\DiscordOAuth;

// Global path constants (if needed) and starting a session.
define('PATH_ABSOLUTE', dirname(__FILE__) . '/../');
define('PATH_INCLUDES', PATH_ABSOLUTE . 'includes/');
session_start();

// Global website variables.
$website['discord_client'] = 'discord client id';
$website['discord_secret'] = 'discord client secret';
$website['discord_scopes'] = 'identify';
$website['name']           = 'Website Name';
$website['url']            = 'domain of your website';
$website['redirect_url']   = 'redirect url for oauth';

// Instantiate the DiscordOAuth class with HTTP client.
$discordOAuth = new DiscordOAuth();
