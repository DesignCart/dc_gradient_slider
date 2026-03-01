<?php

/**
 * @package     DC Gradient Slider (mod_dc_gslider)
 * @copyright   Copyright (C) 2025. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Uri\Uri;

$modId        = 'dc-gslider-' . $module->id;
$slides       = $slides ?? [];
$loadJquery   = (bool) $params->get('load_jquery', 0);
$gradientEn   = (bool) $params->get('gradient_enable', 0);
$arcColor     = $params->get('arc_border_color', '#27C07C');
$arcWidth     = (int) $params->get('arc_border_width', 3);
$moduleBg     = $params->get('module_bg', '#1a1a1a');
$contentPos   = $params->get('content_position', 'left');
$headingTag   = $params->get('heading_tag', 'h1');
$headingSize  = (int) $params->get('heading_font_size', 48);
$headingColor = $params->get('heading_color', '#ffffff');
$descSize     = (int) $params->get('description_font_size', 18);
$descColor    = $params->get('description_color', '#ffffff');
$btnBg        = $params->get('button_bg', '#27C07C');
$btnBgHover   = $params->get('button_bg_hover', '#22a86a');
$btnColor     = $params->get('button_color', '#ffffff');
$btnColorHover = $params->get('button_color_hover', '#ffffff');
$btnFontSize  = (int) $params->get('button_font_size', 16);

$sliderHeight = trim((string) $params->get('slider_height', '420'));
if ($sliderHeight !== '' && preg_match('/^\d+$/', $sliderHeight)) {
	$sliderHeight .= 'px';
} elseif ($sliderHeight === '') {
	$sliderHeight = '420px';
}

$posClass = 'dc-gslider-pos-' . $contentPos;

$wa = Factory::getApplication()->getDocument()->getWebAssetManager();
$modulePath = 'modules/mod_dc_gslider';
$wa->registerAndUseStyle('mod_dc_gslider.style', $modulePath . '/media/css/style.css');

if ($loadJquery) {
	$wa->useScript('jquery');
}
$wa->registerScript('slick', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', ['jquery'], ['defer' => true]);
$wa->registerStyle('slick', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css');
$wa->registerStyle('slick.theme', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css');
$wa->useScript('slick');
$wa->useStyle('slick');
$wa->useStyle('slick.theme');
$scriptDeps = ['jquery', 'slick'];
if ($gradientEn && !empty($gradientColors)) {
	$scriptDeps[] = 'granim';
}
$wa->registerAndUseScript('mod_dc_gslider.slider', $modulePath . '/media/js/slider.js', $scriptDeps, ['defer' => true]);

if ($gradientEn && !empty($gradientColors)) {
	$wa->registerScript('granim', 'https://cdn.jsdelivr.net/npm/granim@2.0.0/dist/granim.min.js', [], ['defer' => true]);
	$wa->useScript('granim');
}

$inlineCss = '#'.$modId.' { --dc-slider-height: '.$sliderHeight.'; --dc-module-bg: '.$moduleBg.'; --dc-arc-color: '.$arcColor.'; --dc-arc-width: '.$arcWidth.'px; --dc-heading-size: '.$headingSize.'px; --dc-heading-color: '.$headingColor.'; --dc-desc-size: '.$descSize.'px; --dc-desc-color: '.$descColor.'; --dc-btn-bg: '.$btnBg.'; --dc-btn-bg-hover: '.$btnBgHover.'; --dc-btn-color: '.$btnColor.'; --dc-btn-color-hover: '.$btnColorHover.'; --dc-btn-font-size: '.$btnFontSize.'px; }';
$wa->addInlineStyle($inlineCss, ['name' => 'mod_dc_gslider_'.$module->id]);

if (empty($slides)) {
	return;
}

$gradientImageUrl = '';
if ($gradientEn && !empty($gradientColors)) {
	$firstSlide = is_object($slides[0]) ? $slides[0] : (object) $slides[0];
	$firstImg   = $firstSlide->image ?? '';
	if ($firstImg) {
		$clean = HTMLHelper::_('cleanImageURL', $firstImg);
		$gradientImageUrl = $clean ? (Uri::root() . ltrim($clean->url, '/')) : '';
	}
}

$configJson = htmlspecialchars(json_encode([
	'modId' => $modId,
	'gradientEnable' => $gradientEn,
	'gradientColors' => $gradientColors ?? [],
	'gradientImageUrl' => $gradientImageUrl
]), ENT_QUOTES, 'UTF-8');
?>


<div id="<?php echo $modId; ?>" class="dc-gslider-wrapper <?php echo $posClass; ?> <?php echo htmlspecialchars($params->get('moduleclass_sfx', '')); ?>" data-dc-gslider-config="<?php echo $configJson; ?>">
	<div class="dc-gslider-inner">
		<div class="dc-gslider-slider">
			<?php $i = 0; ?>
			<?php foreach ($slides as $idx => $slide) :
				$slide = is_object($slide) ? $slide : (object) $slide;
				$heading    = $slide->heading ?? '';
				$description = $slide->description ?? '';
				$buttonText = $slide->button_text ?? '';
				$buttonLink = $slide->button_link ?? '';
				$image      = $slide->image ?? '';
				if ($image) {
					$clean = HTMLHelper::_('cleanImageURL', $image);
					$imgUrl = $clean ? (Uri::root(true) . '/' . ltrim($clean->url, '/')) : '';
				} else {
					$imgUrl = '';
				}
				$isFirstWithGradient = ($gradientEn && !empty($gradientColors));
			?>
				<div class="dc-gslider-slide">
					<?php if ($imgUrl) : ?>
						<div class="dc-gslider-slide-bg" style="background-image: url('<?php echo htmlspecialchars($imgUrl); ?>');"></div>
					<?php endif; ?>
					<?php if ($isFirstWithGradient) : ?>
						<canvas id="<?php echo $modId; ?>-granim-<?php echo $i; ?>" class="dc-gslider-gradient-canvas" data-image="<?php echo htmlspecialchars($imgUrl); ?>" aria-hidden="true"></canvas>
					<?php endif; ?>
					<div class="dc-gslider-slide-content">
						<div class="dc-gslider-content-block">
							<?php if ($heading !== '') : ?>
								<<?php echo $headingTag; ?> class="dc-gslider-heading<?php echo $headingTag === 'p' ? ' dc-gslider-heading-p' : ''; ?>"><?php echo htmlspecialchars($heading); ?></<?php echo $headingTag; ?>>
							<?php endif; ?>
							<?php if ($description !== '') : ?>
								<div class="dc-gslider-description"><?php echo $description; ?></div>
							<?php endif; ?>
							<?php if ($buttonText !== '' && $buttonLink !== '') : ?>
								<a href="<?php echo htmlspecialchars($buttonLink); ?>" class="dc-gslider-btn"><?php echo htmlspecialchars($buttonText); ?></a>
							<?php endif; ?>
						</div>
					</div>
				</div>
				<?php $i++; ?>
			<?php endforeach; ?>
		</div>
		<div class="dc-gslider-arc" role="presentation">
			<svg class="dc-gslider-arc-svg" viewBox="0 0 1440 160" preserveAspectRatio="none" aria-hidden="true">
				<!-- wypełnienie sekcji pod spodem -->
				<path d="M0,80 C360,160 1080,160 1440,80 L1440,160 L0,160 Z" fill="var(--dc-module-bg)"/>
				<!-- border tylko na łuku -->
				<path d="M0,80 C360,160 1080,160 1440,80" fill="none" stroke="var(--dc-arc-color)" stroke-width="var(--dc-arc-width)" stroke-linecap="round"/>
			</svg>
		</div>
	</div>
</div>
