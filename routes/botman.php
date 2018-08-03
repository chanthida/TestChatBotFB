<?php
use App\Http\Controllers\BotManController;
use BotMan\BotMan\Messages\Attachments\Image;
use BotMan\BotMan\Messages\Outgoing\OutgoingMessage;

$botman = resolve('botman');

$botman->hears('.*(Hi|Hello).*', function ($bot) {
    $bot->reply('Nice to meet you!');
});

$botman->hears('Start conversation', BotManController::class.'@startConversation');

$botman->hears('xx', BotManController::class.'@xx');

$botman->hears('call me {name}', function ($bot, $name) {
    $bot->reply('Your name is: '.$name);
});

$botman->hears('I want ([0-9]+)', function ($bot, $number) {
    $bot->reply('You will get: '.$number);
});

$botman->group(['driver' => \BotMan\Drivers\Facebook\FacebookDriver::class], function($bot) {
    $bot->hears('5555', function($bot) {
        $bot->reply('Nice to meet you!');
    });
});

$botman->fallback(function($bot) {
    $bot->reply('Sorry, I did not understand these commands. Here is a list of commands I understand: ...');
});
