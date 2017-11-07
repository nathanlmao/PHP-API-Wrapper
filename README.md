# PHP Wrapper for the Brightcove API

## Installation notes

This library requires PHP 5.5 or newer with a CURL extension. You have to run `composer install` before using the library.

    # apt-get install php5 php5-curl curl

    PHP-API-Wrapper$ curl -sS https://getcomposer.org/installer | php

    PHP-API-Wrapper$ php composer.phar install

## Testing notes

Running the tests requires a `config.json` file. There's a sample file included in the repository.

A reverse SSH tunnel is needed for the DI API test. When you set it up, make sure that the port is open on the remote
server too.

Example script:

    #!/bin/sh
    
    ssh -nNT -R 8888::8888 example.com &>ssh_tunnel_logfile.txt &
    PID=$!
    
    cleanup () {
        kill ${PID}
        cat ssh_tunnel_logfile.txt
        rm ssh_tunnel_logfile.txt
    }
    
    handle_error () {
        cleanup
        exit 1
    }
    
    ./vendor/bin/phpunit
    
    cleanup
    
## Example 

```
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
```
