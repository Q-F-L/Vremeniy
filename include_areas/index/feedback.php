<? if (\Bitrix\Main\Loader::IncludeModule('yenisite.ymrs')): ?>
	<? $APPLICATION->IncludeComponent("yenisite:yandex.market_reviews_store", "main_page", array(), false); ?>
<? else: ?>
	<?$APPLICATION->IncludeComponent("bitrix:main.include", "feedback_static", array("PATH" => SITE_DIR."include_areas/index/feedback_static.php", "AREA_FILE_SHOW" => "file", "EDIT_TEMPLATE" => "include_areas_template.php"), $component, false)?>
<? endif ?>
