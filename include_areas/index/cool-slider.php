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
<?if(\Bitrix\Main\Loader::includeModule('yenisite.core'))
{
$APPLICATION->IncludeComponent("yenisite:catalog.section.proxy", "bitronic2", array(
	"SHOW_ALL_WO_SECTION" => "Y",
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => "33",
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER2" => "desc",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_GROUPS" => "N",
		"FILTER_NAME" => "arrFilter",
		"PRICE_CODE" => $arParams["PRICE_CODE"],
		"COMPONENT_TEMPLATE" => "cool_slider",
		"SECTION_CODE" => "",
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"HIDE_NOT_AVAILABLE" => "N",
		"PAGE_ELEMENT_COUNT" => "30",
		"LINE_ELEMENT_COUNT" => "3",
		"PROPERTY_CODE" => array(
			0 => "PROCESSOR",
			1 => "MEMORY_TYPE",
			2 => "",
		),
		"OFFERS_FIELD_CODE" => array(
			0 => "ID",
			1 => "",
		),
		"OFFERS_PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"OFFERS_SORT_FIELD" => "sort",
		"OFFERS_SORT_ORDER" => "asc",
		"OFFERS_SORT_FIELD2" => "id",
		"OFFERS_SORT_ORDER2" => "desc",
		"OFFERS_LIMIT" => "5",
		"SECTION_URL" => "",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"SET_TITLE" => "Y",
		"SET_BROWSER_TITLE" => "Y",
		"BROWSER_TITLE" => "-",
		"SET_META_KEYWORDS" => "Y",
		"META_KEYWORDS" => "-",
		"SET_META_DESCRIPTION" => "Y",
		"META_DESCRIPTION" => "-",
		"SET_STATUS_404" => "N",
		"CACHE_FILTER" => "Y",
		"RESIZER_SET_BIG" => "12",
		"RESIZER_SET_SMALL" => "13",
		"NEWS_COUNT" => "",
		"ACTION_VARIABLE" => "action",
		"PRODUCT_ID_VARIABLE" => "id",
		"USE_PRICE_COUNT" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"PRICE_VAT_INCLUDE" => "Y",
		"CONVERT_CURRENCY" => "N",
		"BASKET_URL" => "/personal/cart/",
		"USE_PRODUCT_QUANTITY" => "N",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRODUCT_PROPERTIES" => "",
		"OFFERS_CART_PROPERTIES" => "",
		"STORES" => $arParams["STORES"],
		"DISPLAY_COMPARE" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"DETAIL_URL" => "",
		"ADD_SECTIONS_CHAIN" => "N",
		"PAGER_TEMPLATE" => ".default",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Товары",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"DISPLAY_NAMES" => $rz_b2_options["cool_slider_show_names"],
		"SHOW_STICKERS" => $rz_b2_options["coolslider_show_stickers"]
	),
	false,
	array(
	"ACTIVE_COMPONENT" => "N"
	)
);
}