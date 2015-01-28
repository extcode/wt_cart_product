<?php

namespace Extcode\WtCartProduct\Domain\Repository;

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
 * Category
 */
class CategoryRepository extends \TYPO3\CMS\Extbase\Domain\Repository\CategoryRepository {

	/**
	 * findAllAsRecursiveTreeArray
	 *
	 * @param Extcode\WtCartProduct\Domain\Model\Category $selectedCategory
	 * @return array $categories
	 */
	public function findAllAsRecursiveTreeArray($selectedCategory = NULL) {
		$categoriesArray = $this->findAllAsArray($selectedCategory);
		$categoriesTree = $this->buildSubcategories($categoriesArray, NULL);
		return $categoriesTree;
	}

	/**
	 * findAllAsArray
	 *
	 * @param Extcode\WtCartProduct\Domain\Model\Category $selectedCategory
	 * @return array $categories
	 */
	public function findAllAsArray($selectedCategory = NULL){
		$localCategories = $this->findAll();
		$categories = array();
		// Transform categories to array
		foreach($localCategories as $localCategory){
			$newCategory = array(
				'uid' => $localCategory->getUid(),
				'title' => $localCategory->getTitle(),
				'parent' =>
					($localCategory->getParent()?$localCategory->getParent()->getUid():NULL),
				'subcategories' => null,
				'isSelected' => ($selectedCategory == $localCategory ? true : false)
			);
			$categories[] = $newCategory;
		}
		return $categories;
	}

	/**
	 * findSubcategoriesRecursiveAsArray
	 *
	 * @param Extcode\WtCartProduct\Domain\Model\Category $parentCategory
	 * @return array $categories
	 */
	public function findSubcategoriesRecursiveAsArray($parentCategory){
		$categories = array();
		$localCategories = $this->findAllAsArray();
		foreach($localCategories as $category) {
			if(($parentCategory && $category['uid'] == $parentCategory->getUid())
				|| !$parentCategory){
				$this->getSubcategoriesIds($localCategories, $category,
					$categories);
			}
		}
		return $categories;
	}

	/**
	 * getSubcategoriesIds
	 *
	 * @param array $categoriesArray
	 * @param array $parentCategory
	 * @param array $subcategoriesArray
	 * @return void
	 */
	private function getSubcategoriesIds($categoriesArray,$parentCategory,
										 &$subcategoriesArray){
		$subcategoriesArray[] = $parentCategory['uid'];
		foreach($categoriesArray as $category){
			if($category['parent'] == $parentCategory['uid']){
				$this->getSubcategoriesIds($categoriesArray, $category,
					$subcategoriesArray);
			}
		}
	}

	/**
	 * buildSubcategories
	 *
	 * @param array $categoriesArray
	 * @param array $parentCategory
	 * @return array $categories
	 */
	private function buildSubcategories($categoriesArray,$parentCategory){
		$categories = NULL;
		foreach($categoriesArray as $category){
			if($category['parent'] == $parentCategory['uid']){
				$newCategory = $category;
				$newCategory['subcategories'] =
					$this->buildSubcategories($categoriesArray, $category);
				$categories[] = $newCategory;
			}
		}
		return $categories;
	}

}