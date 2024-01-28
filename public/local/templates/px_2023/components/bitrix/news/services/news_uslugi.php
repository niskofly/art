<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
global $APPLICATION;

$APPLICATION->SetPageProperty("description", "Стоматология АРТ в Одинцово уже много лет занимается лечением зубов у взрослых. Услуги и цены можно посмотреть на сайте artistom.ru");
$APPLICATION->SetPageProperty("title", "Стоматология в Одинцово - цены на услуги, стоимость приема");
$APPLICATION->SetTitle("Услуги стоматологии в Одинцово");

$APPLICATION->SetAdditionalCSS("/include/services/detail/price.css");
$APPLICATION->SetAdditionalCSS("/include/services_template.css");


// GET ROOT SECTS
$ibId = 20;
$rsSects = CIBlockSection::getList(['SORT' => 'ASC'], ['IBLOCK_ID' => $ibId, 'DEPTH_LEVEL' => 1, 'ACTIVE' => 'Y'], false, ['ID', 'NAME', 'CODE', 'SECTION_PAGE_URL'], false);


// GET CHILD SERVICES
function getServices($sectId, $ibId)
{
  $rsSects = CIBlockSection::GetList(
    ['SORT' => 'ASC'],
    ['IBLOCK_ID' => $ibId, 'SECTION_ID' => $sectId, 'ACTIVE' => 'Y', 'DEPTH_LEVEL ' => 1],
    false,
    ['ID', 'NAME', 'SECTION_PAGE_URL', 'IBLOCK_ID', 'UF_MIN_PRICE'],
    false
  );
  while ($arSect = $rsSects->GetNext()) {
    $arServices['HAS_SECTIONS'] = 'Y';
    $arServices['ITEMS'][$arSect['ID']] = [
      'SECTION_PAGE_URL' => $arSect['SECTION_PAGE_URL'],
      'NAME' => $arSect['NAME'],
      'TYPE' => 'SECT',
      'MIN_PRICE' => getMinPriceForSectServices($arSect['ID'], $ibId, $arSect['UF_MIN_PRICE']),
      'CHILDREN' => getServices($arSect['ID'], $ibId),
    ];
  }
  $rsEls = CIBlockElement::GetList(
    ['SORT' => 'ASC'],
    ['IBLOCK_ID' => $ibId, 'SECTION_ID' => $sectId, 'ACTIVE' => 'Y', 'DEPTH_LEVEL ' => 1],
    false,
    false,
    ['ID', 'NAME', 'DETAIL_PAGE_URL', 'IBLOCK_ID', 'PROPERTY_PRICE', 'PROPERTY_PRICE_OLD', 'PROPERTY_PRICE_FROM']
  );
  //$arServices= [];
  while ($arEl = $rsEls->GetNext()) {
    $arServices['ITEMS'][$arEl['ID']] = [
      'DETAIL_PAGE_URL' => $arEl['DETAIL_PAGE_URL'],
      'NAME' => $arEl['NAME'],
      'PRICE' => $arEl['PROPERTY_PRICE_VALUE'],
      'PRICE_OLD' => $arEl['PROPERTY_PRICE_OLD_VALUE'],
      'PRICE_FROM' => $arEl['PROPERTY_PRICE_FROM_VALUE'],
      'TYPE' => 'ELEM',
    ];
  }
  return $arServices;
}

// SET PRICE FORMAT
function priceFormat($price)
{
  return number_format($price, 0, ',', '&nbsp;');
}

// GET MIN PRICE FOR ROOT SECT
function getMinPriceForSectServices($sectId, $ibId, $ufMinPrice)
{

  if ($ufMinPrice > 0) return $ufMinPrice;

  $minPrice = 0;
  $rsEls = CIBlockElement::GetList(
    [],
    ['IBLOCK_ID' => $ibId, 'SECTION_ID' => $sectId, 'ACTIVE' => 'Y'],
    false,
    false,
    ['ID', 'PROPERTY_PRICE', 'IBLOCK_ID']
  );
  while ($arEl = $rsEls->fetch()) {
    if (($arEl['PROPERTY_PRICE_VALUE'] > 0 && $arEl['PROPERTY_PRICE_VALUE'] < $minPrice) || $minPrice == 0) $minPrice = $arEl['PROPERTY_PRICE_VALUE'];
  }
  return $minPrice;
}

?>


<div class="row">
  <div class="col-md-3 col-sm-3 hidden-xs hidden-sm left-menu-md">
    <? CMedc2::ShowPageType('left_block') ?>
  </div>
  <div class="col-md-9 col-sm-12 col-xs-12 content-md">
    <div class="detail services">

      <? $APPLICATION->IncludeFile("/uslugi/main_top_text.php", array()); ?>

      <?
      while ($arSect = $rsSects->getNext()) {
        buildRootSectPrice($arSect, $ibId);
      }
      function buildRootSectPrice($arSect, $ibId)
      {
        $arServices = getServices($arSect['ID'], $ibId);
      ?>
        <div class="price-block">
          <h2 class="price-block_title" id="<?= $arSect['CODE'] ?>">
            <a href="<?= $arSect['SECTION_PAGE_URL'] ?>"><?= $arSect['NAME'] ?></a>
          </h2>
          <? $i = 0;
          foreach ($arServices['ITEMS'] as $arSrv) {
            if ($arSrv['TYPE'] != 'SECT') continue;
            $i++;
          ?>
            <details class="shadow1" <? if (/*$i*/1 == 1) { ?> open<? } ?>>
              <summary><a href="<?= $arSrv['SECTION_PAGE_URL'] ?>" class="price-title">
                  <span><?= $arSrv['NAME'] ?></span></a>

                <? if (intval($arSrv['MIN_PRICE']) > 0) { ?>
                  <span class="price-of">от <?= priceFormat($arSrv['MIN_PRICE']); ?> &#8381;</span>
                <? } ?>

              </summary>
              <ul class="price-list">
                <? foreach ($arSrv['CHILDREN']['ITEMS'] as $arChild) {
                  if ($arChild['TYPE'] != 'ELEM') continue; ?>
                  <li>
                    <a href="<?= $arChild['DETAIL_PAGE_URL'] ?>"><span class="price-list_title"><?= $arChild['NAME'] ?></span></a>
                    <? if ($arChild['PRICE_OLD'] > 0) { ?>
                      <div class="price-list_price">
                        <span class="price-list_price__old">
                          <?= priceFormat($arChild['PRICE_OLD']); ?> &#8381;
                        </span>
                        <span class="price-list_price__new">
                          <?= priceFormat($arChild['PRICE']); ?> &#8381;
                        </span>
                      </div>
                    <? } else if (intval($arChild['PRICE']) > 0) { ?>
                      <span class="price-list_price">
                        <? if ($arChild['PRICE_FROM'] == 'Да') echo ' от'; ?>
                        <?= priceFormat($arChild['PRICE']); ?> &#8381;
                      </span>
                    <? } ?>
                  </li>
                <? } ?>
              </ul>
              <div class="buttons">
                <div class="btn-entry">
                  <a class="animate-load" href="#" data-event="jqm" data-param-id="18" data-name="record_online">Записаться на приём</a>
                </div>
                <div class="btn-online">
                  <div class="btn-online_title">Получить консультацию:</div>
                  <div class="btn-online_buttons">

                    <?/*<a href="#" class="btn-online_buttons-online animate-load" data-event="jqm" data-param-id="18" data-name="record_online">Онлайн</a>*/ ?>

                    <a href="javascript:void(0);" class="btn-online_buttons-online animate-load js-click-open-jivosite">Онлайн</a>

                    <a href="" class="btn-online_buttons-telegram">
                      <svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M17.9717 35.9434C27.8972 35.9434 35.9434 27.8972 35.9434 17.9717C35.9434 8.0462 27.8972 0 17.9717 0C8.0462 0 0 8.0462 0 17.9717C0 27.8972 8.0462 35.9434 17.9717 35.9434Z" fill="url(#paint0_linear)" />
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M14.6767 26.2088C14.0945 26.2088 14.1935 25.9889 13.9927 25.4346L12.2805 19.7998L25.4598 11.9812" fill="#C8DAEA" />
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M14.6768 26.2087C15.1261 26.2087 15.3246 26.0032 15.5753 25.7594L17.9716 23.4294L14.9826 21.627" fill="#A9C9DD" />
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M14.9825 21.6274L22.2251 26.9783C23.0516 27.4343 23.6481 27.1982 23.854 26.211L26.8021 12.3184C27.1039 11.1083 26.3408 10.5594 25.5501 10.9184L8.2389 17.5935C7.05725 18.0675 7.06414 18.7267 8.02351 19.0205L12.466 20.407L22.7507 13.9185C23.2362 13.6241 23.6818 13.7824 23.3161 14.107" fill="url(#paint1_linear)" />
                        <defs>
                          <linearGradient id="paint0_linear" x1="13.4806" y1="1.49884" x2="4.49472" y2="22.4646" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#37AEE2" />
                            <stop offset="1" stop-color="#1E96C8" />
                          </linearGradient>
                          <linearGradient id="paint1_linear" x1="15.7221" y1="19.0756" x2="17.6423" y2="25.287" gradientUnits="userSpaceOnUse">
                            <stop stop-color="#EFF7FC" />
                            <stop offset="1" stop-color="white" />
                          </linearGradient>
                        </defs>
                      </svg>
                    </a>
                    <a href="" class="btn-online_buttons-viber">
                      <svg width="37" height="36" viewBox="0 0 37 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M18.915 0.000102997C28.8405 0.000102997 36.8867 8.0463 36.8867 17.9718C36.8867 27.8973 28.8405 35.9435 18.915 35.9435C8.98956 35.9435 0.943359 27.8973 0.943359 17.9718C0.943359 8.0463 8.98956 0.000102997 18.915 0.000102997Z" fill="#7F4DA0" />
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M23.7031 15.6941C23.6156 14.984 23.3974 14.4264 23.0098 13.9325C22.5065 13.2966 21.8633 12.9157 20.911 12.6898C20.2904 12.5393 20.0397 12.5565 19.8152 12.7616C19.6062 12.9537 19.5654 13.3387 19.7251 13.5881C19.8375 13.7691 19.9671 13.8339 20.3276 13.9047C20.8077 13.993 21.1395 14.1076 21.4413 14.2802C22.0818 14.6501 22.3801 15.2289 22.4121 16.1659C22.427 16.6059 22.465 16.7411 22.6187 16.8972C22.9035 17.1824 23.4104 17.1269 23.6254 16.7856C23.7043 16.6569 23.7163 16.6009 23.7246 16.3022C23.7301 16.1172 23.7222 15.8419 23.7031 15.6941Z" fill="white" />
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M26.212 16.4947C26.0855 14.3191 25.2346 12.5688 23.7116 11.3372C22.8536 10.6453 21.8164 10.1694 20.6795 9.93801C20.263 9.85524 19.4963 9.78816 19.3647 9.82653C19.2406 9.86206 19.065 9.99647 18.9868 10.118C18.904 10.2498 18.8854 10.5441 18.9559 10.7143C19.0699 10.9989 19.2819 11.0995 19.8755 11.1514C20.7906 11.2315 21.7345 11.553 22.4477 12.029C23.2619 12.5709 23.9091 13.3122 24.3279 14.1832C24.6896 14.9316 24.9121 16.0101 24.906 16.9759C24.9039 17.3253 24.9579 17.5225 25.0983 17.6667C25.3104 17.8885 25.6195 17.937 25.8922 17.7897C26.1946 17.6307 26.2653 17.3516 26.212 16.4947Z" fill="white" />
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M28.9883 24.8731C28.9457 24.7487 28.8464 24.5569 28.7755 24.4468C28.3286 23.7719 25.9273 21.8927 24.7284 21.2781C24.0439 20.9265 23.5367 20.8093 23.1607 20.9193C22.7564 21.0331 22.5435 21.2213 21.8661 22.0632C21.593 22.4007 21.3128 22.7169 21.2383 22.7666C21.0538 22.8944 20.6921 22.9975 20.4367 22.9975C19.8443 22.9939 18.7696 22.6103 17.9432 22.1058C17.3012 21.7151 16.4783 21.0153 15.847 20.3226C15.1021 19.5091 14.5949 18.7916 14.1941 17.9816C13.6762 16.9408 13.545 16.3049 13.7613 15.8396C13.8146 15.7224 13.8855 15.5981 13.9174 15.5589C13.9493 15.5235 14.2828 15.2499 14.6516 14.9515C15.3752 14.3761 15.4922 14.2446 15.627 13.8503C15.7973 13.3494 15.7512 12.8379 15.4887 12.3228C15.2865 11.932 14.758 11.0795 14.375 10.5289C13.8678 9.80427 12.6051 8.25546 12.3532 8.04582C11.8992 7.67642 11.3175 7.61244 10.6755 7.86115C9.99809 8.12403 8.72825 9.14708 8.18556 9.8611C7.69608 10.5076 7.50815 10.9658 7.47975 11.5697C7.45494 12.067 7.49748 12.2731 7.75996 12.9089C9.81364 17.8964 12.8781 21.8785 17.0884 25.0401C19.2875 26.6919 21.5681 27.9494 23.9339 28.8091C25.3137 29.3099 25.9131 29.3348 26.6189 28.9227C26.9169 28.7451 27.6546 27.9885 28.0661 27.4379C28.7471 26.5213 28.9989 26.0986 29.0699 25.7612C29.1195 25.5303 29.0805 25.1289 28.9883 24.8731Z" fill="white" />
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M28.7663 16.9943C28.7209 15.7637 28.5137 14.7543 28.0816 13.6288C27.6551 12.5218 27.2234 11.7994 26.4081 10.8223C25.6373 9.90619 25.0386 9.3831 24.089 8.80083C22.7643 7.98956 21.1521 7.4527 19.3453 7.22691C18.7292 7.148 18.5898 7.15364 18.4008 7.27977C18.0344 7.51871 18.0393 8.11468 18.4068 8.35003C18.5284 8.4249 18.6364 8.45217 19.1292 8.51668C19.8858 8.61855 20.3723 8.71454 20.9496 8.87205C23.2133 9.49086 24.9541 10.7557 26.1179 12.6334C27.0918 14.1984 27.4961 15.7635 27.4387 17.7625C27.4187 18.4383 27.4332 18.5572 27.5365 18.7196C27.7344 19.0222 28.2561 19.0821 28.5237 18.8309C28.6902 18.6779 28.7216 18.563 28.7544 17.9846C28.7702 17.6829 28.7735 17.2375 28.7663 16.9943Z" fill="white" />
                      </svg>
                    </a>
                    <a href="" class="btn-online_buttons-whatsapp">
                      <svg width="37" height="36" viewBox="0 0 37 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M18.8584 35.9434C28.7839 35.9434 36.8301 27.8972 36.8301 17.9717C36.8301 8.0462 28.7839 0 18.8584 0C8.93292 0 0.886719 8.0462 0.886719 17.9717C0.886719 27.8972 8.93292 35.9434 18.8584 35.9434Z" fill="#25D366" />
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M19.4506 27.9703H19.4462C17.6577 27.9697 15.9003 27.5209 14.3394 26.6696L8.67432 28.1556L10.1904 22.618C9.2552 20.9973 8.76311 19.1589 8.76391 17.2754C8.76626 11.3833 13.5602 6.5896 19.4505 6.5896C22.3093 6.59083 24.9925 7.70374 27.0101 9.72372C29.0277 11.7436 30.1382 14.4285 30.1371 17.2839C30.1347 23.1747 25.3427 27.9679 19.4506 27.9703ZM14.6019 24.7349L14.9263 24.9274C16.29 25.7367 17.8533 26.1649 19.4471 26.1655H19.4507C24.3463 26.1655 28.3309 22.1809 28.3328 17.2832C28.3337 14.9099 27.4107 12.6783 25.7338 10.9994C24.0568 9.32044 21.8266 8.39538 19.4542 8.39456C14.5548 8.39456 10.5702 12.3788 10.5683 17.276C10.5676 18.9544 11.0372 20.5889 11.9263 22.003L12.1375 22.3391L11.2402 25.6168L14.6019 24.7349ZM24.8345 19.8251C24.7678 19.7137 24.5898 19.6469 24.3228 19.5131C24.0558 19.3795 22.743 18.7336 22.4982 18.6444C22.2535 18.5553 22.0754 18.5108 21.8974 18.7781C21.7194 19.0453 21.2077 19.6469 21.0519 19.8251C20.8961 20.0032 20.7404 20.0256 20.4735 19.8919C20.2064 19.7582 19.3461 19.4763 18.3261 18.5666C17.5323 17.8585 16.9964 16.9841 16.8407 16.7168C16.6849 16.4495 16.8241 16.305 16.9577 16.1719C17.0779 16.0522 17.2248 15.8599 17.3583 15.704C17.4918 15.5482 17.5363 15.4367 17.6253 15.2586C17.7143 15.0803 17.6698 14.9245 17.603 14.7908C17.5363 14.6571 17.0023 13.3428 16.7798 12.8081C16.563 12.2875 16.3429 12.358 16.179 12.3498C16.0234 12.342 15.8452 12.3403 15.6672 12.3403C15.4892 12.3403 15.1999 12.4071 14.9552 12.6745C14.7104 12.9418 14.0206 13.5878 14.0206 14.902C14.0206 16.2164 14.9774 17.4861 15.1109 17.6643C15.2444 17.8426 16.9938 20.5396 19.6724 21.6962C20.3095 21.9713 20.8068 22.1356 21.1946 22.2586C21.8343 22.4619 22.4164 22.4332 22.8764 22.3645C23.3895 22.2878 24.4562 21.7186 24.6789 21.0949C24.9012 20.471 24.9012 19.9364 24.8345 19.8251Z" fill="#FDFDFD" />
                      </svg>
                    </a>
                  </div>
                </div>
              </div>
            </details>
          <? } ?>
          <ul class="price-list">
            <? foreach ($arServices['ITEMS'] as $srvKey => $arSrv) {
              if ($arSrv['TYPE'] != 'ELEM') continue; ?>
              <li>
                <a href="<?= $arSrv['DETAIL_PAGE_URL'] ?>"><span class="price-list_title"><?= $arSrv['NAME'] ?></span></a>
                <? if ($arSrv['PRICE_OLD'] > 0) { ?>
                  <div class="price-list_price">
                    <span class="price-list_price__old">
                      <?= priceFormat($arSrv['PRICE_OLD']); ?>&nbsp;&#8381;
                    </span>
                    <span class="price-list_price__new">
                      <?= priceFormat($arSrv['PRICE']); ?>&nbsp;&#8381;
                    </span>
                  </div>
                <? } else if (intval($arSrv['PRICE']) > 0) { ?>
                  <span class="price-list_price">
                    <? if ($arSrv['PRICE_FROM'] == 'Да') echo ' от'; ?>&nbsp;<?= priceFormat($arSrv['PRICE']); ?>&nbsp;&#8381;
                  </span>
                <? } ?>
              </li>
            <? } ?>
          </ul>
        </div>
      <? } ?>
    </div>

  </div>
</div>