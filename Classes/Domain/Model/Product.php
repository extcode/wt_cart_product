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
 * Product
 */
class Product extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

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
	* Images
	* @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
	*/
	protected $images;

	/**
	 * Files
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
	 */
	protected $files;

	/**
	 * teaser
	 *
	 * @var string
	 */
	protected $teaser = '';

	/**
	 * description
	 *
	 * @var string
	 */
	protected $description = '';

	/**
	 * Product Content
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Extcode\WtCartProduct\Domain\Model\TtContent>
	 * @lazy
	 */
	protected $productContent;

	/**
	 * price
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
	 * Base Price Measure
	 *
	 * @var float
	 */
	protected $basePriceMeasure = 0.0;

	/**
	 * Base Price Measure Unit
	 *
	 * @var string
	 */
	protected $basePriceMeasureUnit = '';

	/**
	 * taxClass
	 *
	 * @var \Extcode\WtCartProduct\Domain\Model\TaxClass
	 * @cascade remove
	 */
	protected $taxClass = NULL;

	/**
	 * variantSet1
	 *
	 * @var \Extcode\WtCartProduct\Domain\Model\VariantSet
	 */
	protected $variantSet1 = NULL;

	/**
	 * variantSet2
	 *
	 * @var \Extcode\WtCartProduct\Domain\Model\VariantSet
	 */
	protected $variantSet2 = NULL;

	/**
	 * variantSet3
	 *
	 * @var \Extcode\WtCartProduct\Domain\Model\VariantSet
	 */
	protected $variantSet3 = NULL;

	/**
	 * variants
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Extcode\WtCartProduct\Domain\Model\Variant>
	 * @cascade remove
	 */
	protected $variants = NULL;

	/**
	 * Related Products
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Extcode\WtCartProduct\Domain\Model\Product>
	 */
	protected $relatedProducts = NULL;

	/**
	 * stock
	 *
	 * @var int
	 */
	protected $stock = 0;

	/**
	 * Product Categories
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\Category>
	 */
	protected $productCategories = NULL;

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
	 * Returns the Images
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $images
	 */
	public function getImages() {
		return $this->images;
	}

	/**
	 * Returns the first Image
	 *
	 * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference $image
	 */
	public function getFirstImage() {
		return array_shift($this->getImages()->toArray());
	}

	/**
	 * Sets the Images
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $images
	 * @return void
	 */
	public function setHeaderImage($images) {
		$this->images = $images;
	}

	/**
	 * Returns the Files
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $files
	 */
	public function getFiles() {
		return $this->files;
	}

	/**
	 * Sets the Files
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $files
	 * @return void
	 */
	public function setFiles($files) {
		$this->files = $files;
	}

	/**
	 * Returns the teaser
	 *
	 * @return string $teaser
	 */
	public function getTeaser() {
		return $this->teaser;
	}

	/**
	 * Sets the teaser
	 *
	 * @param string $teaser
	 * @return void
	 */
	public function setTeaser($teaser) {
		$this->teaser = $teaser;
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
	 * Returns the Product Content
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage
	 */
	public function getProductContent() {
		return $this->productContent;
	}

	/**
	 * Sets the Product Content
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage $productContent
	 * @return void
	 */
	public function setProductContent($productContent) {
		$this->productContent = $productContent;
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
	 * Returns the Base Price Measure
	 *
	 * @return float $basePriceMeasure
	 */
	public function getBasePriceMeasure() {
		return $this->basePriceMeasure;
	}

	/**
	 * Sets the Base Price Measure
	 *
	 * @param float $basePriceMeasure
	 * @return void
	 */
	public function setBasePriceMeasure($basePriceMeasure) {
		$this->basePriceMeasure = $basePriceMeasure;
	}

	/**
	 * Returns the Base Price Measure Unit
	 *
	 * @return string $basePriceMeasureUnit
	 */
	public function getBasePriceMeasureUnit() {
		return $this->basePriceMeasureUnit;
	}

	/**
	 * Sets the Basse Price Measure Unit
	 *
	 * @param string $basePriceMeasureUnit
	 * @return void
	 */
	public function setBasePriceMeasureUnit($basePriceMeasureUnit) {
		$this->basePriceMeasureUnit = $basePriceMeasureUnit;
	}

	/**
	 * Returns the taxClass
	 *
	 * @return \Extcode\WtCartProduct\Domain\Model\TaxClass $taxClass
	 */
	public function getTaxClass() {
		return $this->taxClass;
	}

	/**
	 * Sets the taxClass
	 *
	 * @param \Extcode\WtCartProduct\Domain\Model\TaxClass $taxClass
	 * @return void
	 */
	public function setTaxClass(TaxClass $taxClass) {
		$this->taxClass = $taxClass;
	}

	/**
	 * Returns the Variant Set 1
	 *
	 * @return \Extcode\WtCartProduct\Domain\Model\VariantSet
	 */
	public function getVariantSet1() {
		return $this->variantSet1;
	}

	/**
	 * Sets the Variant Set 1
	 *
	 * @param \Extcode\WtCartProduct\Domain\Model\VariantSet $variantSet1
	 * @return void
	 */
	public function setVariantSet1(VariantSet $variantSet1) {
		$this->variantSet1 = $variantSet1;
	}

	/**
	 * Returns the Variant Set 2
	 *
	 * @return \Extcode\WtCartProduct\Domain\Model\VariantSet
	 */
	public function getVariantSet2() {
		return $this->variantSet2;
	}

	/**
	 * Sets the Variant Set 2
	 *
	 * @param \Extcode\WtCartProduct\Domain\Model\VariantSet $variantSet2
	 * @return void
	 */
	public function setVariantSet2(VariantSet $variantSet2) {
		$this->variantSet2 = $variantSet2;
	}

	/**
	 * Returns the Variant Set 3
	 *
	 * @return \Extcode\WtCartProduct\Domain\Model\VariantSet
	 */
	public function getVariantSet3() {
		return $this->variantSet3;
	}

	/**
	 * Sets the Variant Set 3
	 *
	 * @param \Extcode\WtCartProduct\Domain\Model\VariantSet $variantSet3
	 * @return void
	 */
	public function setVariantSet3(VariantSet $variantSet3) {
		$this->variantSet3 = $variantSet3;
	}

	/**
	 * Adds a Variant
	 *
	 * @param \Extcode\WtCartProduct\Domain\Model\Variant $variant
	 * @return void
	 */
	public function addVariant(\Extcode\WtCartProduct\Domain\Model\Variant $variant) {
		$this->variants->attach($variant);
	}

	/**
	 * Removes a Variant
	 *
	 * @param \Extcode\WtCartProduct\Domain\Model\Variant $variantToRemove
	 * @return void
	 */
	public function removeVariant(\Extcode\WtCartProduct\Domain\Model\Variant $variantToRemove) {
		$this->variants->detach($variantToRemove);
	}

	/**
	 * Returns the Variants
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Extcode\WtCartProduct\Domain\Model\Variant> $variant
	 */
	public function getVariants() {
		return $this->variants;
	}

	/**
	 * Sets the Variants
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Extcode\WtCartProduct\Domain\Model\Variant> $variants
	 * @return void
	 */
	public function setVariants(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $variants) {
		$this->variants = $variants;
	}

	/**
	 * Adds a Related Product
	 *
	 * @param \Extcode\WtCartProduct\Domain\Model\Product $relatedProduct
	 * @return void
	 */
	public function addRelatedProduct(\Extcode\WtCartProduct\Domain\Model\Product $relatedProduct) {
		$this->relatedProducts->attach($relatedProduct);
	}

	/**
	 * Removes a Related Product
	 *
	 * @param \Extcode\WtCartProduct\Domain\Model\Product $relatedProductToRemove
	 * @return void
	 */
	public function removeRelatedProduct(\Extcode\WtCartProduct\Domain\Model\Product $relatedProductToRemove) {
		$this->relatedProducts->detach($relatedProductToRemove);
	}

	/**
	 * Returns the Related Products
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Extcode\WtCartProduct\Domain\Model\Product> $relatedProduct
	 */
	public function getRelatedProducts() {
		return $this->relatedProducts;
	}

	/**
	 * Sets the Related Products
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Extcode\WtCartProduct\Domain\Model\Product> $relatedProducts
	 * @return void
	 */
	public function setRelatedProducts(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $relatedProducts) {
		$this->relatedProducts = $relatedProducts;
	}

	/**
	 * Returns the Stock
	 *
	 * @return int
	 */
	public function getStock() {
		if (count($this->variants)) {
			$count = 0;

			foreach($this->variants as $variant) {
				$count += $variant->getStock();
			}

			return $count;
		}
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
	 * Adds a Product Category
	 *
	 * @param \TYPO3\CMS\Extbase\Domain\Model\Category $productCategory
	 * @return void
	 */
	public function addProductCategory(\TYPO3\CMS\Extbase\Domain\Model\Category $productCategory) {
		$this->productCategories->attach($productCategory);
	}

	/**
	 * Removes a Category
	 *
	 * @param \TYPO3\CMS\Extbase\Domain\Model\Category $productCategoryToRemove
	 * @return void
	 */
	public function removeProductCategory(\TYPO3\CMS\Extbase\Domain\Model\Category $productCategoryToRemove) {
		$this->productCategories->detach($productCategoryToRemove);
	}

	/**
	 * Returns the categories
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\Category> $productCategories
	 */
	public function getProductCategories() {
		return $this->productCategories;
	}

	/**
	 * Sets the categories
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\Category> $productCategories
	 * @return void
	 */
	public function setProductCategories(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $productCategories) {
		$this->productCategories = $productCategories;
	}


	/**
	 * get the minimal Price from Variants
	 *
	 * @return float
	 */
	public function getMinPrice() {
		if ( $this->getVariants() ) {
			foreach ( $this->getVariants() as $variant ) {
				if (!isset($minPrice)) {
					$minPrice = $variant->getPrice();
				} else {
					if ($variant->getPrice() < $minPrice) {
						$minPrice = $variant->getPrice();
					}
				}
			}
		} else {
			$minPrice = $this->getPrice();
		}

		return $minPrice;
	}

}