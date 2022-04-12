<?php

require 'vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$session = new SpotifyWebAPI\Session(
    $_ENV['CLIENT_ID'],
    $_ENV['CLIENT_SECRET'],
    $_ENV['BASE_URL']
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

        include('./pages/create.php');

        // include ('html/home.php');

    }catch (exception $e){
        header('Location: ' . $BASE_URL);
        die();
    }
    
} else {
    header('Location: ' . $session->getAuthorizeUrl($options));
    die();
}