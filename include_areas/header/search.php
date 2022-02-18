<?
global $rz_b2_options;
$arParams = array(
	'PRICE_CODE' => array('BASE'),
	'STORES' => NULL
);
if(!empty($rz_b2_options['GEOIP']['PRICES'])) {
	$arParams["PRICE_CODE"] = $rz_b2_options['GEOIP']['PRICES'];
}
if(!empty($rz_b2_options['GEOIP']['STORES'])) {
	$arParams['STORES'] = $rz_b2_options['GEOIP']['STORES'];
}

?>
<?$APPLICATION->IncludeComponent(
	"bitrix:search.title", 
	"bitronic2", 
	array(
		"NUM_CATEGORIES" => "2",
		"TOP_COUNT" => "5",
		"CHECK_DATES" => "N",
		"SHOW_OTHERS" => "N",
		"PAGE" => "/catalog/",
		"CATEGORY_0_TITLE" => "Товары",
		"CATEGORY_0" => array(
			0 => "iblock_1c_catalog",
		),
		"CATEGORY_0_iblock_catalog" => array(
			0 => "all",
		),
		"CATEGORY_1_TITLE" => "Новости",
		"CATEGORY_1" => array(
			0 => "iblock_news",
		),
		"CATEGORY_1_iblock_catalog" => array(
			0 => "all",
		),
		"CATEGORY_OTHERS_TITLE" => "Другое",
		"SHOW_INPUT" => "N",
		"CONTAINER_ID" => "search",
		"INPUT_ID" => "search-field",
		"PRICE_CODE" => $arParams["PRICE_CODE"],
		"SHOW_PREVIEW" => "Y",
		"PREVIEW_WIDTH" => "75",
		"PREVIEW_HEIGHT" => "75",
		"CONVERT_CURRENCY" => "N",
		"ORDER" => "date",
		"USE_LANGUAGE_GUESS" => "N",
		"RESIZER_SEARCH_TITLE" => "10",
		"PRICE_VAT_INCLUDE" => "Y",
		"PREVIEW_TRUNCATE_LEN" => "",
		"CURRENCY_ID" => "RUB",
		"COMPONENT_TEMPLATE" => "bitronic2",
		"EXAMPLE_ENABLE" => "Y",
		"EXAMPLES" => array(
			0 => "Абсорбер заднего бампера",
			1 => "Абсорбер Kia Sportage  3",
			2 => "Бампер задний Toyota RAV4",
			3 => "Бампер передний Kia Ceed",
			4 => "Противотуманная фара CRV 3",
			5 => "",
		),
		"STORES" => $arParams["STORES"],
		"SHOW_CATEGORY_SWITCH" => ($rz_b2_options["block_search_category"]!=="N"?"Y":"N"),
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"CATEGORY_0_iblock_1c_catalog" => array(
		),
		"CATEGORY_1_iblock_news" => array(
			0 => "all",
		)
	),
	false
);