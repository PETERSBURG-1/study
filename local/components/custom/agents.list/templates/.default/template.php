<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
use Bitrix\Main\Localization\Loc;
$noAvatar = $componentPath ."/templates/.default/images/no-avatar.png";
$isActive = '';
?>
<div class="site-section site-section-sm bg-light">
      <div class="container agents-list">
        <div class="row mb-5">
          <div class="col-12">
            <div class="site-section-title">
              <h2><?=Loc::getMessage('TITLE_MAIN')?></h2>
            </div>
          </div>
        </div>
        <div class="mb-5">
        <?foreach($arResult["AGENTS"]["ITEMS"] as $arItem):?>
            <div class="agent__card">
                <div class="small-info">
                    <div class="avatar" style="background-image: url(<? echo $arItem['UF_PHOTO'] ?  : $noAvatar ?>);"></div>
                    <div class="info">
                        <div class="name"><?=$arItem['UF_FIO'];?></div>
                    </div>
                </div>
                <div class="agent__card_item">
                    <div class="agent__card_info">
                        <div class="card__info_item">
                            <div class="position"><?=GetMessage('EMAIL_AGENTS');?> </div>
                            <div class="name"><?=$arItem['UF_MAIL']?></div>
                        </div>
                        <div class="card__info_item">
                            <div class="position"><?=GetMessage('PHONE_AGENTS');?> </div>
                            <div class="name"><?=$arItem['UF_PHONE']?></div>
                        </div>
                        <div class="card__info_item">
                            <div class="position"><?=GetMessage('TYPE_ACTIVITY_AGENTS');?></div>
                            <div class="name"><?=$arItem['UF_TYPE_ACTIVITY']?></div>
                        </div>
                    </div>
                </div>
                <? if (in_array($arItem['ID'], $arResult['STAR_AGENTS'])) 
                    {
                        $isActive = 'active';
                    }
                ?>
                <a class="star <?=$isActive?>" data-id="<?=$arItem['ID']?>">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 4L14.472 9.26604L20 10.1157L16 14.2124L16.944 20L12 17.266L7.056 20L8 14.2124L4 10.1157L9.528 9.26604L12 4Z" stroke="#95929A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            </div>
            <?endforeach;?>
        </div>
        <?php
          $APPLICATION->IncludeComponent("bitrix:main.pagenavigation", "nav_agents", Array(
          "NAV_OBJECT" => $arResult["AGENTS"]["NAV_OBJECT"],
            "SEF_MODE" => "N",
            "COMPONENT_TEMPLATE" => "modern"
          ),
          $component
        );
        ?>
        
 </div></div>

     
