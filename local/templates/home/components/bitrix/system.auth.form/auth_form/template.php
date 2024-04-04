<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

CJSCore::Init();
CJSCore::Init(['popup']);
?>

<div class="bx-system-auth-form">
<?if($arResult["FORM_TYPE"] == "login"):?>
<a href="#" class="auth_popup">Войти на сайт</a>

<div id="hideBlock" style="display:none;">

<form name="system_auth_form<?=$arResult["RND"]?>" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">
<div class="col-md-12">
<?if($arResult["BACKURL"] <> ''):?>
	<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
<?endif?>
<?foreach ($arResult["POST"] as $key => $value):?>
	<input type="hidden" name="<?=$key?>" value="<?=$value?>" />
<?endforeach?>
	<input type="hidden" name="AUTH_FORM" value="Y" />
	<input type="hidden" name="TYPE" value="AUTH" />
			<div class="row form-group">
         	<div class="col-md-12">
		 		<label class="font-weight-bold" for="message"><?=GetMessage("AUTH_LOGIN")?>:</label>
				 <input class="form-control" type="text" name="USER_LOGIN" value="" placeholder="<?=GetMessage("AUTH_LOGIN")?>">
				 <script>
				BX.ready(function() {
					var loginCookie = BX.getCookie("<?=CUtil::JSEscape($arResult["~LOGIN_COOKIE_NAME"])?>");
					if (loginCookie)
					{
						var form = document.forms["system_auth_form<?=$arResult["RND"]?>"];
						var loginInput = form.elements["USER_LOGIN"];
						loginInput.value = loginCookie;
					}
				});
			</script>
			</div>
		</div>
		<div class="row form-group">
         	<div class="col-md-12">
		 		<label class="font-weight-bold" for="message"><?=GetMessage("AUTH_PASSWORD")?>:</label>
				 <input class="form-control" type="password" name="USER_PASSWORD" autocomplete="off" placeholder="<?=GetMessage("AUTH_PASSWORD")?>">
				 <?if($arResult["SECURE_AUTH"]):?>
				<span class="bx-auth-secure" id="bx_auth_secure<?=$arResult["RND"]?>" title="<?echo GetMessage("AUTH_SECURE_NOTE")?>" style="display:none">
					<div class="bx-auth-secure-icon"></div>
				</span>
				<noscript>
				<span class="bx-auth-secure" title="<?echo GetMessage("AUTH_NONSECURE_NOTE")?>">
					<div class="bx-auth-secure-icon bx-auth-secure-unlock"></div>
				</span>
				</noscript>
			<script type="text/javascript">
			document.getElementById('bx_auth_secure<?=$arResult["RND"]?>').style.display = 'inline-block';
			</script>
			<?endif?>
			</div>
		</div>
<?if ($arResult["STORE_PASSWORD"] == "Y"):?>
	<div class="row form-group">
         	<div class="col-md-12"><input type="checkbox" id="USER_REMEMBER_frm" name="USER_REMEMBER" value="Y" />
			<label for="USER_REMEMBER_frm" title="<?=GetMessage("AUTH_REMEMBER_ME")?>"><?echo GetMessage("AUTH_REMEMBER_SHORT")?></label>
			</div>
		</div>
<?endif?>
<?if ($arResult["CAPTCHA_CODE"]):?>
	<div class="row form-group">
         	<div class="col-md-12">
			<?echo GetMessage("AUTH_CAPTCHA_PROMT")?>:<br />
			<input type="hidden" name="captcha_sid" value="<?echo $arResult["CAPTCHA_CODE"]?>" />
			<img src="/bitrix/tools/captcha.php?captcha_sid=<?echo $arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" /><br /><br />
			<input type="text" name="captcha_word"  value="" />
			</div>
		</div>
<?endif?>
		<div class="row form-group">
        <div class="col-md-12">
			<input type="hidden" name="PARAMS_HASH" value="fdb31b817a9e277395c44dbdcedf8203">
			<input type="submit" name="Login" class="btn btn-primary  py-2 px-4 rounded-0" value="<?=GetMessage("AUTH_LOGIN_BUTTON")?>">
		</div>
 	</div>
<?if($arResult["NEW_USER_REGISTRATION"] == "Y"):?>
	<div class="row form-group">
        <div class="col-md-12"><noindex><a href="<?=$arResult["AUTH_REGISTER_URL"]?>" rel="nofollow"><?=GetMessage("AUTH_REGISTER")?></a></noindex>
			</div>
 	</div>
<?endif?>

<div class="row form-group">
        <div class="col-md-12"><noindex><a href="<?=$arResult["AUTH_FORGOT_PASSWORD_URL"]?>" rel="nofollow"><?=GetMessage("AUTH_FORGOT_PASSWORD_2")?></a></noindex>
				</div>
 	</div>
</div>	
</form>


<?
elseif($arResult["FORM_TYPE"] == "otp"):
?>

<form name="system_auth_form<?=$arResult["RND"]?>" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">
<?if($arResult["BACKURL"] <> ''):?>
	<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
<?endif?>
	<input type="hidden" name="AUTH_FORM" value="Y" />
	<input type="hidden" name="TYPE" value="OTP" />
	<table width="95%">
		<tr>
			<td colspan="2">
			<?echo GetMessage("auth_form_comp_otp")?><br />
			<input type="text" name="USER_OTP" maxlength="50" value="" size="17" autocomplete="off" /></td>
		</tr>
<?if ($arResult["CAPTCHA_CODE"]):?>
		<tr>
			<td colspan="2">
			<?echo GetMessage("AUTH_CAPTCHA_PROMT")?>:<br />
			<input type="hidden" name="captcha_sid" value="<?echo $arResult["CAPTCHA_CODE"]?>" />
			<img src="/bitrix/tools/captcha.php?captcha_sid=<?echo $arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" /><br /><br />
			<input type="text" name="captcha_word" maxlength="50" value="" /></td>
		</tr>
<?endif?>
<?if ($arResult["REMEMBER_OTP"] == "Y"):?>
		<tr>
			<td valign="top"><input type="checkbox" id="OTP_REMEMBER_frm" name="OTP_REMEMBER" value="Y" /></td>
			<td width="100%"><label for="OTP_REMEMBER_frm" title="<?echo GetMessage("auth_form_comp_otp_remember_title")?>"><?echo GetMessage("auth_form_comp_otp_remember")?></label></td>
		</tr>
<?endif?>
		<tr>
			<td colspan="2"><input type="submit" name="Login" value="<?=GetMessage("AUTH_LOGIN_BUTTON")?>" /></td>
		</tr>
		<tr>
			<td colspan="2"><noindex><a href="<?=$arResult["AUTH_LOGIN_URL"]?>" rel="nofollow"><?echo GetMessage("auth_form_comp_auth")?></a></noindex><br /></td>
		</tr>
	</table>
</form>
</div>
<?
else:
?>
<?
if ($arResult['SHOW_ERRORS'] === 'Y' && $arResult['ERROR'] && !empty($arResult['ERROR_MESSAGE']))
{
	ShowMessage($arResult['ERROR_MESSAGE']);
}
?>
<?=$arResult["USER_NAME"]?> <a href="<?=$arResult["PROFILE_URL"]?>" title="<?=GetMessage("AUTH_PROFILE")?>">[<?=$arResult["USER_LOGIN"]?>]</a>

	<a href="<?=$APPLICATION->GetCurPageParam("logout=yes&".bitrix_sessid_get(), array(
		"login",
		"logout",
		"register",
		"forgot_password",
		"change_password"));?>"><?=GetMessage("AUTH_LOGOUT_BUTTON")?></a>
<?endif?>
</div>
<script>
   window.BXDEBUG = true;
BX.ready(function(){
   var oPopup = BX.PopupWindowManager.create("popup-message", BX('block_popup'), {
      autoHide : false,
      offsetTop : 1,
      offsetLeft : 0,
      lightShadow : false,
	  padding: 20,
	  font: 0,
      closeIcon : true,
      closeByEsc : true

   });
   oPopup.setContent(BX('hideBlock'));
   BX.bindDelegate(
      document.body, 'click', {className: 'auth_popup' },
         BX.proxy(function(e){
            if(!e)
               e = window.event;
            oPopup.show();
            return BX.PreventDefault(e);
         }, oPopup)
   );
   
   
});
</script>