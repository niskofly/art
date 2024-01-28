<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

/** @var array $arParams */
/** @var array $arResult */


$itemIdToItemMap = [];
$sectionIdToItemsIdMap = [];

foreach ($arResult['ITEMS'] as $item) {
    $itemId = $item['ID'];
    $sectionId = $item['IBLOCK_SECTION_ID'];

    $itemIdToItemMap[$itemId] = $item;

    if (!empty($sectionId)) {
        $sectionIdToItemsIdMap[$sectionId][] = $itemId;
    }
}

$getSections = getSections($arParams['IBLOCK_ID'], $arParams['PARENT_SECTION'], $arParams['DETAIL_URL'], $arParams['SECTION_URL']);

$result = [];
foreach (reset($getSections) as $mainSection) {
    $sectionId = $mainSection['ID'];
    $item = sectionAdapter($mainSection, true);

    $sectionItems = getItemsBySectionId($sectionId, $sectionIdToItemsIdMap, $itemIdToItemMap);
    if (!empty($sectionItems)) {
        $item['ITEMS'] = $sectionItems;
    }

    if (!empty($getSections[$sectionId])) {
        $item['SECTIONS'] = array_map(static function (array $section) use ($sectionIdToItemsIdMap, $itemIdToItemMap) {
            $sectionId = $section['ID'];
            $section = sectionAdapter($section);

            $sectionItems = getItemsBySectionId($sectionId, $sectionIdToItemsIdMap, $itemIdToItemMap);
            if (!empty($sectionItems)) {
                $section['ITEMS'] = $sectionItems;
            }

            return $section;
        }, $getSections[$sectionId]);
    }


    $result[] = $item;
}


$arResult['SERVICES'] = $result;


function getItemsBySectionId(int $sectionId, array $sectionIdToItemsIdMap, array $itemIdToItemMap): array
{
    if (empty($sectionIdToItemsIdMap[$sectionId])) {
        return [];
    }

    return array_map(static function (int $itemId) use ($itemIdToItemMap) {
        return itemAdapter($itemIdToItemMap[$itemId]);
    }, $sectionIdToItemsIdMap[$sectionId]);
}


function getSections(int $iblockId, int $parentSectionId, string $detailUrl, string $sectionUrl): array {
    $result = [];

    $parentSection = $parentSectionId > 0 ? getSectionById($iblockId, $parentSectionId) : null;

    $select = ['ID', 'IBLOCK_ID', 'IBLOCK_SECTION_ID', 'CODE', 'NAME', 'DEPTH_LEVEL', 'LEFT_MARGIN', 'RIGHT_MARGIN', 'SECTION_PAGE_URL', 'ELEMENT_CNT', 'UF_BLOCK_1_PRICE'];
    $filter = ['IBLOCK_ID' => $iblockId, 'ACTIVE' => 'Y'];

    $filter_additional = !empty($parentSection) ? [
        '>=LEFT_MARGIN'  => $parentSection['LEFT_MARGIN'],
        '<=RIGHT_MARGIN' => $parentSection['RIGHT_MARGIN'],
    ] : [];

    $select_additional = !empty($parentSection) ? [
        'DESCRIPTION',
        'UF_MORE_PHOTO',
        'UF_LINK_STAFF',
        'UF_LINK_QUESTIONS',
        'UF_LINK_REVIEWS',
        'UF_BLOCK_1',
        'UF_BLOCK_2',
        'UF_BLOCK_3',
        'UF_BLOCK_4',
    ] : [];

    $resSections = CIBlockSection::GetList(['LEFT_MARGIN' => 'ASC'], array_merge($filter, $filter_additional), true, array_merge($select, $select_additional));
    $resSections->SetUrlTemplates($detailUrl, $sectionUrl, '');
    while ($section = $resSections->GetNext()) {
        $parentId = $section['IBLOCK_SECTION_ID'] ?: 0;
        $result[$parentId][] = $section;
    }

    return $result;
}

function getSectionById(int $iblockId, int $sectionId): ?array
{
    $resSections = CIBlockSection::GetList(
        [],
        ['IBLOCK_ID' => $iblockId, 'ID' => $sectionId],
        false,
        ['ID', 'IBLOCK_ID', 'CODE', 'NAME', 'LEFT_MARGIN', 'RIGHT_MARGIN', 'DEPTH_LEVEL']
    );
    if ($section = $resSections->Fetch()) {
        return $section;
    }
    return null;
}

function itemAdapter(array $item): array
{
    return [
        'ID' => $item['ID'],
        'CODE' => $item['CODE'],
        'NAME' => $item['NAME'],
        'DETAIL_PAGE_URL' => $item['DETAIL_PAGE_URL'],
        'PRICE' => $item['PROPERTIES']['BLOCK_1_PRICE']['VALUE'],
    ];
}

function sectionAdapter(array $section, bool $main = false): array
{
    $block2Text = trim($section['~UF_BLOCK_2']);
    $block3Text = trim($section['~UF_BLOCK_3']);
    $block2Picture = !empty($section['UF_BLOCK_4']) ? CFile::GetPath($section['UF_BLOCK_4']) : '';

    $result = [
        'ID' => $section['ID'],
        'CODE' => $section['CODE'],
        'NAME' => $section['NAME'],
        'SECTION_PAGE_URL' => $section['SECTION_PAGE_URL'],
        'ELEMENT_CNT' => $section['ELEMENT_CNT'],
        'LEFT_MARGIN' => $section['LEFT_MARGIN'],
        'RIGHT_MARGIN' => $section['RIGHT_MARGIN'],
        'DEPTH_LEVEL' => $section['DEPTH_LEVEL'],
        'PRICE' => $section['UF_BLOCK_1_PRICE'],
    ];

    if ($main === true) {
        $result_additional = [
            'DESCRIPTION' => $section['DESCRIPTION'],
            'MORE_PHOTO' => array_map(static function (int $photoId) {
                return CFile::GetPath($photoId);
            }, $section['UF_MORE_PHOTO']),
            'STAFF' => getItemsByIds($section['UF_LINK_STAFF'] ?? [], ['PREVIEW_PICTURE', 'PROPERTY_POST']),
            'QUESTIONS' => getItemsByIds($section['UF_LINK_QUESTIONS'] ?? [], ['PROPERTY_VOPROS', 'PROPERTY_OTVET']),
            'REVIEWS' => $section['UF_LINK_REVIEWS'],
            'BLOCK1' => !empty($block1Text) ? ['TEXT' => $block1Text, 'PRICE' => $section['UF_BLOCK_1_PRICE']] : [],
            'BLOCK2' => !empty($block2Text) ? ['TEXT' => $block2Text, 'PICTURE' => $block2Picture] : [],
            'BLOCK3' => !empty($block3Text) ? ['TEXT' => $block3Text] : [],
        ];
    }


    return array_merge($result, $result_additional ?? []);
}

function getItemsByIds(array $ids, $select_additional = []): array
{
    $result = [];
    $select = ['ID', 'IBLOCK_ID', 'NAME', 'DETAIL_PAGE_URL'];

    $resItems = CIBlockElement::GetList([],  ['ID' => $ids, 'ACTIVE' => 'Y'], false, false, array_merge($select, $select_additional));
    while ($item = $resItems->GetNext()) {

        if (!empty($item['PREVIEW_PICTURE'])) {
            $item['PREVIEW_PICTURE'] = CFile::GetPath($item['PREVIEW_PICTURE']);
        }

        $result[] = $item;
    }

    return $result;
}
