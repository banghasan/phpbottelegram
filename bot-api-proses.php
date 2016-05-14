<?php

if (! defined('HS')) 
	die('Tidak boleh diakses langsung.');


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

	sendApiKeyboard($idtujuan, 'tombol pilihan', $inkeyboard, true);


Menyembunyikan keyboard :
----------
	sendApiHideKeyboard($idtujuan, 'keyboard off');


Dan Lain-lain :-D
~~~~~~~~~~~~~~~~~~~~~

*/


function prosesApiMessage($sumber)
{
    $updateid = $sumber["update_id"];
    
    if ($GLOBALS['debug']) mypre($sumber);

    if (isset($sumber["message"])) {
    
    	$message = $sumber["message"];
	
    	if (isset($message["text"])) {
    		prosesPesanTeks($message);
    	} elseif (isset($message["sticker"])) {
    		prosesPesanSticker($message);
    	} else {
    		// gak di proses silakan dikembangkan sendiri
	
    	}

    }

    if (isset($sumber["callback_query"])) 
    	prosesCallBackQuery( $sumber["callback_query"]['message'] ) ;

    return $updateid;
}

function prosesPesanSticker($message)
{
	// if ($GLOBALS['debug']) mypre($message);
}

function prosesCallBackQuery($message)
{
	# code...
}


function prosesPesanTeks($message)
{
	// if ($GLOBALS['debug']) mypre($message);

	$pesan 		= $message['text'];
	$chatid 	= $message['chat']['id'];
	$fromid		= $message['from']['id'];

	switch (true) {
		
		case ($pesan == '/id'):
			sendApiAction($chatid);

			$text = 'ID Kamu adalah: ' . $fromid;
			sendApiMsg($chatid, $text);
			break;

		case (preg_match("/\/echo (.*)/", $pesan)):
			sendApiAction($chatid);

			preg_match("/\/echo (.*)/", $pesan, $hasil);

			$text = '*Echo:* ' . $hasil[0];
			sendApiMsg($chatid, $text, false, 'Markdown');
			break;
		
		default:
			# code...
			break;
	}

}


?>