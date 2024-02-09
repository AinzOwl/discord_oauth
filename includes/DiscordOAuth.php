<?php

namespace AinzOwl\DiscordOAuth;

class DiscordOAuth {
    private function httpRequest($url, $postFields = null, $headers = []) {
        $ch = curl_init($url);

        if ($postFields !== null) {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
        }

        if (!empty($headers)) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

        $data = curl_exec($ch);
        $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        return [
            'data' => $data,
            'status' => $status,
        ];
    }

    public function getAuthorizationUrl($clientId, $scopes, $redirectUri) {
        return 'https://discord.com/api/oauth2/authorize?' . http_build_query([
            'response_type' => 'code',
            'client_id'     => $clientId,
            'scope'         => $scopes,
            'redirect_uri'  => $redirectUri
        ]);
    }

    public function exchangeCode($clientId, $clientSecret, $scopes, $code, $redirectUri) {
        $response = $this->httpRequest(
            'https://discord.com/api/oauth2/token',
            http_build_query([
                'grant_type'    => 'authorization_code',
                'client_id'     => $clientId,
                'client_secret' => $clientSecret,
                'redirect_uri'  => $redirectUri,
                'code'          => $code,
                'scope'         => $scopes,
            ]),
            ['Content-Type: application/x-www-form-urlencoded']
        );

        if ($response['status'] === 200) {
            return json_decode($response['data'], true);
        }

        return null;
    }

    public function getUserInfo($accessToken) {
        $response = $this->httpRequest(
            'https://discord.com/api/users/@me',
            null,
            ['Authorization: Bearer ' . $accessToken]
        );

        if ($response['status'] === 200) {
            return json_decode($response['data'], true);
        }

        return null;
    }
}