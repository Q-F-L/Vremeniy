<?
use Yenisite\Core\Tools;

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetPageProperty("title", "Запчасти-Самара - Запчасти для иномарок - новые и б/у. Более 25 000 автозапчастей в наличии на складе");
$APPLICATION->SetPageProperty("NOT_SHOW_NAV_CHAIN", "Y");
$APPLICATION->SetTitle("Запчасти-Самара");

global $rz_b2_options;
?>
<main class="home-page" data-page="home-page">
	<?php
	CUtil::InitJSCore();
	CJSCore::Init(["fx"]);
	CJSCore::Init(['ajax']);
	CJSCore::Init(["popup"]);
	?>
	<h1><?$APPLICATION->ShowTitle(false)?></h1>
	<?
	if($rz_b2_options['block_home-main-slider'] == 'Y' || $rz_b2_options["menu-catalog"] == "side") {
		$APPLICATION->IncludeComponent("bitrix:main.include", "", Array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR . "include_areas/index/big-slider.php", "EDIT_TEMPLATE" => "include_areas_template.php"), false, array("HIDE_ICONS" => "Y"));
	}
	
	$APPLICATION->IncludeComponent("bitrix:main.include", "", Array("AREA_FILE_SHOW" => "file",	"PATH" => SITE_DIR."include_areas/brands/brands_list.php",	"EDIT_TEMPLATE" => "include_areas_template.php"	), false, array("HIDE_ICONS"=>"N"));

	if ($rz_b2_options['block_home-catchbuy'] == 'Y') {
		$APPLICATION->IncludeComponent("bitrix:main.include", "", Array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR . "include_areas/index/catchbuy.php", "EDIT_TEMPLATE" => "include_areas_template.php"), false, array("HIDE_ICONS" => "Y"));
	}
	Tools::IncludeArea('index', 'banner_first', false, true, $rz_b2_options['block_show_ad_banners']);
	if($rz_b2_options['block_home-cool-slider'] == 'Y') {
		$APPLICATION->IncludeComponent("bitrix:main.include", "", Array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR . "include_areas/index/cool-slider.php", "EDIT_TEMPLATE" => "include_areas_template.php"), false, array("HIDE_ICONS" => "Y"));
	}
	Tools::IncludeArea('index', 'banner_second', false, true, $rz_b2_options['block_show_ad_banners']);
	if($rz_b2_options['block_home-rubric'] == 'Y') {
		$APPLICATION->IncludeComponent("bitrix:main.include", "", Array("AREA_FILE_SHOW" => "file",	"PATH" => SITE_DIR."include_areas/index/categories.php",	"EDIT_TEMPLATE" => "include_areas_template.php"	), false, array("HIDE_ICONS"=>"Y"));
	}
	if($rz_b2_options['block_home-specials'] == 'Y') {
		$APPLICATION->IncludeComponent("bitrix:main.include", "", Array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR . "include_areas/index/main_spec.php", "EDIT_TEMPLATE" => "include_areas_template.php"), false, array("HIDE_ICONS" => "Y"));
	}
	?>
	<?if ($rz_b2_options['block_home-our-adv'] == 'Y'):?>
	<div class="container hidden-xs">
		<?$APPLICATION->IncludeComponent("bitrix:main.include", "", Array("AREA_FILE_SHOW" => "file",	"PATH" => SITE_DIR."include_areas/index/benefits.php",	"EDIT_TEMPLATE" => "include_areas_template.php"	), false, array("HIDE_ICONS"=>"N"));?>
	</div>
<? endif ?>
<? if ('Y' == $rz_b2_options['block_home-feedback']): ?>
	<? Tools::IncludeArea('index', 'feedback', false, true) ?>
<? endif ?>

<div class="promo-banners container wow fadeIn">
	<?$APPLICATION->IncludeComponent("bitrix:main.include", "", Array("AREA_FILE_SHOW" => "file",	"PATH" => SITE_DIR."include_areas/index/banner1.php",	"EDIT_TEMPLATE" => "include_areas_template.php"	), false, array("HIDE_ICONS"=>"Y", "ACTIVE_COMPONENT" => $rz_b2_options['block_show_ad_banners']));?>
	<?$APPLICATION->IncludeComponent("bitrix:main.include", "", Array("AREA_FILE_SHOW" => "file",	"PATH" => SITE_DIR."include_areas/index/banner2.php",	"EDIT_TEMPLATE" => "include_areas_template.php"	), false, array("HIDE_ICONS"=>"Y", "ACTIVE_COMPONENT" => $rz_b2_options['block_show_ad_banners']));?>
</div>

<div class="text-content container wow fadeIn">
	<div class="text-content-flex">
		<div class="about">
			<?$APPLICATION->IncludeComponent("bitrix:main.include", "", Array("AREA_FILE_SHOW" => "file",	"PATH" => SITE_DIR."include_areas/index/about_title.php",	"EDIT_TEMPLATE" => "include_areas_template.php"	), false, array("HIDE_ICONS"=>"N"));?>
			<?$APPLICATION->IncludeComponent("bitrix:main.include", "", Array("AREA_FILE_SHOW" => "file",	"PATH" => SITE_DIR."include_areas/index/about_text.php",	"EDIT_TEMPLATE" => "include_areas_template.php"	), false, array("HIDE_ICONS"=>"N"));?>
		</div>
		<?if ($rz_b2_options['block_home-actions'] == 'Y'):?>
		<?Tools::IncludeArea('index', 'actions', false);?>
		<?endif?>
		<?if ($rz_b2_options['block_home-news'] == 'Y'):?>
		<?$APPLICATION->IncludeComponent("bitrix:main.include", "", Array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR . "include_areas/index/news.php", "EDIT_TEMPLATE" => "include_areas_template.php"), false, array("HIDE_ICONS" => "Y"));?>
		<?endif?>
		<?if($rz_b2_options['block_home-voting'] == 'Y'):?>
		<div class="hidden-sm hidden-xs questionnaire-wrap">
			<?$APPLICATION->IncludeComponent("bitrix:main.include", "", Array("AREA_FILE_SHOW" => "file",	"PATH" => SITE_DIR."include_areas/index/voting.php",	"EDIT_TEMPLATE" => "include_areas_template.php"	), false, array("HIDE_ICONS"=>"Y"));?>
		</div>
	<? endif ?>
</div>
<?if ($rz_b2_options['block_home-brands'] == 'Y'):?>
<div class="row brands-wrap wow fadeIn" data-brands-view-type="<?= ($rz_b2_options['brands_cloud'] == 'Y') ? 'tags' : 'carousel' ?>">
	<div class="col-sm-12">
		<?$APPLICATION->IncludeComponent("bitrix:main.include", "", Array("AREA_FILE_SHOW" => "file",	"PATH" => SITE_DIR."include_areas/index/brands.php",	"EDIT_TEMPLATE" => "include_areas_template.php"	), false, array("HIDE_ICONS"=>"Y"));?>
	</div><!-- /.col-sm-12 -->
</div><!-- /.row.brands-wrap -->
<? endif ?>
<div class="social-boxes">
	<?
	switch ('Y') {
		case $rz_b2_options['block_home-vk']:
		case $rz_b2_options['block_home-ok']:
		case $rz_b2_options['block_home-fb']:
		case $rz_b2_options['block_home-tw']:
		Tools::IncludeArea('index/social', 'header', false, false);
		default:
		break;
	}?>
	<? Tools::IncludeArea('index/social', 'vk', false, true, $rz_b2_options['block_home-vk']) ?>
	<? Tools::IncludeArea('index/social', 'ok', false, true, $rz_b2_options['block_home-ok']) ?>
	<? Tools::IncludeArea('index/social', 'fb', false, true, $rz_b2_options['block_home-fb']) ?>
	<? Tools::IncludeArea('index/social', 'tw', false, true, $rz_b2_options['block_home-tw']) ?>
</div>
</div><!-- /.text-content.container -->
</main><!-- /.home-page -->
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
