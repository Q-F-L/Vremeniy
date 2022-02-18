<?
if(\Bitrix\Main\Loader::includeModule('yenisite.worktime'))
{
	$APPLICATION->IncludeComponent(
	"yenisite:bitronic.worktime",
	"bitronic2",
	array(
		"COMPONENT_TEMPLATE" => "bitronic2",
		"LUNCH" => "",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "360000",
		"MONDAY" => "Y",
		"TUESDAY" => "Y",
		"WEDNESDAY" => "Y",
		"THURSDAY" => "Y",
		"FRIDAY" => "Y",
		"SATURDAY" => "N",
		"SUNDAY" => "N",
		"TIME_WORK_FROM" => "09:00",
		"TIME_WORK_TO" => "22:00",
		"TIME_WEEKEND_FROM" => "10:00",
		"TIME_WEEKEND_TO" => "21:00",
		"LUNCH_WEEKEND" => "Рабочее время в выходные – с 9 до 21 часа",
		"TIME_WORK" => "",
		"TIME_WEEKEND" => "",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
);
}