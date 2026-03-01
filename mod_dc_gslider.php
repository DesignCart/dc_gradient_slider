<?php

/**
 * @package     DC Gradient Slider (mod_dc_gslider)
 * @copyright   Copyright (C) 2025. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Helper\ModuleHelper;

$slidesRaw = $params->get('slides', []);

if (is_string($slidesRaw)) {
	$decoded = json_decode($slidesRaw, true);
	$slides  = is_array($decoded) ? $decoded : [];
} elseif (is_object($slidesRaw)) {
	$slides = (array) $slidesRaw;
} elseif (is_array($slidesRaw)) {
	$slides = $slidesRaw;
} else {
	$slides = [];
}

$gradientColors = [];

if ($params->get('gradient_enable') && $params->get('gradient_colors')) {
    $rowsRaw = $params->get('gradient_colors', []);

    // Normalizacja do tablicy
    if (is_string($rowsRaw)) {
        $decoded = json_decode($rowsRaw, true);
        $rows = is_array($decoded) ? $decoded : [];
    } elseif (is_object($rowsRaw)) {
        $rows = (array) $rowsRaw;
    } elseif (is_array($rowsRaw)) {
        $rows = $rowsRaw;
    } else {
        $rows = [];
    }

    foreach ($rows as $row) {
        $c1 = is_object($row) ? ($row->color1 ?? '') : ($row['color1'] ?? '');
        $c2 = is_object($row) ? ($row->color2 ?? '') : ($row['color2'] ?? '');
        if ($c1 !== '' && $c2 !== '') {
            $gradientColors[] = [$c1, $c2];
        }
    }
}

require ModuleHelper::getLayoutPath('mod_dc_gslider', $params->get('layout', 'default'));
