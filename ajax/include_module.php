<?
use Bitrix\Main\Loader;

Loader::includeModule('yenisite.core');

$moduleId = "yenisite.bitronic2pro";	/// !!!!!!!!!!!!!!
$moduleCode = 'bitronic2pro'; // !!!!!!!!
$settingsClass = 'CRZBitronic2Settings';

if (!Loader::includeModule($moduleId)) die("Module {$moduleId} not installed!");
