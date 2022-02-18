<?php
include_once "include_stop_statistic.php";
if (empty($_POST['parameters']))
{
	echo 'no parameters found';
	return;
}

// for sef of standart bitrix component
$_SERVER["REQUEST_URI"] = !empty($_REQUEST["REQUEST_URI"]) ? $_REQUEST["REQUEST_URI"] : $_SERVER["REQUEST_URI"];
$_SERVER["SCRIPT_NAME"] = !empty($_REQUEST["SCRIPT_NAME"]) ? $_REQUEST["SCRIPT_NAME"] : $_SERVER["SCRIPT_NAME"];

require $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php";
/**
 * @todo close session after fix resizer 3.0 problem with parallel work
 */
//@session_write_close();

include_once "include_module.php";
include_once 'include_options.php';
include_once($_SERVER["DOCUMENT_ROOT"].SITE_TEMPLATE_PATH."/lang/".LANGUAGE_ID."/header.php");

$signer = new \Bitrix\Main\Security\Sign\Signer;

$parameters = $signer->unsign($_POST['parameters'], 'bx.bd.products.recommendation');
$template = $signer->unsign($_POST['template'], 'bx.bd.products.recommendation');

$APPLICATION->IncludeComponent(
	"yenisite:catalog.bigdata.products.noinject",
	$template,
	unserialize(base64_decode($parameters)),
	false
);