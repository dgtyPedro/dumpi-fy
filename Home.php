<?php

require 'vendor/autoload.php';
require 'config.php';

$session = new SpotifyWebAPI\Session(
    $CLIENT_ID,
    $CLIENT_SECRET,
    $BASE_URL
);

$options = [
    'scope' => [
		'playlist-modify-public',
		'playlist-modify-private',
		'playlist-read-private',
		'playlist-read-collaborative',
    ],
	// 'show_dialog' => true
];


$api = new SpotifyWebAPI\SpotifyWebAPI();

if (isset($_GET['code'])) {
    
    try{
        $session->requestAccessToken($_GET['code']);
        $refreshToken = $session->getRefreshToken();
        $api->setAccessToken($session->getAccessToken());

        $me = (array)$api->me();
        $iduser = $me['id'];

        $objectplaylists = $api->getUserPlaylists($iduser, [
            'limit' => 20
        ]);

        $playlists = [];

        foreach ($objectplaylists->items as $playlist) {
            $playlists[$playlist->id] = $playlist->name;
        }

        include('./pages/home.php');
        // include ('html/home.php');

    }catch (exception $e){
        header('Location: ' . $BASE_URL);
        die();
    }
    
} else {
    header('Location: ' . $session->getAuthorizeUrl($options));
    die();
}