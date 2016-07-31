<?php

define('HS', true);

/*
 *  Programmer  : Hasanudin HS
 *  Email       : banghasan@gmail.com
 *  Telegram    : @hasanudinhs
 *
 *  Name        : Template bot telegram - php
 *  Fungsi      : Sample bot API
 *  Pembuatan   : Mei 2016
 *
 *  File        : bot.php
 *  Tujuan      : bot poll untuk telegram
 *  ____________________________________________________________
*/

require_once 'bot-api-config.php';
require_once 'bot-api-fungsi.php';

require_once 'bot-api-proses.php';

/* ----------------- MULAI LOOPING

Jika tidak ada pesan masuk ditandai -
Jika ada pesan masuk pada console ditandai +

*/




function myloop()
{
    global $debug;

    $idfile = 'botposesid.txt';
    $update_id = 0;

    if (file_exists($idfile)) {
        $update_id = (int) file_get_contents($idfile);
        echo '-';
    }

    $updates = getApiUpdate($update_id);

    foreach ($updates as $message) {
        $update_id = prosesApiMessage($message);
        echo '+';
    }
    file_put_contents($idfile, $update_id + 1);
}

while (true) {
    myloop();
}


// Telegram by: banghasan @hasanudinhs @myqers;
