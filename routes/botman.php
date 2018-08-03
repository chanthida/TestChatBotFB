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
    $bot->hears('hiya', function($bot) {
//        $bot->reply(\BotMan\Drivers\Facebook\Extensions\ButtonTemplate::create('Do you want to know more about BotMan?')
//            ->addButton(\BotMan\Drivers\Facebook\Extensions\ElementButton::create('Tell me more')->type('postback')->payload('tellmemore'))
//            ->addButton(\BotMan\Drivers\Facebook\Extensions\ElementButton::create('Show me the docs')->url('http://botman.io/'))
//        );
        $bot->reply('Nice to meet you!');
    });
});

$botman->fallback(function($bot) {
    $bot->reply('Sorry, I did not understand these commands. Here is a list of commands I understand: ...');
});
