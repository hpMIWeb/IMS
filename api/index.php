<?php
Header('Access-Control-Allow-Origin: *'); //For First Time Allow All Request
Header('Access-Control-Allow-Headers: headers, Origin, X-Requested-With, Content-Type, Accept, Authorization,mobileAccess,MobileAccess'); //for allow any headers, insecure
Header('Access-Control-Allow-Methods: GET, POST'); //Allowed Only Get,POST Method
header('Access-Control-Max-Age: 10000'); // Cache store only 5 minute

error_reporting(1);

$HEADERS = apache_request_headers();
$allowed_domains = [];
/* set default timezone */
date_default_timezone_set("Asia/Kolkata");

/* jwt token */
require_once '../vendor/autoload.php';

$privateKey = file_get_contents('./../private.pem');
$publicKey = file_get_contents('./../public.pem');
global $privateKey, $publicKey;

/* All Class Load */
require_once './classes/CommonFunction.php'; /* don't move*/
require_once './classes/module/ProjectCommon.php'; /* don't move*/
require_once './classes/Config.php'; /* don't move*/

/* Include SMTP Mail File */
require_once './classes/module/Email.php';
require_once './classes/APIBase.php';
/* all classes declare here */

require_once './classes/module/Sessions.php';
require_once './classes/module/Masters.php';

$configObj = new APIBase($HEADERS);
header('Content-Type: application/json');
print_r($configObj->returnAPIData());
