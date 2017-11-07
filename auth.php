<?php

use Brightcove\API\Client;
use Brightcove\API\CMS;

require_once('vendor/autoload.php');

$client_id = "";
$client_secret = "";
$account_id = 123;

//No idea why I had to do this
$client = Client::authorize($client_id, $client_secret);
$api = new CMS($client, $account_id);

//Dumping out video data 
//
var_dump($api->getVideo(123));

$videos = $api->listVideos('state:ACTIVE'));

//Pull the first ID of the first element
var_dump($videos[0]->getId());
