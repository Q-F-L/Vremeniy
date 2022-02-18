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
	"yenisite:main_spec",
	"bitronic2",
	array(
		"IBLOCK_TYPE" => "1c_catalog",
		"IBLOCK_ID" => "96",
		"SECTION_ID" => "",
		"SECTION_CODE" => "",
		"INCLUDE_SUBSECTIONS" => "Y",
		"SHOW_ALL_WO_SECTION" => "Y",
		"HIDE_NOTAVAILABLE" => "Y",
		"HIDE_WITHOUTPICTURE" => "N",
		"STICKER_NEW" => "14",
		"STICKER_HIT" => "100",
		"STICKER_BESTSELLER" => "3",
		"DEFAULT_TAB" => "SALE",
		"TABS_INDEX" => "list",
		"IMAGE_SET" => "14",
		"ELEMENT_SORT_FIELD" => "rand",
		"ELEMENT_SORT_ORDER" => "asc",
		"LIST_PRICE_SORT" => "CATALOG_PRICE_1",
		"SHOW_ELEMENT" => "N",
		"OFFERS_FIELD_CODE" => ",",
		"OFFERS_PROPERTY_CODE" => ",",
		"OFFERS_SORT_FIELD" => "sort",
		"OFFERS_SORT_ORDER" => "asc",
		"PAGE_ELEMENT_COUNT" => "4",
		"LINE_ELEMENT_COUNT" => "4",
		"SECTION_URL" => "/catalog/#SECTION_ID#/",
		"DETAIL_URL" => "/catalog/#SECTION_ID#/zap#ELEMENT_ID#/",
		"BASKET_URL" => "/personal/cart/",
		"ACTION_VARIABLE" => "action",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"PRICE_CODE" => $arParams["PRICE_CODE"],
		"USE_PRICE_COUNT" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"PRICE_VAT_INCLUDE" => "Y",
		"USE_PRODUCT_QUANTITY" => "Y",
		"HIDE_BUY_IF_PROPS" => "N",
		"CONVERT_CURRENCY" => "N",
		"OFFERS_CART_PROPERTIES" => "",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "86400",
		"CACHE_GROUPS" => "Y",
		"META_KEYWORDS" => "-",
		"META_DESCRIPTION" => "-",
		"BROWSER_TITLE" => "-",
		"ADD_SECTIONS_CHAIN" => "N",
		"COMPARE_PATH" => SITE_DIR."ajax/compare.php",
		"SET_TITLE" => "Y",
		"SET_STATUS_404" => "N",
		"PAGER_TEMPLATE" => "indicators",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_SHOW_ALWAYS" => "Y",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"IBLOCK_MAX_VOTE" => "5",
		"IBLOCK_VOTE_NAMES" => array(
			0 => "1",
			1 => "2",
			2 => "3",
			3 => "4",
			4 => "5",
			5 => "",
		),
		"DISPLAY_AS_RATING" => "rating",
		"OFFER_TREE_PROPS" => array(
		),
		"PRODUCT_PROPERTIES" => array(
		),
		"INCLUDE_JQUERY" => "Y",
		"SHOW_AMOUNT_STORE" => "Y",
		"COMPONENT_TEMPLATE" => "bitronic2",
		"ARTICUL_PROP" => "MODEL",
		"PARTIAL_PRODUCT_PROPERTIES" => "Y",
		"STORES" => $arParams["STORES"],
		"STORE_DISPLAY_TYPE" => $rz_b2_options["store_amount_type"],
		"SB_FULL_DEFAULT" => $rz_b2_options["sb_full_default"],
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"MAIN_SP_ON_AUTO_NEW" => "Y",
		"SHOW_TABS" => array(
			0 => "NEW",
			1 => "HIT",
			2 => "SALE",
			3 => "BESTSELLER",
		),
		"TAB_PROPERTY_NEW" => "NOVINKA",
		"TAB_PROPERTY_HIT" => "HIT",
		"TAB_PROPERTY_SALE" => "SALE",
		"TAB_PROPERTY_BESTSELLER" => "BESTSELLER",
		"TAB_SORT_NEW" => "100",
		"TAB_SORT_HIT" => "200",
		"TAB_SORT_SALE" => "300",
		"TAB_SORT_BESTSELLER" => "400",
		"TAB_TEXT_NEW" => "Новинки",
		"TAB_TEXT_HIT" => "Хиты продаж",
		"TAB_TEXT_SALE" => "Суперцена",
		"TAB_TEXT_BESTSELLER" => "Рекомендуем",
		"DISPLAY_FAVORITE" => "N",
		"DISPLAY_ONECLICK" => "N",
		"HIDE_ICON_SLIDER" => "N",
		"RESIZER_SECTION_ICON" => "5",
		"BLOCK_VIEW_MODE" => "",
		"COLOR_SCHEME" => "",
		"IMAGE_SET_BIG" => "",
		"PRODUCT_DISPLAY_MODE" => "",
		"USE_MOUSEWHEEL" => "",
		"DISPLAY_COMPARE" => "",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
);