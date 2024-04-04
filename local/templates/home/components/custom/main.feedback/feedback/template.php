<?
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();
/**
 * Bitrix vars
 *
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 * @global CMain $APPLICATION
 * @global CUser $USER
 */
?>
<div class="col-md-12 col-lg-8 mb-5">
<?if(!empty($arResult["ERROR_MESSAGE"]))
{
	foreach($arResult["ERROR_MESSAGE"] as $v)
		ShowError($v);
}
if($arResult["OK_MESSAGE"] <> '')
{
	?><div class="mf-ok-text"><?=$arResult["OK_MESSAGE"]?></div><?
}
?>

<form class="p-5 bg-white border" action="<?=POST_FORM_ACTION_URI?>" method="POST">
<?=bitrix_sessid_post()?>
		<div class="row form-group">
         	<div class="col-md-12 mb-3 mb-md-0">
		 		<label class="font-weight-bold" for="fullname"><?=GetMessage("MFT_NAME")?><?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("NAME", $arParams["REQUIRED_FIELDS"])):?><span class="mf-req">*</span><?endif?></label>
				<input type="text" id="fullname" name="user_name" class="form-control" placeholder="<?=GetMessage("MFT_NAME")?>">
			</div>
		</div>
		<div class="row form-group">
         	<div class="col-md-12">
		 		<label class="font-weight-bold" for="email"><?=GetMessage("EMAIL")?><?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("EMAIL", $arParams["REQUIRED_FIELDS"])):?><span class="mf-req">*</span><?endif?></label>
				<input type="text" id="email" name="user_email" class="form-control" placeholder="<?=GetMessage("MFT_EMAIL")?>">
			</div>
		</div>
		<div class="row form-group">
         	<div class="col-md-12">
		 		<label class="font-weight-bold" for="subject"><?=GetMessage("SUBJECT")?><?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("ENTER_SUBJECT", $arParams["REQUIRED_FIELDS"])):?><span class="mf-req">*</span><?endif?></label>
				<input type="text" id="subject" name="ENTER_SUBJECT" class="form-control" placeholder="<?=GetMessage("MFT_SUBJECT")?>">
			</div>
		</div>
		<div class="row form-group">
         	<div class="col-md-12">
		 		<label class="font-weight-bold" for="message"><?=GetMessage("MESSAGE")?><?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("MESSAGE", $arParams["REQUIRED_FIELDS"])):?><span class="mf-req">*</span><?endif?></label>
				<textarea class="form-control" name="MESSAGE" id="message" rows="5" cols="40" placeholder="<?=GetMessage("MFT_MESSAGE")?>"><?=$arResult["MESSAGE"]?></textarea>
			</div>
		</div>
	<?if($arParams["USE_CAPTCHA"] == "Y"):?>
	<div class="mf-captcha">
		<div class="mf-text"><?=GetMessage("MFT_CAPTCHA")?></div>
		<input type="hidden" name="captcha_sid" value="<?=$arResult["capCode"]?>">
		<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["capCode"]?>" width="180" height="40" alt="CAPTCHA">
		<div class="mf-text"><?=GetMessage("MFT_CAPTCHA_CODE")?><span class="mf-req">*</span></div>
		<input type="text" name="captcha_word" size="30" maxlength="50" value="">
	</div>
	<?endif;?>
	<div class="row form-group">
        <div class="col-md-12">
	<input type="hidden" name="PARAMS_HASH" value="<?=$arResult["PARAMS_HASH"]?>">
	<input type="submit" name="submit" class="btn btn-primary  py-2 px-4 rounded-0" value="<?=GetMessage("MFT_SUBMIT")?>">
	</div>
       </div>
</form>
</div>