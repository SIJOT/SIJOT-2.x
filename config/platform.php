<?php


/* 
 |-------------------------------------------------------------------------- 
 | Platform config
 |-------------------------------------------------------------------------- 
 | 
 | This is the platform configuration. Below is a short description of the config variables. 
 | The most important config variables are stored in the .env. Be sure these are also correct.
 | 
 | config/platform.php 
 | =====================
 | [webmasterEmail] = The email addrees of the webmaster
 | [webmasterName]  = The Name off the webmaster.
 | [websiteName]    = The name of the website. This is used in the navbar and page title.
 | [websiteContact] = The contact info email address off the scouting group.
 | [broadcast]      = Enable of disable pusher. Values = true, false
 */

return [
 /*
  * Webmaster details
  */
 'webmasterEmail'  => 'Topairy@gmail.com',
 'webmasterName'   => 'Tim Joosten',

 /*
  * Website Info.
  */
 'websiteName'    => 'Sint-Joris',
 'websiteContact' => 'Contact@qst-joris-turnhout.be',

 /*
  * Various.
  */
 'broadcast'      => true,
];
