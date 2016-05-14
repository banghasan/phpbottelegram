# PHP BOT Telegram

Template bot telegram menggunakan php dengan konsep sederhana. Mudah dipelajari dan dimodifikasi.

### Penggunaan Poll:

    php bot.php

Baik poll atau webhook yang diutak-atik hanya 1 file saja :
    
    bot-api-proses.php

Sebelum menjalankan, jangan lupa edit dahulu file :

	bot-api-config.php


Untuk metode hook di set ke file `hook.php` :
	
	https://domain.mu/path/hook.php


### Installasi

1. download atau clone ini

2. edit file bot-api-config.php

	ganti bagian $token = ''; sesuai token bot mu.
	

3. jalankan
	
	php bot.php

4. perintah tersedia secara default :

	/id 

		menginformasikan id mu

	!keyboard

		sample markup keyboard

	!inline

		sample markup inline keyboard

	!hide

		menyembunyikan keyboard
