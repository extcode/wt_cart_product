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
 * Product
 */
class ProductRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {

	/**
	 * Finds objects filtered by $piVars['filter']
	 *
	 * @param array $piVars
	 * @return Query Object
	 */
	public function findAll($piVars = array()) {
		// settings
		$query = $this->createQuery();

		$constraints = array();

		// filter
		if ( isset($piVars['filter']) ) {
			foreach ((array) $piVars['filter'] as $field => $value) {

				if (empty($value)) {
					continue;
				}

				switch ($field) {
					case 'sku':
						$constraints[] = $query->equals('sku', $value);
						break;
					case 'title':
						$constraints[] = $query->like('title', '%' . $value . '%');
				}
			}
		}

		// create constraint
		if (!empty($constraints)) {
			$query->matching(
				$query->logicalAnd($constraints)
			);
		}

		$products = $query->execute();

		return $products;
	}

	/**
	 * Finds objects based on selected categories
	 *
	 * @param array $categories
	 *
	 * @return object
	 */
	public function findByCategories($categories) {
		$query = $this->createQuery();
		//$query->getQuerySettings()->setRespectStoragePage(FALSE);

		$constraints = array();

		if ((!empty($categories))) {
			$categoryConstraints = array();
			foreach ($categories as $category) {
				$categoryConstraints[] = $query->contains('productCategories', $category);
			}
			$constraints = $query->logicalOr($categoryConstraints);
		}

		if (!empty($constraints)) {
			$query->matching(
				$query->logicalAnd($constraints)
			);
		}

		$result = $query->execute();

		return $result;
	}

	/**
	 * Finds objects based on selected uids
	 *
	 * @param string $uids
	 *
	 * @return object
	 */
	public function findByUids($uids) {
		$uids = explode(',', $uids);

		$query = $this->createQuery();
		$query->matching(
			$query->in('uid', $uids)
		);

		return $query->execute();
	}
}