<?php

namespace Extcode\WtCartProduct\Controller;

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
 * VariantController
 */
class VariantController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * productRepository
	 *
	 * @var Extcode\WtCartProduct\Domain\Repository\VariantRepository
	 * @inject
	 */
	protected $variantRepository;

	/**
	 * Persistence Manager
	 *
	 *@var \TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager
	 *@inject
	 */
	protected $persistenceManager;

	/**
	 * @var \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface
	 * @inject
	 */
	protected $configurationManager;

	/**
	 * @var int Current page
	 */
	protected $pageId;

	/**
	 * piVars
	 *
	 * @var array
	 */
	protected $piVars;

	/**
	 * Action initializer
	 *
	 * @return void
	 */
	protected function initializeAction() {
		$this->pageId = (int)\TYPO3\CMS\Core\Utility\GeneralUtility::_GP('id');

		$frameworkConfiguration = $this->configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);
		$persistenceConfiguration = array('persistence' => array('storagePid' => $this->pageId));
		$this->configurationManager->setConfiguration(array_merge($frameworkConfiguration, $persistenceConfiguration));

		$this->piVars = $this->request->getArguments();
	}

	/**
	 * action show
	 *
	 * @param \Extcode\WtCartProduct\Domain\Model\Variant $variant
	 * @return void
	 */
	public function showAction(\Extcode\WtCartProduct\Domain\Model\Variant $variant) {
		$this->view->assign('variant', $variant);
	}

	/**
	 * action edit
	 *
	 * @param \Extcode\WtCartProduct\Domain\Model\Variant $variant
	 * @return void
	 */
	public function editAction(\Extcode\WtCartProduct\Domain\Model\Variant $variant) {
		$this->view->assign('variant', $variant);
	}

	/**
	 * action update
	 *
	 * @param \Extcode\WtCartProduct\Domain\Model\Variant $variant
	 * @return void
	 */
	public function updateAction(\Extcode\WtCartProduct\Domain\Model\Variant $variant) {
		$this->variantRepository->update( $variant );

		//$this->persistenceManager->persistAll();

		$this->redirect( 'show', NULL, NULL, array('variant' => $variant) );
	}

}