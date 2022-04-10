<?php 

require 'vendor/autoload.php';
require 'config.php'; // Declare $childlinkIENT_ID, $childlinkIENT_SECRET, $BASE_URL

$session = new SpotifyWebAPI\Session(
    $CLIENT_ID,
    $CLIENT_SECRET,
    $BASE_URL
);

if (!isset($_POST['motherlink']) && !isset($_POST['childlink']) && !isset($_POST['number'])){
    die();
}

$api = new SpotifyWebAPI\SpotifyWebAPI();

if (isset($_POST['code'])) {

    $session->refreshAccessToken($_POST['refresh']);
    $accessToken = $session->getAccessToken(); // Refresh Spotify Token for this page
    $refreshToken = $session->getRefreshToken();
    $api->setAccessToken($accessToken);

    $motherlink = $_POST['motherlink'];
    $childlink = $_POST['childlink'];
    $number = $_POST['number'];

    $x = 0;
    $musics = array( );

    while($x<=10){
        $playlistTracks = $api->getPlaylistTracks($motherlink, ['offset' => $x*100]); // Get X chunk of Mother's Playlist, ex: $x = 1 (1st music - 100th music); $x = 2 (101th music - 200th music)
        foreach ($playlistTracks->items as $track) {
            $track = $track->track;
            $musics[$track->id] = $track->id;   // Save Id of each track
        } 
        $x+=1;
    }

        if ($number>count($musics)){
            $number = count($musics); // Limit number of tracks of the Child's Playlist
        }

        $random = array_rand($musics, $number); 
        $arraychunks = count($random)/100; 
        $arraychunks = (int) $arraychunks + 1;

        try {
            if ($arraychunks<=1){
                $api->replacePlaylistTracks($childlink, $random);
            }else{
                $y = 0;
                $api->replacePlaylistTracks($childlink, null);

                while ($y<$arraychunks*100){
                    $chunktracks = array_slice($random, $y, 100);
                    $api->addPlaylistTracks($childlink, $chunktracks);
                    $y += 100;
                }
            }
        } catch (Exception $e) {
            // echo 'Error Log: ',  $e->getMessage(), "\n";
        }

        $birthedChild = $api->getPlaylist($childlink); 

        $birthedChildImage = $api->getPlaylistImage($childlink);
        $image = (array)$birthedChildImage[0];

        $birthedChildTracks = $api->getPlaylistTracks($childlink);
        include('./pages/result.php'); // Render Front-End
   
} else {
    header('Location: ' . $session->getAuthorizeUrl($options));
    die();
}

