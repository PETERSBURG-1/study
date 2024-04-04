<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Регистрация");
?><?$APPLICATION->IncludeComponent(
	"bitrix:system.auth.registration", 
	"auth_reg", 
	array(
		"COMPONENT_TEMPLATE" => "auth_reg",
		"CONFIRM_CODE" => "confirm_code",
		"LOGIN" => "login",
		"USER_ID" => "confirm_user_id",
		"USER_PROPERTY_NAME" => "",
		"USER_PROPERTY" => array(
			0 => "UF_TYPE_USER",
		)
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>