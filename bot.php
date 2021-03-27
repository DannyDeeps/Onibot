<?php

use Discord\Discord;
use Discord\Parts\Channel\{ Guild, Channel, Message };
use React\EventLoop\Factory;

require __DIR__ . '/vendor/autoload.php';

$loop = Factory::create();
$discord = new Discord([
    'token' => 'ODI1MTU0MTc3NzcyMTU5MDM2.YF5ytg.c6tGhN9N4XPDJQnxeXU0An3EtFw',
    'loop' => $loop,
    'disabledEvents' => []
]);

$discord->on('ready', function(Discord $discord)
{
    $discord->on('message', function (Message $message, Discord $discord)
    {
        switch (strtolower($message->content)) {
            case '!initrole':

                $message= new Message($discord);
                $message->content= 'Select a reaction to designate your role!';
                $message->reactions= [':Heal:825145748936589312',':Tank:825357985030209576',':Range:825357985030209576',':Attack:825357985030209576'];
                $channel = $discord->getChannel('825144851267977256');
                $channel->sendMessage($message);


                // $channel->sendMessage('Select a reaction to designate your role!')->done(function(Message $msg) use ($discord, $channel) {

                //     // Solution #1
                //     // $msg->react(':Heal:825145748936589312')->done(function(Message $msg) {
                //     //     $msg->react(':Tank:825357985030209576')->done(function(Message $msg) {
                //     //         $msg->react(':Range:825357985030209576')->done(function(Message $msg){
                //     //             $msg->react(':Attack:825357985030209576');
                //     //         });
                //     //     });
                //     // });


                //     // Solution #2
                //     // $emojis= [':Heal:825145748936589312',':Tank:825357985030209576',':Range:825357985030209576',':Attack:825357985030209576'];
                //     // foreach ($emojis as $emoji) {
                //         //     $msg->react($emoji);
                //         // }

                //     // Solution #3
                //     // $channel->getMessage($msg->id)->done(function(Message $msg){
                //     //     $emojis= [':Heal:825145748936589312',':Tank:825357985030209576',':Range:825357985030209576',':Attack:825357985030209576'];
                //     //     $msg->reactions= $emojis;
                //     // });



                // }, function($e) {
                //     echo "Error: {$e->getMessage()}";
                // });
                break;
            case '!initregion':
                $channel = $discord->getChannel('825144851267977256');
                $channel->sendMessage('Select a reaction to designate your region!')->done(function(Message $msg) {
                    $msg->react(':EU:825357985030209576');
                    $msg->react(':NA:825357985030209576');
                }, function($e) {
                    echo "Error: {$e->getMessage()}";
                });
                break;
        }
    });
});

$discord->run();