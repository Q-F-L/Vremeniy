<?
$APPLICATION->IncludeComponent(
	"bitrix:system.auth.form", 
	"modal", 
	array(
		"REGISTER_URL" => "/personal/?register=yes",
		"FORGOT_PASSWORD_URL" => "/personal/profile/",
		"PROFILE_URL" => "/personal/profile/",
		"SHOW_ERRORS" => "Y",
		"RESIZER_USER_AVA_ICON" => "9"
	),
	false
);