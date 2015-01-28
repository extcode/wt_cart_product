<?php

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2014 Daniel Lorenz <wtcartproduct@extco.de>, extco.de UG (haftungsbeschränkt)
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
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
 * Test case for class Tx_WtCartProduct_Domain_Model_TaxClass.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Daniel Lorenz <wtcartproduct@extco.de>
 */
class Tx_WtCartProduct_Domain_Model_TaxClassTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var Tx_WtCartProduct_Domain_Model_TaxClass
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = new Tx_WtCartProduct_Domain_Model_TaxClass();
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getTitleReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getTitle()
		);
	}

	/**
	 * @test
	 */
	public function setTitleForStringSetsTitle() {
		$this->subject->setTitle('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'title',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getValueReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getValue()
		);
	}

	/**
	 * @test
	 */
	public function setValueForStringSetsValue() {
		$this->subject->setValue('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'value',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getCalcReturnsInitialValueForFloat() {
		$this->assertSame(
			0.0,
			$this->subject->getCalc()
		);
	}

	/**
	 * @test
	 */
	public function setCalcForFloatSetsCalc() {
		$this->subject->setCalc(3.14159265);

		$this->assertAttributeEquals(
			3.14159265,
			'calc',
			$this->subject,
			'',
			0.000000001
		);
	}
}
