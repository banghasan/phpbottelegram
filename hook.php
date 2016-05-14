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



$entityBody = file_get_contents('php://input');
$message = json_decode($entityBody, true);
prosesApiMessage($message);


// Telegram by: banghasan @hasanudinhs @myqers


?>