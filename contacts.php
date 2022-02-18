<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Контакты - Запчасти Самара");
$APPLICATION->SetTitle("Контакты");
?><main class="container about-page">
<div class="row">
	<div class="col-xs-12">
		<h1><?$APPLICATION->ShowTitle()?></h1>


        <!---->
        <div itemscope itemtype="http://schema.org/Organization">
            <span itemprop="name">Автозапчасти Самара - интернет-магазин и авторазбор</span>
            <br/><br/>
            <div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
                Адрес:
                <span itemprop="addressLocality">г. Самара</span>,
                <span itemprop="streetAddress">ул. Дзержинского, 46В</span>
            </div>
            <br/>
            Телефон:<a href="tel:+78462770583"><span itemprop="telephone">+7 (846) 277-0583</span></a><br/>
            E-mail: <span itemprop="email">info@запчасти-самара.рф</span>
        </div>
        <br/><br/>
        <!---->

		<div>
			 <?$APPLICATION->IncludeComponent(
	"bitrix:map.google.view", 
	".default", 
	array(
		"MAP_WIDTH" => "AUTO",
		"OPTIONS" => array(
			0 => "ENABLE_SCROLL_ZOOM",
			1 => "ENABLE_DRAGGING",
		),
		"COMPONENT_TEMPLATE" => ".default",
		"API_KEY" => "",
		"INIT_MAP_TYPE" => "ROADMAP",
		"MAP_DATA" => "a:3:{s:10:\"google_lat\";s:7:\"55.7383\";s:10:\"google_lon\";s:7:\"37.5946\";s:12:\"google_scale\";i:13;}",
		"MAP_HEIGHT" => "500",
		"CONTROLS" => array(
			0 => "SMALL_ZOOM_CONTROL",
			1 => "TYPECONTROL",
			2 => "SCALELINE",
		),
		"MAP_ID" => "",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false,
	array(
		"ACTIVE_COMPONENT" => "N"
	)
);?>
		</div>
		<div>
			 <?$APPLICATION->IncludeComponent(
	"bitrix:map.yandex.view",
	".default",
	Array(
		"COMPONENT_TEMPLATE" => ".default",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"CONTROLS" => array(0=>"ZOOM",1=>"SMALLZOOM",2=>"MINIMAP",3=>"TYPECONTROL",4=>"SCALELINE",),
		"INIT_MAP_TYPE" => "MAP",
		"MAP_DATA" => "a:4:{s:10:\"yandex_lat\";d:53.18348781973878;s:10:\"yandex_lon\";d:50.17428915704197;s:12:\"yandex_scale\";i:16;s:10:\"PLACEMARKS\";a:1:{i:0;a:3:{s:3:\"LON\";d:50.175106440475;s:3:\"LAT\";d:53.183807833608;s:4:\"TEXT\";s:81:\"Запчасти Самара###RN###Самара, Дзержинского, 46В\";}}}",
		"MAP_HEIGHT" => "500",
		"MAP_ID" => "",
		"MAP_WIDTH" => "AUTO",
		"OPTIONS" => array(0=>"ENABLE_SCROLL_ZOOM",1=>"ENABLE_DRAGGING",)
	)
);?>
		</div>
		 <?if (CModule::IncludeModule('simai.maps2gis')): ?>
		<div>
			 <?$APPLICATION->IncludeComponent(
	"simai:maps.2gis.simple",
	"",
	Array(
		"MAP_WIDTH" => "AUTO"
	)
);?>
		</div>
		 <?endif?>
	</div>
</div>
 </main><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php")?>