<?php
/**
 * weather update server
 * binds PUB socket to tcp://*:5556
 * Publishes random weather updates
 */
$context = new ZMQContext();
$publisher = $context->getSocket(ZMQ::SOCKET_PUB);
$publisher->bind("tcp://*:5556");
$publisher->bind("ipc://weather.ipc");

while (TRUE) {
    $zipcode    =   mt_rand(0,100000);
    $temperature    =   mt_rand(-80,135);
    $relhumidity    =   mt_rand(10,60);

    $update =   sprintf ("%05d %d %d", $zipcode, $temperature, $relhumidity); 
    $publisher->send($update);
}
