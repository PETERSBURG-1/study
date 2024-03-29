<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
$price = preg_replace('/[^0-9]/', '', $arResult["DISPLAY_PROPERTIES"]["PRICE"]["VALUE"]);
$area = $arResult['DISPLAY_PROPERTIES']['TOTAL_AREA']['VALUE'];
$ruble = ' ₽';
$formatPrice = number_format($price, 0, ' ', ' ').$ruble;
?>
 <div class="site-blocks-cover overlay" style="background-image: url(<?=$arResult["DETAIL_PICTURE"]["SRC"]?>);" data-aos="fade" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center">
          <div class="col-md-10">
            <span class="d-inline-block text-white px-3 mb-3 property-offer-type rounded"><?=GetMessage('PROPERTY_DETAILS')?></span>
            <h1 class="mb-2"><?=$arResult['NAME']?></h1>
            <p class="mb-5"><strong class="h2 text-success font-weight-bold"><?=$formatPrice?></strong></p>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section site-section-sm">
      <div class="container">
        <div class="row">
          <div class="col-lg-8" style="margin-top: -150px;">
            <div class="mb-5">
              <div class="slide-one-item home-slider owl-carousel">
			  	<?if($arResult["DISPLAY_PROPERTIES"]["IMAGE_GALLERY"]["VALUE"]):?>
					<?foreach($arResult["DISPLAY_PROPERTIES"]["IMAGE_GALLERY"]["VALUE"] as $photo):?>
						<div>
							<? $img = CFile::GetFileArray($photo); ?>
							<img src="<?=$img['SRC']?>" alt="Image" class="img-fluid" alt="<?=$arResult['NAME']?>" title="<?=$arResult['NAME']?>">
						</div>
					<?endforeach;?>
				<?endif;?>
              </div>
            </div>
            <div class="bg-white">
              <div class="row mb-5">
                <div class="col-md-6">
                  <strong class="text-success h1 mb-3"><?=$formatPrice?></strong>
                </div>
                <div class="col-md-6">
                  <ul class="property-specs-wrap mb-3 mb-lg-0  float-lg-right">
				  <li>
                    <span class="property-specs"><?=GetMessage('GARAGE')?></span>
                    <span class="property-specs-number"><?=$arResult['DISPLAY_PROPERTIES']['PRECENCE_GARAGE']['VALUE']?></span>
                  </li>
                  <li>
                    <span class="property-specs"><?=GetMessage('FLOORS')?></span>
                    <span class="property-specs-number"><?=$arResult['DISPLAY_PROPERTIES']['NUMBER_FLOORS']['VALUE']?></span>
                  </li>
                  <li>
                    <span class="property-specs"><?=GetMessage('BATHROOMS')?></span>
                    <span class="property-specs-number"><?=$arResult['DISPLAY_PROPERTIES']['NUMBER_BATHROOMS']['VALUE']?></span>
                  </li>
                  <li>
                    <span class="property-specs"><?=GetMessage('AREA')?></span>
                    <span class="property-specs-number"><?=number_format($arResult['DISPLAY_PROPERTIES']['TOTAL_AREA']['VALUE'], 0, ' ', ' ')?></span>
                  </li>
                </ul>
                </div>
              </div>
              <div class="row mb-5">
                <div class="col-md-6 col-lg-3 text-left border-bottom border-top py-3">
                  <span class="d-inline-block text-black mb-0 caption-text"><?=GetMessage('HOME_TYPE')?></span>
                  <strong class="d-block"><?=$arResult['DISPLAY_PROPERTIES']['HOME_TYPE']['VALUE']?></strong>
                </div>
                <div class="col-md-6 col-lg-3 text-left border-bottom border-top py-3">
                  <span class="d-inline-block text-black mb-0 caption-text"><?=GetMessage('YEAR_BUILT')?></span>
                  <strong class="d-block"><?=$arResult['DISPLAY_PROPERTIES']['YEAR_BUILT']['VALUE']?></strong>
                </div>
                <div class="col-md-6 col-lg-3 text-left border-bottom border-top py-3">
                  <span class="d-inline-block text-black mb-0 caption-text"><?=GetMessage('PRICE_SQFT')?></span>
                  <strong class="d-block"><?=round($price/$area, 0)?></strong>
                </div>
				        <div class="col-md-6 col-lg-3 text-left border-bottom border-top py-3">
                  <span class="d-inline-block text-black mb-0 caption-text"><?=GetMessage('DATE_UPDATE')?></span>
                  <strong class="d-block">
                    <? 
                    $arResult["TIMESTAMP_X"] = ConvertDateTime($arResult["TIMESTAMP_X"], "DD.MM.YYYY", "ru"); 
                    echo $arResult["TIMESTAMP_X"]
                    ?>
                  </strong>
                </div>
              </div>
              <h2 class="h4 text-black"><?=GetMessage('MORE_INFO')?></h2>
              <?=$arResult['DETAIL_TEXT']?>

              <div class="row mt-5">
                <div class="col-12">
                  <h2 class="h4 text-black mb-3"><?=$arResult["DISPLAY_PROPERTIES"]["ADDITIONAL_MATERIALS"]["NAME"]?></h2>
                </div>
                <?if($arResult["DISPLAY_PROPERTIES"]["ADDITIONAL_MATERIALS"]["VALUE"]):?>
                  <?foreach($arResult["DISPLAY_PROPERTIES"]["ADDITIONAL_MATERIALS"]["VALUE"] as $photo):?>
                    <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                      <? $img = CFile::GetFileArray($photo); ?>
                      <a href="<?=$img['SRC']?>" class="image-popup gal-item"><img src="<?=$img['SRC']?>" alt="Image" class="img-fluid" alt="<?=$arResult["NAME"]?>" title="<?=$arResult["NAME"]?>"></a>
                    </div>
                  <?endforeach;?>
                <?endif;?>
              </div>
            </div>
            <div class="row mt-5">
                <div class="col-12">
                  <h2 class="h4 text-black mb-3"><?=$arResult["DISPLAY_PROPERTIES"]["LINKS_EXTERNAL"]["NAME"]?></h2>
                </div>
              <?if($arResult["DISPLAY_PROPERTIES"]["LINKS_EXTERNAL"]["VALUE"]):?>
                  <ul>
                  <?foreach($arResult["DISPLAY_PROPERTIES"]["LINKS_EXTERNAL"]["VALUE"] as $link):?>
                    <a href="<?=$link?>" target="_blank"><li><?=$link?></li></a>
                  <?endforeach;?>
                  </ul>
                <?endif;?>
              </div>
            </div>
		  
          <div class="col-lg-4 pl-md-5">

            <div class="bg-white widget border rounded">

              <h3 class="h4 text-black widget-title mb-3">Contact Agent</h3>
              <form action="" class="form-contact-agent">
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" id="name" class="form-control">
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" id="email" class="form-control">
                </div>
                <div class="form-group">
                  <label for="phone">Phone</label>
                  <input type="text" id="phone" class="form-control">
                </div>
                <div class="form-group">
                  <input type="submit" id="phone" class="btn btn-primary" value="Send Message">
                </div>
              </form>
            </div>

            <div class="bg-white widget border rounded">
              <h3 class="h4 text-black widget-title mb-3">Paragraph</h3>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit qui explicabo, libero nam, saepe eligendi. Molestias maiores illum error rerum. Exercitationem ullam saepe, minus, reiciendis ducimus quis. Illo, quisquam, veritatis.</p>
            </div>

          </div>
          
        </div>
      </div>
    </div>