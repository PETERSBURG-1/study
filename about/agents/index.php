<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Агенты");
?><?$APPLICATION->IncludeComponent(
	"custom:agents.list", 
	".default", 
	array(
		"AGENTS_COUNT" => "2",
		"CACHE_TIME" => "360000",
		"CACHE_TYPE" => "A",
		"HLBLOCK_TNAME" => "realtors",
		"COMPONENT_TEMPLATE" => ".default",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "N"
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>