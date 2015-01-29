<?php

namespace Extcode\WtCartProduct\Domain\Model;

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

/**
 * VariantSet
 */
class VariantSet extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * sku
	 *
	 * @var string
	 */
	protected $sku = '';

	/**
	 * title
	 *
	 * @var string
	 */
	protected $title = '';

	/**
	 * description
	 *
	 * @var string
	 */
	protected $description = '';

	/**
	 * variantAttributes
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Extcode\WtCartProduct\Domain\Model\VariantAttribute>
	 * @cascade remove
	 */
	protected $variantAttributes = NULL;

	/**
	 * Returns the sku
	 *
	 * @return string $sku
	 */
	public function getSku() {
		return $this->sku;
	}

	/**
	 * Sets the sku
	 *
	 * @param string $sku
	 * @return void
	 */
	public function setSku($sku) {
		$this->sku = $sku;
	}

	/**
	 * Returns the title
	 *
	 * @return string $title
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * Sets the title
	 *
	 * @param string $title
	 * @return void
	 */
	public function setTitle($title) {
		$this->title = $title;
	}

	/**
	 * Returns the description
	 *
	 * @return string $description
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * Sets the description
	 *
	 * @param string $description
	 * @return void
	 */
	public function setDescription($description) {
		$this->description = $description;
	}

	/**
	 * Adds a VariantAttribute
	 *
	 * @param \Extcode\WtCartProduct\Domain\Model\VariantAttribute $variantAttribute
	 * @return void
	 */
	public function addVariantAttribute(\Extcode\WtCartProduct\Domain\Model\VariantAttribute $variantAttribute) {
		$this->variantAttributes->attach($variantAttribute);
	}

	/**
	 * Removes a VariantAttribute
	 *
	 * @param \Extcode\WtCartProduct\Domain\Model\VariantAttribute $variantAttributeToRemove
	 * @return void
	 */
	public function removeVariantAttribute(\Extcode\WtCartProduct\Domain\Model\VariantAttribute $variantAttributeToRemove) {
		$this->variantAttributes->detach($variantAttributeToRemove);
	}

	/**
	 * Returns the VariantAttributes
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Extcode\WtCartProduct\Domain\Model\VariantAttribute> $variantAttribute
	 */
	public function getVariantAttributes() {
		return $this->variantAttributes;
	}

	/**
	 * Sets the VariantAttributes
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Extcode\WtCartProduct\Domain\Model\VariantAttribute> $variantAttributes
	 * @return void
	 */
	public function setVariantAttributes(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $variantAttributes) {
		$this->variantAttributes = $variantAttributes;
	}

}