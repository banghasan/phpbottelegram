<?php

if (!defined('HS')) {
    die('Tidak boleh diakses langsung.');
}


/*
 *  Programmer	: Hasanudin HS
 *  Email     	: banghasan@gmail.com
 *  Telegram  	: @hasanudinhs
 *
 *  Name      	: Template bot telegram - php
 *  Fungsi    	: Sample bot API
 *  Pembuatan 	: Mei 2016
 *
 *  File 	  	: bot-api-proses.php
 *  Tujuan		: semua proses bot ada di sini
 *  ____________________________________________________________
*/



/*

Contoh penggunaan :
~~~~~~~~~~~~~~~~~~~~~

Kirim Aksi
----------
(typing, upload_photo, record_video, upload_video, record_audio, upload_audio, upload_document, find_location) :

    sendApiAction($chatid);
    sendApiAction($chatid, 'upload_photo');


Kirim Pesan :
----------
    sendApiMsg($chatid, 'pesan');
    sendApiMsg($chatid, 'pesan *tebal*', false, 'Markdown');


Kirim Markup Keyboard :
----------
    $keyboard = [
        [ 'tombol 1', 'tombol 2' ],
        [ 'tombol 3', 'tombol 4' ],
        [ 'tombol 5' ]
    ];

    sendApiKeyboard($chatid, 'tombol pilihan', $keyboard);


Kirim Inline Keyboard
----------
    $inkeyboard = [
        [
            ['text'=>'tombol 1', 'callback_data' => 'data 1'],
            ['text'=>'tombol 2', 'callback_data' => 'data 2']
        ],
        [
            ['text'=>'tombol akhir', 'callback_data' => 'data akhir']
        ]
    ];

    sendApiKeyboard($chatid, 'tombol pilihan', $inkeyboard, true);


editMessageText
----------
    editMessageText($chatid, $message_id, $text, $inkeyboard, true);



Menyembunyikan keyboard :
----------
    sendApiHideKeyboard($chatid, 'keyboard off');


kirim sticker
----------

    sendApiSticker($chatid, 'BQADAgADUAADxKtoC8wBeZm11cjsAg')


Dan Lain-lain :-D
~~~~~~~~~~~~~~~~~~~~~

*/


function prosesApiMessage($sumber)
{
    $updateid = $sumber['update_id'];

   // if ($GLOBALS['debug']) mypre($sumber);

    if (isset($sumber['message'])) {
        $message = $sumber['message'];

        if (isset($message['text'])) {
            prosesPesanTeks($message);
        } elseif (isset($message['sticker'])) {
            prosesPesanSticker($message);
        } else {
            // gak di proses silakan dikembangkan sendiri
        }
    }

    if (isset($sumber['callback_query'])) {
        prosesCallBackQuery($sumber['callback_query']);
    }

    return $updateid;
}

function prosesPesanSticker($message)
{
    // if ($GLOBALS['debug']) mypre($message);
}

function prosesCallBackQuery($message)
{
    // if ($GLOBALS['debug']) mypre($message);

    $message_id = $message['message']['message_id'];
    $chatid = $message['message']['chat']['id'];
    $data = $message['data'];

    $inkeyboard = [
                [
                    ['text' => 'Update 1', 'callback_data' => 'data update 1'],
                    ['text' => 'Update 2', 'callback_data' => 'data update 2'],
                ],
                [
                    ['text' => 'keyboard on', 'callback_data' => '!keyboard'],
                    ['text' => 'keyboard inline', 'callback_data' => '!inline'],
                ],
                [
                    ['text' => 'keyboard off', 'callback_data' => '!hide'],
                ],
            ];

    $text = '*'.date('H:i:s').'* data baru : '.$data;

    editMessageText($chatid, $message_id, $text, $inkeyboard, true);

    $messageupdate = $message['message'];
    $messageupdate['text'] = $data;

    prosesPesanTeks($messageupdate);
}


function prosesPesanTeks($message)
{
    // if ($GLOBALS['debug']) mypre($message);

    $pesan = $message['text'];
    $chatid = $message['chat']['id'];
    $fromid = $message['from']['id'];

    switch (true) {

        case $pesan == '/id':
            sendApiAction($chatid);
            $text = 'ID Kamu adalah: '.$fromid;
            sendApiMsg($chatid, $text);
            break;

        case $pesan == '!keyboard':
            sendApiAction($chatid);
            $keyboard = [
                ['tombol 1', 'tombol 2'],
                ['!keyboard', '!inline'],
                ['!hide'],
            ];
            sendApiKeyboard($chatid, 'tombol pilihan', $keyboard);
            break;

        case $pesan == '!inline':
            sendApiAction($chatid);
            $inkeyboard = [
                [
                    ['text' => 'Update 1', 'callback_data' => 'data update 1'],
                    ['text' => 'Update 2', 'callback_data' => 'data update 2'],
                ],
                [
                    ['text' => 'keyboard on', 'callback_data' => '!keyboard'],
                    ['text' => 'keyboard inline', 'callback_data' => '!inline'],
                ],
                [
                    ['text' => 'keyboard off', 'callback_data' => '!hide'],
                ],
            ];
            sendApiKeyboard($chatid, 'Tampilan Inline', $inkeyboard, true);
            break;

        case $pesan == '!hide':
            sendApiAction($chatid);
            sendApiHideKeyboard($chatid, 'keyboard off');
            break;

        case preg_match("/\/echo (.*)/", $pesan, $hasil):
            sendApiAction($chatid);

            $text = '*Echo:* '.$hasil[1];
            sendApiMsg($chatid, $text, false, 'Markdown');
            break;

        default:
            // code...
            break;
    }
}
