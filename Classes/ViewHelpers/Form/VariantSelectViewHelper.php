<?php
namespace Extcode\WtCartProduct\ViewHelpers\Form;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2014 Daniel Lorenz <wtcartproduct@extco.de>, extco.de UG (haftungsbeschränkt)
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

class VariantSelectViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {

	/**
	 * render
	 *
	 * @param string $name
	 * @param \Extcode\WtCartProduct\Domain\Model\Product $product
	 * @return array
	 */
	public function render($name = '', \Extcode\WtCartProduct\Domain\Model\Product $product) {
		$out = '';

		$out .= '<select name="' . $name . '">';

		foreach ( $product->getVariants() as $variant ) {
			/**
			 * @var \Extcode\WtCartProduct\Domain\Model\Variant $variant
			 */

			$optionLabelArray = array();
			if ( $product->getVariantSet1() ) {
				$optionLabelArray[] = $variant->getVariantAttribute1()->getTitle();
			}
			if ( $product->getVariantSet2() ) {
				$optionLabelArray[] = $variant->getVariantAttribute2()->getTitle();
			}
			if ( $product->getVariantSet3() ) {
				$optionLabelArray[] = $variant->getVariantAttribute3()->getTitle();
			}
			$optionLabel = join(' - ', $optionLabelArray);

			$out .= '<option value="' . $variant->getUid() .'">' . $optionLabel . '</option>';
		}

		$out .= '</select>';

		return $out;
	}
}