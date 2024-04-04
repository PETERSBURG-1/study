<?
define("NEED_AUTH", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Авторизация");

?><?$APPLICATION->IncludeComponent(
	"bitrix:system.auth.form", 
	".default", 
	array(
		"FORGOT_PASSWORD_URL" => "/auth/",
		"PROFILE_URL" => "/auth/profile.php",
		"REGISTER_URL" => "/auth/registration.php",
		"SHOW_ERRORS" => "Y",
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>