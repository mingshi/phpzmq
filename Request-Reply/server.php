<?php
/**
 * hello world server
 * Binds REP socket to tcp://*:5555
 * Expects "Hello" from client,replies with "world"
 */
$context = new ZMQContext();

$responder = new ZMQSocket($context,ZMQ::SOCKET_REP);
$responder->bind("tcp://*:5555");

while(true) {
    $request = $responder->recv();
    printf ("Received request: [%s]\n", $request);

    // do something
    sleep(1); //or no??

    // send reply
    $responder->send("world");
}
