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
 * Variant
 */
class Variant extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * Product
	 *
	 * @var \Extcode\WtCartProduct\Domain\Model\Product
	 */
	protected $product = NULL;

	/**
	 * Variant Attribute 1
	 *
	 * @var \Extcode\WtCartProduct\Domain\Model\VariantAttribute
	 */
	protected $variantAttribute1 = NULL;

	/**
	 * Variant Attribute 2
	 *
	 * @var \Extcode\WtCartProduct\Domain\Model\VariantAttribute
	 */
	protected $variantAttribute2 = NULL;

	/**
	 * Variant Attribute 3
	 *
	 * @var \Extcode\WtCartProduct\Domain\Model\VariantAttribute
	 */
	protected $variantAttribute3 = NULL;

	/**
	 * Price
	 *
	 * @var float
	 */
	protected $price = 0.0;

	/**
	 * Price Measure
	 *
	 * @var float
	 */
	protected $priceMeasure = 0.0;

	/**
	 * Price Measure Unit
	 *
	 * @var string
	 */
	protected $priceMeasureUnit = '';

	/**
	 * stock
	 *
	 * @var int
	 */
	protected $stock = 0;

	/**
	 * Returns the Product
	 *
	 * @return \Extcode\WtCartProduct\Domain\Model\Product
	 */
	public function getProduct() {
		return $this->product;
	}

	/**
	 * Returns the Variant Attribute 1
	 *
	 * @return Tx_WtCartProduct_Domain_Model_VariantAttribute
	 */
	public function getVariantAttribute1() {
		return $this->variantAttribute1;
	}

	/**
	 * Sets the Variant Attribute 1
	 *
	 * @param \Extcode\WtCartProduct\Domain\Model\VariantAttribute $variantAttribute1
	 * @return void
	 */
	public function setVariantAttribute1(\Extcode\WtCartProduct\Domain\Model\VariantAttribute $variantAttribute1) {
		$this->variantAttribute1 = $variantAttribute1;
	}

	/**
	 * Returns the Variant Attribute 2
	 *
	 * @return \Extcode\WtCartProduct\Domain\Model\VariantAttribute
	 */
	public function getVariantAttribute2() {
		return $this->variantAttribute2;
	}

	/**
	 * Sets the Variant Attribute 2
	 *
	 * @param \Extcode\WtCartProduct\Domain\Model\VariantAttribute $variantAttribute2
	 * @return void
	 */
	public function setVariantAttribute2(\Extcode\WtCartProduct\Domain\Model\VariantAttribute $variantAttribute2) {
		$this->variantAttribute2 = $variantAttribute2;
	}

	/**
	 * Returns the Variant Attribute 3
	 *
	 * @return \Extcode\WtCartProduct\Domain\Model\VariantAttribute
	 */
	public function getVariantAttribute3() {
		return $this->variantAttribute3;
	}

	/**
	 * Sets the Variant Attribute 3
	 *
	 * @param \Extcode\WtCartProduct\Domain\Model\VariantAttribute $variantAttribute3
	 * @return void
	 */
	public function setVariantAttribute3(\Extcode\WtCartProduct\Domain\Model\VariantAttribute $variantAttribute3) {
		$this->variantAttribute3 = $variantAttribute3;
	}

	/**
	 * Returns the price
	 *
	 * @return float $price
	 */
	public function getPrice() {
		return $this->price;
	}

	/**
	 * Sets the price
	 *
	 * @param float $price
	 * @return void
	 */
	public function setPrice($price) {
		$this->price = $price;
	}

	/**
	 * Returns the Base Price
	 *
	 * @return float $price
	 */
	public function getBasePrice() {
		#TODO: respects different measuring units between variant and product
		if (! $this->getProduct()->getBasePriceMeasure() > 0 ) {
			return NULL;
		}
		if (! $this->getPriceMeasure() > 0) {
			return NULL;
		}
		$ratio = $this->getProduct()->getBasePriceMeasure() / $this->getPriceMeasure();

		$price = round($this->price * $ratio * 100.0) / 100.0;

		return $price;
	}

	/**
	 * Returns the Price Measure
	 *
	 * @return float $priceMeasure
	 */
	public function getPriceMeasure() {
		return $this->priceMeasure;
	}

	/**
	 * Sets the Price Measure
	 *
	 * @param float $priceMeasure
	 * @return void
	 */
	public function setPriceMeasure($priceMeasure) {
		$this->priceMeasure = $priceMeasure;
	}

	/**
	 * Returns the Price Measure Unit
	 *
	 * @return string $priceMeasureUnit
	 */
	public function getPriceMeasureUnit() {
		return $this->priceMeasureUnit;
	}

	/**
	 * Sets the Price Measure Unit
	 *
	 * @param string $priceMeasureUnit
	 * @return void
	 */
	public function setPriceMeasureUnit($priceMeasureUnit) {
		$this->priceMeasureUnit = $priceMeasureUnit;
	}

	/**
	 * Returns the Stock
	 *
	 * @return int
	 */
	public function getStock() {
		return $this->stock;
	}

	/**
	 * Set the Stock
	 *
	 * @param int $stock
	 */
	public function setStock($stock) {
		$this->stock = $stock;
	}

	/**
	 * Returns the calculated SKU
	 *
	 * @return string
	 */
	public function getSku() {
		$skuArray = array();

		if ($this->getProduct()->getVariantSet1()) {
			$skuArray[] = $this->getProduct()->getVariantSet1()->getSku();
			$skuArray[] = $this->getVariantAttribute1()->getSku();
		}

		if ($this->getProduct()->getVariantSet2()) {
			$skuArray[] = $this->getProduct()->getVariantSet2()->getSku();
			$skuArray[] = $this->getVariantAttribute2()->getSku();
		}

		if ($this->getProduct()->getVariantSet3()) {
			$skuArray[] = $this->getProduct()->getVariantSet3()->getSku();
			$skuArray[] = $this->getVariantAttribute3()->getSku();
		}

		return join('-', $skuArray);
	}

	/**
	 * Returns the calculated Title
	 *
	 * @return string
	 */
	public function getTitle() {
		$titleArray = array();

		if ($this->getProduct()->getVariantSet1()) {
			$titleArray[] = $this->getVariantAttribute1()->getTitle();
		}

		if ($this->getProduct()->getVariantSet2()) {
			$titleArray[] = $this->getVariantAttribute2()->getTitle();
		}

		if ($this->getProduct()->getVariantSet3()) {
			$titleArray[] = $this->getVariantAttribute3()->getTitle();
		}

		return join(' ', $titleArray);
	}

	/**
	 * @return int
	 */
	public function getPriceCalcMethod() {
		return 0;
	}


}