<?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"catalog_bottom", 
	array(
		"ROOT_MENU_TYPE" => "catalog",
		"MAX_LEVEL" => "1",
		"CHILD_MENU_TYPE" => "left",
		"USE_EXT" => "Y",
		"MENU_CACHE_TYPE" => "A",
		"MENU_CACHE_TIME" => "604800",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_CACHE_GET_VARS" => array(
		),
		"COMPONENT_TEMPLATE" => "catalog",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N"
	),
	false
);