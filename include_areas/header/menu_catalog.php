<? global $rz_b2_options; ?>
<? $arParams["PRICE_CODE"] = 'BASE';
if (!empty($rz_b2_options['GEOIP']['PRICES'])) {
	$arParams["PRICE_CODE"] = $rz_b2_options['GEOIP']['PRICES'];
}
$arParams['STORES'] = NULL;
if (!empty($rz_b2_options['GEOIP']['STORES'])) {
	$arParams['STORES'] = $rz_b2_options['GEOIP']['STORES'];
}
?>
<? $APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"catalog", 
	array(
		"ROOT_MENU_TYPE" => "catalog",
		"MAX_LEVEL" => "2",
		"CHILD_MENU_TYPE" => "",
		"USE_EXT" => "Y",
		"MENU_CACHE_TYPE" => "A",
		"MENU_CACHE_TIME" => "604800",
		"MENU_CACHE_USE_GROUPS" => "N",
		"MENU_CACHE_GET_VARS" => array(
		),
		"VIEW_HIT" => $rz_b2_options["block_main-menu-elem"],
		"HITS_POSITION" => $rz_b2_options["menu-hits-position"],
		"SHOW_ICONS" => $rz_b2_options["menu-show-icons"],
		"ICON_RESIZER_SET" => "8",
		"RESIZER_SET" => "14",
		"CACHE_SELECTED_ITEMS" => "N",
		"PRICE_CODE" => $arParams["PRICE_CODE"],
		"COMPONENT_TEMPLATE" => "catalog",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N",
		"HITS_COMPONENT" => "CATALOG",
		"HITS_TYPE" => "SHOW",
		"SLIDERS_HIDE_NOT_AVAILABLE" => "N",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"TITLE" => ""
	),
	false
);