<?
/**
 * Bitrix Framework
 * @package bitrix
 * @subpackage main
 * @copyright 2001-2014 Bitrix
 */

/**
 * Bitrix vars
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 */

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if($arResult["SHOW_SMS_FIELD"] == true)
{
	CJSCore::Init('phone_auth');
}
?>

<div class="bx-auth">
<?if($USER->IsAuthorized()):?>

<p><?echo GetMessage("MAIN_REGISTER_AUTH")?></p>
<?else:?>
<?
if (!empty($arParams["~AUTH_RESULT"]))
{
	ShowMessage($arParams["~AUTH_RESULT"]);
}
?>
<?if($arResult["SHOW_EMAIL_SENT_CONFIRMATION"]):?>
	<p><?echo GetMessage("AUTH_EMAIL_SENT")?></p>
<?endif;?>

<?if(!$arResult["SHOW_EMAIL_SENT_CONFIRMATION"] && $arResult["USE_EMAIL_CONFIRMATION"] === "Y"):?>
	<p><?echo GetMessage("AUTH_EMAIL_WILL_BE_SENT")?></p>
<?endif?>
<noindex>

<?if($arResult["SHOW_SMS_FIELD"] == true):?>
	
<form method="post" action="<?=$arResult["AUTH_URL"]?>" name="regform">
<input type="hidden" name="SIGNED_DATA" value="<?=htmlspecialcharsbx($arResult["SIGNED_DATA"])?>" />
<table class="data-table bx-registration-table">
	<tbody>
		<tr>
			<td><span class="starrequired">*</span><?echo GetMessage("main_register_sms_code")?></td>
			<td><input size="30" type="text" name="SMS_CODE" value="<?=htmlspecialcharsbx($arResult["SMS_CODE"])?>" autocomplete="off" /></td>
		</tr>
	</tbody>
	<tfoot>
		<tr>
			<td></td>
			<td><input type="submit" name="code_submit_button" value="<?echo GetMessage("main_register_sms_send")?>" /></td>
		</tr>
	</tfoot>
</table>
</form>

<script>
new BX.PhoneAuth({
	containerId: 'bx_register_resend',
	errorContainerId: 'bx_register_error',
	interval: <?=$arResult["PHONE_CODE_RESEND_INTERVAL"]?>,
	data:
		<?=CUtil::PhpToJSObject([
			'signedData' => $arResult["SIGNED_DATA"],
		])?>,
	onError:
		function(response)
		{
			var errorDiv = BX('bx_register_error');
			var errorNode = BX.findChildByClassName(errorDiv, 'errortext');
			errorNode.innerHTML = '';
			for(var i = 0; i < response.errors.length; i++)
			{
				errorNode.innerHTML = errorNode.innerHTML + BX.util.htmlspecialchars(response.errors[i].message) + '<br>';
			}
			errorDiv.style.display = '';
		}
});
</script>

<div id="bx_register_error" style="display:none"><?ShowError("error")?></div>

<div id="bx_register_resend"></div>


<?elseif(!$arResult["SHOW_EMAIL_SENT_CONFIRMATION"]):?>
<div class="col-md-12 col-lg-8 mb-5">
<form class="p-5 bg-white border" method="post" action="<?=$arResult["AUTH_URL"]?>" name="bform" enctype="multipart/form-data">
	<input type="hidden" name="AUTH_FORM" value="Y" />
	<input type="hidden" name="TYPE" value="REGISTRATION" />

	<b><?=GetMessage("AUTH_REGISTER")?></b>
	<div class="row form-group">
         	<div class="col-md-12 mb-3 mb-md-0">
		 		<b><?=GetMessage("AUTH_NAME")?></b>
				<input type="text" id="user_name" value="<?=$arResult["USER_NAME"]?>" name="USER_NAME" class="form-control" maxlength="50" placeholder="<?=GetMessage("AUTH_NAME")?>">
			</div>
		</div>
		<div class="row form-group">
         	<div class="col-md-12 mb-3 mb-md-0">
		 		<b><?=GetMessage("AUTH_LAST_NAME")?></b>
				<input type="text" id="user_last_name" value="<?=$arResult["USER_LAST_NAME"]?>" name="USER_LAST_NAME" maxlength="50" class="form-control" placeholder="<?=GetMessage("AUTH_LAST_NAME")?>">
			</div>
		</div>
		<div class="row form-group">
         	<div class="col-md-12 mb-3 mb-md-0">
		 		<b><?=GetMessage("AUTH_LOGIN_MIN")?></b>
				<input type="text" id="auth_login_min" value="<?=$arResult["USER_LOGIN"]?>" name="USER_LOGIN" maxlength="50" class="form-control" placeholder="<?=GetMessage("AUTH_LOGIN_MIN")?>">
			</div>
		</div>
		<div class="row form-group">
         	<div class="col-md-12 mb-3 mb-md-0">
		 		<b><?=GetMessage("AUTH_PASSWORD_REQ")?></b>
				<input type="password" id="auth_password_req" maxlength="255" value="<?=$arResult["USER_PASSWORD"]?>" name="USER_PASSWORD" class="form-control" placeholder="<?=GetMessage("AUTH_PASSWORD_REQ")?>" autocomplete="off">
			</div>
		</div>
		<?if($arResult["SECURE_AUTH"]):?>
				<span class="bx-auth-secure" id="bx_auth_secure" title="<?echo GetMessage("AUTH_SECURE_NOTE")?>" style="display:none">
					<div class="bx-auth-secure-icon"></div>
				</span>
				<noscript>
				<span class="bx-auth-secure" title="<?echo GetMessage("AUTH_NONSECURE_NOTE")?>">
					<div class="bx-auth-secure-icon bx-auth-secure-unlock"></div>
				</span>
				</noscript>
			<script type="text/javascript">
			document.getElementById('bx_auth_secure').style.display = 'inline-block';
			</script>
			<?endif?>
		<div class="row form-group">
         	<div class="col-md-12 mb-3 mb-md-0">
		 		<b><?=GetMessage("AUTH_CONFIRM")?></b>
				<input type="password" id="auth_confirm" maxlength="255" value="<?=$arResult["USER_CONFIRM_PASSWORD"]?>" name="USER_CONFIRM_PASSWORD" class="form-control" placeholder="<?=GetMessage("AUTH_CONFIRM")?>" autocomplete="off">
			</div>
		</div>

<?if($arResult["EMAIL_REGISTRATION"]):?>
	<div class="row form-group">
         	<div class="col-md-12 mb-3 mb-md-0">
		 		<b><?=GetMessage("AUTH_EMAIL")?></b>
				<input type="text" id="email_required" maxlength="255" value="<?=$arResult["USER_EMAIL"]?>" name="USER_EMAIL" class="form-control" placeholder="<?=GetMessage("AUTH_EMAIL")?>">
			</div>
		</div>
<?endif?>

<b><?=GetMessage("TYPE_USER")?></b>
<div class="row form-group">
         	<div class="col-md-12 mb-3 mb-md-0">
			<label class="font-weight-bold" for="buyer">
				<input type="radio" id="buyer" maxlength="50" value="0" name="UF_TYPE_USER" checked="checked" placeholder="<?=GetMessage("CHOICE_BUYER")?>">
				<?=GetMessage("CHOICE_BUYER")?>
			</label>
			<label class="font-weight-bold" for="seller">
				<input type="radio" id="seller" maxlength="50" value="1" name="UF_TYPE_USER" placeholder="<?=GetMessage("CHOICE_SELLER")?>">
				<?=GetMessage("CHOICE_SELLER")?>
			</label>
			</div>
		</div>

<?// ********************* User properties ***************************************************?>
<?if($arResult["USER_PROPERTIES"]["SHOW"] == "Y"):?>
	<tr><td colspan="2"><?=trim($arParams["USER_PROPERTY_NAME"]) <> '' ? $arParams["USER_PROPERTY_NAME"] : GetMessage("USER_TYPE_EDIT_TAB")?></td></tr>
	<?foreach ($arResult["USER_PROPERTIES"]["DATA"] as $FIELD_NAME => $arUserField):?>
	<tr><td><?if ($arUserField["MANDATORY"]=="Y"):?><span class="starrequired">*</span><?endif;
		?><?=$arUserField["EDIT_FORM_LABEL"]?>:</td><td>
			<?$APPLICATION->IncludeComponent(
				"bitrix:system.field.edit",
				$arUserField["USER_TYPE"]["USER_TYPE_ID"],
				array("bVarsFromForm" => $arResult["bVarsFromForm"], "arUserField" => $arUserField, "form_name" => "bform"), null, array("HIDE_ICONS"=>"Y"));?></td></tr>
	<?endforeach;?>
<?endif;?>
<?// ******************** /User properties ***************************************************

	/* CAPTCHA */
	if ($arResult["USE_CAPTCHA"] == "Y")
	{
		?>
		<b><?=GetMessage("CAPTCHA_REGF_TITLE")?></b>
		<div class="row form-group">
         	<div class="col-md-12 mb-3 mb-md-0">
			 	<input type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />
				<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" />
			</div>
		</div>
		<div class="row form-group">
         	<div class="col-md-12 mb-3 mb-md-0">
			 <span class="starrequired">*</span><?=GetMessage("CAPTCHA_REGF_PROMT")?>:
			 <input type="text" name="captcha_word" maxlength="50" value="" autocomplete="off" class="form-control"/>
			</div>
		</div>
		<?
	}
	/* CAPTCHA */
	?>
				<?$APPLICATION->IncludeComponent("bitrix:main.userconsent.request", "",
					array(
						"ID" => COption::getOptionString("main", "new_user_agreement", ""),
						"IS_CHECKED" => "Y",
						"AUTO_SAVE" => "N",
						"IS_LOADED" => "Y",
						"ORIGINATOR_ID" => $arResult["AGREEMENT_ORIGINATOR_ID"],
						"ORIGIN_ID" => $arResult["AGREEMENT_ORIGIN_ID"],
						"INPUT_NAME" => $arResult["AGREEMENT_INPUT_NAME"],
						"REPLACE" => array(
							"button_caption" => GetMessage("AUTH_REGISTER"),
							"fields" => array(
								rtrim(GetMessage("AUTH_NAME"), ":"),
								rtrim(GetMessage("AUTH_LAST_NAME"), ":"),
								rtrim(GetMessage("AUTH_LOGIN_MIN"), ":"),
								rtrim(GetMessage("AUTH_PASSWORD_REQ"), ":"),
								rtrim(GetMessage("AUTH_EMAIL"), ":"),
							)
						),
					)
				);?>

	<div class="row form-group">
		<div class="col-md-12">
			<input type="submit" name="Register" value="<?=GetMessage("AUTH_REGISTER")?>" class="btn btn-primary  py-2 px-4 rounded-0">
		</div>
	</div>

</form>
</div>
<p><?echo $arResult["GROUP_POLICY"]["PASSWORD_REQUIREMENTS"];?></p>
<p><span class="starrequired">*</span><?=GetMessage("AUTH_REQ")?></p>



<script type="text/javascript">
document.bform.USER_NAME.focus();
</script>

<?endif?>

</noindex>
<?endif?>
</div>
