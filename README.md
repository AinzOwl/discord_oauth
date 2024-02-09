
# Discord OAuth PHP Class

A PHP class providing an easy way to integrate Discord OAuth functionality into your PHP projects. It allows you to authenticate users via Discord and retrieve their account information.

## Features

- Authenticate with Discord OAuth2.
- Get an authorization URL to redirect users for authentication.
- Exchange a Discord code for an OAuth token.
- Retrieve the user's account information from Discord.
- Supports adding additional OAuth scopes like email, connections, and more.

## Requirements

- PHP 7.4 or higher.
- cURL extension enabled in PHP for HTTP requests.

## Installation

To use this class in your project, first clone or download this repository into your project's directory.

If you use Git, you can add this project as a submodule:

```bash
git clone https://github.com/AinzOwl/discord_oauth
```
move the class to your wanted directories and update your config with the values from the config file inside the repo

Alternatively, you can download the `.zip` archive and extract it to a directory within your project.


## Configuration

The class requires certain configuration parameters to initiate the Discord OAuth flow. You'll need to obtain a Client ID and Client Secret from the [Discord Developer Portal](https://discord.com/developers/applications).

## Usage

Here's a simple example of how to use the class in your project:

```php
require 'path/to/DiscordOAuth.php';

use AinzOwl\DiscordOAuth\DiscordOAuth;

$clientId = 'YOUR_CLIENT_ID'; // Replace with your Discord application client ID
$clientSecret = 'YOUR_CLIENT_SECRET'; // Replace with your Discord application client secret
$scopes = ['identify', 'email']; // Add required scopes
$redirectUri = 'YOUR_REDIRECT_URI'; // Replace with your URL to handle OAuth redirect

$discordOAuth = new DiscordOAuth();

// Step 1: Redirect the user to Discord's authorization page
$authUrl = $discordOAuth->getAuthorizationUrl($clientId, $scopes, $redirectUri);
header('Location: ' . $authUrl);
exit;

// Step 2: Handle the redirect from Discord
if (isset($_GET['code'])) {
    $authCode = $_GET['code'];

    // Exchange the code for an access token
    $token = $discordOAuth->exchangeCode($clientId, $clientSecret, $scopes, $authCode, $redirectUri);

    // Get the user's info
    if ($token) {
        $userInfo = $discordOAuth->getUserInfo($token['access_token']);
        print_r($userInfo); // Do something with the user info
    }
}
```

## Adding Additional Scopes

Discord OAuth allows you to request additional permissions, called scopes. To request more than the user's identity, include additional scopes as strings within the `$scopes` array. For example:

```php
$scopes = ['identify', 'email', 'guilds', 'connections'];
```

For a full list of Discord OAuth2 scopes and their descriptions, refer to the [Discord API documentation](https://discord.com/developers/docs/topics/oauth2#shared-resources-oauth2-scopes).

## Demo

You can check index.php login.php and logout.php for a simple demo for using this class.

## Contributing

If you'd like to contribute to the development of this Discord OAuth PHP class, feel free to fork the repository and submit a pull request with your changes.

## License

This project is licensed under the GNU License - see the [`LICENSE`](LICENSE) file for details.

## Acknowledgments

- The Discord API documentation for providing detailed information on OAuth2 flows.

## Contact

[Ainz](https://ainz.uk) - [@ainzoall](https://twitter.com/ainzoall)

Project Link: [https://github.com/AinzOwl/discord_oauth](https://github.com/AinzOwl/discord_oauth)
