<?php
    /**
     * @package     DC Gradient Slider
     * @subpackage  Content Plugin
     * @author      Design Cart
     * @copyright   Copyright (C) 2025 Design Cart. All rights reserved.
     * @license     GNU General Public License version 3 or later; see LICENSE.txt
     *
     * This file is part of DC Gradient Slider.
     *
     * DC Gradient Slider is free software: you can redistribute it and/or modify
     * it under the terms of the GNU General Public License as published by
     * the Free Software Foundation, either version 3 of the License, or
     * (at your option) any later version.
     *
     * DC Gradient Slider is distributed in the hope that it will be useful,
     * but WITHOUT ANY WARRANTY; without even the implied warranty of
     * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
     * GNU General Public License for more details.
     *
     * You should have received a copy of the GNU General Public License
     * along with DC Gradient Slider. If not, see <https://www.gnu.org/licenses/>.
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
