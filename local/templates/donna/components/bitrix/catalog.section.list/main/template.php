<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<?
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

$strSectionEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT");
$strSectionDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_DELETE");
$arSectionDeleteParams = array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM'));
?>

<? if (count($arResult["SECTIONS"]) > 0) : ?>
	<div class="categories">
		<div class="inner">
			<? foreach ($arResult["SECTIONS"] as $section) : ?>
				
				<?
				$this->AddEditAction($section["ID"], $section["EDIT_LINK"], $strSectionEdit);
				$this->AddDeleteAction($section["ID"], $section["DELETE_LINK"], $strSectionDelete, $arSectionDeleteParams);	
				?>

				<div class="cat-item" id="<?= $this->GetEditAreaId($section["ID"]) ?>">
					<a class="first" href="<?= $section["SECTION_PAGE_URL"] ?>">
						<img src="<?= $section["PICTURE"]["SRC"] ?>" alt="<?= $section["PICTURE"]["ALT"] ?>">
						<span class="cat-title"><?= $section["NAME"] ?></span>
					</a>

					<a class="last" href="<?= $section["SECTION_PAGE_URL"] ?>">
						<img src="<?= $section["DETAIL_PICTURE_SRC"] ?>" alt="<?= $section["PICTURE"]["ALT"] ?>">
						<span class="cat-title"><?= $section["NAME"] ?></span>
					</a>
				</div>
			<? endforeach; ?>
		</div>
	</div>
<? endif; ?>
