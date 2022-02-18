<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Каталог");

global $rz_b2_options;
$arParams = array(
	'PRICE_CODE' => array('Отпускная цена'),
	'STORES' => NULL
);
if(!empty($rz_b2_options['GEOIP']['PRICES'])) {
	$arParams["PRICE_CODE"] = $rz_b2_options['GEOIP']['PRICES'];
}
if(!empty($rz_b2_options['GEOIP']['STORES'])) {
	$arParams['STORES'] = $rz_b2_options['GEOIP']['STORES'];
}

?><?$APPLICATION->IncludeComponent(
	"bitrix:catalog", 
	".default", 
	array(
		"IBLOCK_TYPE" => "1c_catalog",
		"IBLOCK_ID" => "96",
		"HIDE_NOT_AVAILABLE" => "N",
		"TEMPLATE_THEME" => "",
		"SHOW_DISCOUNT_PERCENT" => "N",
		"SHOW_OLD_PRICE" => "Y",
		"DETAIL_SHOW_MAX_QUANTITY" => "N",
		"MESS_BTN_BUY" => "Купить",
		"MESS_BTN_ADD_TO_BASKET" => "В корзину",
		"MESS_BTN_COMPARE" => "Сравнение",
		"MESS_BTN_DETAIL" => "Подробнее",
		"MESS_NOT_AVAILABLE" => "Нет в наличии",
		"DETAIL_USE_VOTE_RATING" => "N",
		"DETAIL_USE_COMMENTS" => "Y",
		"DETAIL_BRAND_USE" => "Y",
		"DETAIL_BRAND_PROP_CODE" => "",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SEF_MODE" => "Y",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"SET_STATUS_404" => "Y",
		"SET_TITLE" => "Y",
		"ADD_SECTIONS_CHAIN" => "Y",
		"ADD_ELEMENT_CHAIN" => "N",
		"USE_ELEMENT_COUNTER" => "Y",
		"USE_SALE_BESTSELLERS" => "Y",
		"USE_FILTER" => "Y",
		"FILTER_VIEW_MODE" => "VERTICAL",
		"USE_REVIEW" => "Y",
		"MESSAGES_PER_PAGE" => "10",
		"USE_CAPTCHA" => "Y",
		"FORUM_ID" => "1",
		"REVIEWS_MODE" => "forum",
		"USE_COMPARE" => "Y",
		"COMPARE_PATH" => SITE_DIR."ajax/compare.php",
		"PRICE_CODE" => $arParams["PRICE_CODE"],
		"USE_PRICE_COUNT" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"PRICE_VAT_INCLUDE" => "N",
		"PRICE_VAT_SHOW_VALUE" => "N",
		"CONVERT_CURRENCY" => "N",
		"BASKET_URL" => "/personal/cart/",
		"ACTION_VARIABLE" => "action",
		"PRODUCT_ID_VARIABLE" => "id",
		"USE_PRODUCT_QUANTITY" => "Y",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PARTIAL_PRODUCT_PROPERTIES" => "Y",
		"PRODUCT_PROPERTIES" => array(
		),
		"SECTION_COUNT_ELEMENTS" => "N",
		"HIDE_STORE_LIST" => "Y",
		"SECTION_TOP_DEPTH" => "3",
		"SECTIONS_VIEW_MODE" => "LIST",
		"SECTIONS_SHOW_PARENT_NAME" => "Y",
		"PAGE_ELEMENT_COUNT" => "30",
		"LINE_ELEMENT_COUNT" => "3",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_FIELD2" => "shows",
		"ELEMENT_SORT_ORDER2" => "asc",
		"LIST_PROPERTY_CODE" => array(
			0 => "CML2_ARTICLE",
			1 => "SOSTOYANIE",
			2 => "KATEGORIYA",
			3 => "TIP_ZAPCHASTI",
			4 => "MODEL",
			5 => "SROK_POSTAVKI",
			6 => "KOD_DETALI",
			7 => "KOD_DETALI_ANALOG",
			8 => "",
		),
		"INCLUDE_SUBSECTIONS" => "Y",
		"LIST_META_KEYWORDS" => "-",
		"LIST_META_DESCRIPTION" => "-",
		"LIST_BROWSER_TITLE" => "-",
		"DETAIL_META_KEYWORDS" => "-",
		"DETAIL_META_DESCRIPTION" => "-",
		"DETAIL_BROWSER_TITLE" => "-",
		"DETAIL_DISPLAY_NAME" => "Y",
		"DETAIL_DETAIL_PICTURE_MODE" => "IMG",
		"DETAIL_ADD_DETAIL_TO_SLIDER" => "Y",
		"DETAIL_DISPLAY_PREVIEW_TEXT_MODE" => "H",
		"LINK_IBLOCK_TYPE" => "bbs_ads",
		"LINK_IBLOCK_ID" => "421",
		"LINK_PROPERTY_SID" => "",
		"LINK_ELEMENTS_URL" => "link.php?PARENT_ELEMENT_ID=#ELEMENT_ID#",
		"USE_ALSO_BUY" => "N",
		"USE_STORE" => "Y",
		"PAGER_TEMPLATE" => "arrows",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Автозапчасти",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"ADD_PICT_PROP" => "-",
		"LABEL_PROP" => "-",
		"PRODUCT_DISPLAY_MODE" => "Y",
		"OFFER_ADD_PICT_PROP" => "MORE_PHOTO",
		"OFFER_TREE_PROPS" => array(
			0 => "COLOR_REF",
			1 => "RAM_REF",
		),
		"OFFERS_CART_PROPERTIES" => "",
		"LIST_OFFERS_FIELD_CODE" => array(
			0 => "ID",
			1 => "",
		),
		"LIST_OFFERS_PROPERTY_CODE" => array(
			0 => "COLOR_REF",
			1 => "RAM_REF",
			2 => "",
		),
		"LIST_OFFERS_LIMIT" => "0",
		"DETAIL_OFFERS_FIELD_CODE" => array(
			0 => "ID",
			1 => "",
		),
		"DETAIL_OFFERS_PROPERTY_CODE" => array(
			0 => "COLOR_REF",
			1 => "RAM_REF",
			2 => "",
			3 => "",
		),
		"OFFERS_SORT_FIELD" => "sort",
		"OFFERS_SORT_ORDER" => "asc",
		"OFFERS_SORT_FIELD2" => "id",
		"OFFERS_SORT_ORDER2" => "asc",
		"SEF_FOLDER" => "/catalog/",
		"FILTER_GROUP_FEATURES" => "",
		"FILTER_GROUP_LOCALITY" => "",
		"FILTER_GROUP_EXTRA" => "",
		"RESIZER_SECTION" => "8",
		"RESIZER_SECTION_VIP" => "8",
		"RESIZER_DETAIL_SMALL" => "8",
		"RESIZER_DETAIL_BIG" => "8",
		"RESIZER_DETAIL_ICON" => "8",
		"RESIZER_BANNER_ACTION" => "8",
		"RESIZER_IMG_STORE" => "8",
		"AJAX_OPTION_ADDITIONAL" => "",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"LIST_PRICE_SORT" => "CATALOG_PRICE_7",
		"DEFAULT_ELEMENT_SORT_BY" => "PRICE",
		"DEFAULT_ELEMENT_SORT_ORDER" => "ASC",
		"FILTER_NAME" => "",
		"FILTER_FIELD_CODE" => ",",
		"FILTER_PROPERTY_CODE" => ",",
		"FILTER_PRICE_CODE" => "",
		"FILTER_OFFERS_FIELD_CODE" => ",",
		"FILTER_OFFERS_PROPERTY_CODE" => ",",
		"DETAIL_BLOG_USE" => "Y",
		"DETAIL_BLOG_URL" => "b2_catalog_comments",
		"DETAIL_BLOG_EMAIL_NOTIFY" => "N",
		"DETAIL_VK_USE" => "N",
		"DETAIL_FB_USE" => "N",
		"BLOG_EMAIL_NOTIFY" => "N",
		"COMPARE_NAME" => "CATALOG_COMPARE_LIST",
		"COMPARE_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"COMPARE_PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"COMPARE_ELEMENT_SORT_FIELD" => "shows",
		"COMPARE_ELEMENT_SORT_ORDER" => "asc",
		"DISPLAY_ELEMENT_SELECT_BOX" => "N",
		"DETAIL_CHECK_SECTION_ID_VARIABLE" => "N",
		"COMPARE_OFFERS_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"COMPARE_OFFERS_PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"USE_STORE_PHONE" => "N",
		"USE_STORE_SCHEDULE" => "N",
		"USE_MIN_AMOUNT" => "Y",
		"MIN_AMOUNT" => "10",
		"STORE_PATH" => "/store/#store_id#",
		"MAIN_TITLE" => "Наличие на складах",
		"COMPONENT_TEMPLATE" => ".default",
		"STICKER_NEW" => "14",
		"RESIZER_SECTION_LVL0" => "8",
		"FILTER_VISIBLE_PROPS_COUNT" => "7",
		"DETAIL_FEEDBACK_USE" => "Y",
		"SHOW_TOP_ELEMENTS" => "Y",
		"TOP_ELEMENT_COUNT" => "9",
		"TOP_LINE_ELEMENT_COUNT" => "3",
		"TOP_ELEMENT_SORT_FIELD" => "sort",
		"TOP_ELEMENT_SORT_ORDER" => "asc",
		"TOP_ELEMENT_SORT_FIELD2" => "id",
		"TOP_ELEMENT_SORT_ORDER2" => "desc",
		"TOP_PROPERTY_CODE" => ",",
		"TOP_OFFERS_FIELD_CODE" => ",",
		"TOP_OFFERS_PROPERTY_CODE" => ",",
		"TOP_OFFERS_LIMIT" => "5",
		"HIDE_SHOW_ALL_BUTTON" => "Y",
		"STORES" => array(
			0 => "",
			1 => $arParams["STORES"],
			2 => "",
		),
		"USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SHOW_EMPTY_STORE" => "Y",
		"SHOW_GENERAL_STORE_INFORMATION" => "N",
		"ARTICUL_PROP" => "CML2_ARTICLE",
		"FEEDBACK_IBLOCK_TYPE" => "feedback",
		"FEEDBACK_IBLOCK_ID" => "#FEEDBACK_IBLOCK_ID#",
		"RESIZER_DETAIL_PROP" => "8",
		"RESIZER_DETAIL_FLY_BLOCK" => "8",
		"USE_GIFTS_DETAIL" => "Y",
		"USE_GIFTS_SECTION" => "N",
		"USE_GIFTS_MAIN_PR_SECTION_LIST" => "Y",
		"GIFTS_DETAIL_PAGE_ELEMENT_COUNT" => "10",
		"GIFTS_DETAIL_HIDE_BLOCK_TITLE" => "N",
		"GIFTS_DETAIL_BLOCK_TITLE" => "Выберите подарок (при покупке товара выше)",
		"GIFTS_DETAIL_TEXT_LABEL_GIFT" => "Я подарок",
		"GIFTS_SECTION_LIST_PAGE_ELEMENT_COUNT" => "10",
		"GIFTS_SECTION_LIST_HIDE_BLOCK_TITLE" => "N",
		"GIFTS_SECTION_LIST_BLOCK_TITLE" => "Подарки к товарам этого раздела",
		"GIFTS_SECTION_LIST_TEXT_LABEL_GIFT" => "Подарок",
		"GIFTS_SHOW_DISCOUNT_PERCENT" => "Y",
		"GIFTS_SHOW_OLD_PRICE" => "Y",
		"GIFTS_SHOW_NAME" => "Y",
		"GIFTS_SHOW_IMAGE" => "Y",
		"GIFTS_MESS_BTN_BUY" => "Выбрать",
		"GIFTS_MAIN_PRODUCT_DETAIL_PAGE_ELEMENT_COUNT" => "10",
		"GIFTS_MAIN_PRODUCT_DETAIL_HIDE_BLOCK_TITLE" => "N",
		"GIFTS_MAIN_PRODUCT_DETAIL_BLOCK_TITLE" => "Выберите один из товаров, чтобы получить подарок",
		"SECTION_BANNER_AREA_1" => "",
		"SECTION_BANNER_AREA_2" => "",
		"ELEMENT_BANNER_AREA_0" => "",
		"ELEMENT_BANNER_AREA_1" => "",
		"ELEMENT_BANNER_AREA_2" => "",
		"ELEMENT_BANNER_AREA_3" => "",
		"ELEMENT_BANNER_AREA_4" => "",
		"ELEMENT_BANNER_AREA_5" => "",
		"DETAIL_FOUND_CHEAP" => "Y",
		"DETAIL_PRICE_LOWER" => "Y",
		"PROP_FOR_BANNER" => "-",
		"PROP_FOR_DISCOUNT" => "-",
		"IBLOCK_ACTIONS_TYPE" => "catalog",
		"IBLOCK_ACTIONS_ID" => "",
		"USE_ACTIONS_FUNCTIONAL" => "Y",
		"ADV_BANNER_TYPE" => "-",
		"HIDE_NOT_AVAILABLE_OFFERS" => "Y",
		"SLIDERS_HIDE_NOT_AVAILABLE" => "N",
		"BIGDATA_BESTSELL_TITLE" => "Лидеры продаж",
		"BIGDATA_PERSONAL_TITLE" => "Рекомендуем вам",
		"HIDE_ITEMS_NOT_AVAILABLE" => "N",
		"VALUE_RZ_AVAILABLE" => "",
		"HIDE_ITEMS_ZER_PRICE" => "N",
		"HIDE_ITEMS_WITHOUT_IMG" => "N",
		"DISPLAY_FAVORITE" => "Y",
		"DISPLAY_ONECLICK" => "N",
		"ELEMENT_SORT_FIELD" => "",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"DETAIL_STRICT_SECTION_CHECK" => "N",
		"DETAIL_PROPERTY_CODE" => "",
		"SET_LAST_MODIFIED" => "N",
		"REVIEW_AJAX_POST" => "",
		"PATH_TO_SMILE" => "",
		"URL_TEMPLATES_READ" => "",
		"SHOW_LINK_TO_FORUM" => "",
		"MAIN_SP_ON_AUTO_NEW" => "Y",
		"TAB_PROPERTY_NEW" => "NEW",
		"TAB_PROPERTY_HIT" => "HIT",
		"TAB_PROPERTY_SALE" => "SALE",
		"TAB_PROPERTY_BESTSELLER" => "BESTSELLER",
		"RESIZER_SECTION_ICON" => "8",
		"RESIZER_SUBSECTION" => "8",
		"RESIZER_QUICK_VIEW" => "8",
		"RESIZER_COMMENT_AVATAR" => "8",
		"RESIZER_SET_CONTRUCTOR" => "8",
		"RESIZER_RECOMENDED" => "8",
		"RESIZER_FILTER" => "8",
		"TOP_VIEW_MODE" => "",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"FILTER_DISPLAY_ELEMENT_COUNT" => "N",
		"FILTER_HIDE_DISABLED_VALUES" => "Y",
		"FILTER_SHOW_NAME_FIELD" => "Y",
		"USE_OWN_REVIEW" => "Y",
		"DETAIL_YM_API_USE" => "N",
		"COMPARE_META_H1" => "Что лучше: #TEXT# ?",
		"COMPARE_META_TITLE" => "Что лучше купить: #TEXT# ?",
		"COMPARE_META_KEYWORDS" => "Сравнение #TEXT#",
		"COMPARE_META_DESCRIPTION" => "Сравнение #TEXT#",
		"SECTIONS_START_COLUMNS" => "4",
		"SECTION_BACKGROUND_IMAGE" => "-",
		"ELEMENT_SORT_FIELD_CUSTOM" => "SCALED_PRICE_7",
		"ELEMENT_SORT_ORDER_CUSTOM" => "asc",
		"LIST_SORT_PROPS" => array(
		),
		"HIDE_ICON_SLIDER" => "N",
		"SHOW_DESCRIPTION_TOP" => "Y",
		"SHOW_DESCRIPTION_BOTTOM" => "N",
		"VIP_ITEM_PROPERTY" => "-",
		"LIST_BRAND_USE" => "Y",
		"LIST_BRAND_PROP_CODE" => "BRANDS_REF",
		"SECTION_SHOW_HITS" => "Y",
		"SECTION_HITS_RCM_TYPE" => "bestsell",
		"SECTION_HITS_HIDE_NOT_AVAILABLE" => "Y",
		"DETAIL_SET_CANONICAL_URL" => "N",
		"DETAIL_BACKGROUND_IMAGE" => "-",
		"SHOW_DEACTIVATED" => "N",
		"MANUAL_PROP" => "MANUAL",
		"SETTINGS_HIDE" => array(
			0 => "KHIT_PRODAZH",
			1 => "NOVINKA",
			2 => "VID",
			3 => "CML2_MANUFACTURER",
			4 => "CML2_TRAITS",
			5 => "CML2_TAXES",
			6 => "STRANA",
			7 => "CML2_ATTRIBUTES",
			8 => "CML2_BAR_CODE",
			9 => "PROIZVODITEL",
			10 => "POKOLENIE_EN",
			11 => "POKOLENIE_RU",
			12 => "TIP",
			13 => "TIP_DETALI",
			14 => "MODEL_GOD",
			15 => "MODEL_RAZDEL",
			16 => "POLNOE_NAIMENOVANIE",
			17 => "GODY_VYPUSKA_SPISOK",
		),
		"DETAIL_TITLE_TAB_VIDEO" => "Видеообзоры",
		"DETAIL_TITLE_TAB_STORES" => "Магазины",
		"DETAIL_TITLE_TAB_REVIEWS" => "Отзывы о товаре",
		"DETAIL_TITLE_TAB_DOCUMENTATION" => "Документация",
		"DETAIL_TITLE_TAB_CHARACTERISTICS" => "Характеристики",
		"DETAIL_TITLE_CHARISTICS_HEADER" => "Технические характеристики",
		"DETAIL_CNT_ELEMENTS_IN_SLIDERS" => "10",
		"DETAIL_SIMILAR_PRICE_PERCENT" => "20",
		"DETAIL_SIMILAR_PRICE_SMART_FILTER" => "N",
		"DETAIL_SIMILAR_PRICE_WITH_EMPTY_PROPS" => "N",
		"DETAIL_SIMILAR_PRICE_PROPERTIES" => array(
		),
		"DETAIL_ACCESSORIES_TITLE" => "Не забудьте добавить к заказу",
		"DETAIL_SIMILAR_TITLE" => "Похожие товары",
		"DETAIL_SIMILAR_VIEW_TITLE" => "Просматриваемые с этим товаром",
		"DETAIL_SIMILAR_PRICE_TITLE" => "Похожие товары",
		"DETAIL_RECOMMENDED_TITLE" => "Рекомендуемые вместе с этим товаром",
		"DETAIL_VIEWED_TITLE" => "Вы смотрели",
		"BRAND_DETAIL" => SITE_DIR."brands/#ID#/",
		"DETAIL_HIDE_ACCESSORIES" => "N",
		"DETAIL_HIDE_SIMILAR" => "N",
		"DETAIL_HIDE_SIMILAR_VIEW" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => "",
		"COMPATIBLE_MODE" => "Y",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
		"DETAIL_SET_VIEWED_IN_COMPONENT" => "N",
		"BIGDATA_SECTION" => "Y",
		"RESIZER_REVIEWS_IMG" => "8",
		"IBLOCK_REVIEWS_TYPE" => "news",
		"IBLOCK_REVIEWS_ID" => "1",
		"PROP_FOR_REVIEWS_ITEM" => "-",
		"COUNT_REVIEWS_ITEM" => "5",
		"REVIEWS_TRUNCATE_LEN" => "100",
		"TITLE_TAB_REVIEWS_ITEM" => "Обзоры",
		"TYPE_3D" => "REVIEW3",
		"TYPE_SEARCH" => "Y",
		"TYPE_SEARCH_BY" => "SHT_CODE",
		"USER_CONSENT" => "N",
		"USER_CONSENT_ID" => "0",
		"USER_CONSENT_IS_CHECKED" => "Y",
		"USER_CONSENT_IS_LOADED" => "N",
		"SEF_URL_TEMPLATES" => array(
			"sections" => "",
			"section" => "#SECTION_ID#/",
			"element" => "#SECTION_ID#/zap#ELEMENT_ID#/",
			"compare" => "compare/#QUERY#/?action=#ACTION_CODE#",
			"smart_filter" => "#SECTION_CODE#/filter/#SMART_FILTER_PATH#/apply/",
		),
		"VARIABLE_ALIASES" => array(
			"compare" => array(
				"ACTION_CODE" => "action",
			),
		)
	),
	false
);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>