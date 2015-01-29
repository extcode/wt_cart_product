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
 * VariantAttributeController
 */
class VariantAttributeController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * productRepository
	 *
	 * @var Extcode\WtCartProduct\Domain\Repository\VariantAttributeRepository
	 * @inject
	 */
	protected $variantAttributeRepository;

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
	 * action new
	 *
	 * @param \Extcode\WtCartProduct\Domain\Model\VariantSet $variantSet
	 * @param \Extcode\WtCartProduct\Domain\Model\VariantAttribute $newVariantAttribute
	 * @return void
	 */
	public function newAction(\Extcode\WtCartProduct\Domain\Model\VariantSet $variantSet,
							  \Extcode\WtCartProduct\Domain\Model\VariantAttribute $newVariantAttribute = NULL) {
		$this->view->assign('variantSet', $variantSet);
		$this->view->assign('newVariantAttribute', $newVariantAttribute);
	}

	/**
	 * action create
	 *
	 * @param \Extcode\WtCartProduct\Domain\Model\VariantSet $variantSet
	 * @param \Extcode\WtCartProduct\Domain\Model\VariantAttribute $newVariantAttribute
	 * @return void
	 */
	public function createAction(\Extcode\WtCartProduct\Domain\Model\VariantSet $variantSet,
								 \Extcode\WtCartProduct\Domain\Model\VariantAttribute $newVariantAttribute) {
		$this->variantAttributeRepository->add($newVariantAttribute);

		$variantSet->addVariantAttribute($newVariantAttribute);
		$newVariantAttribute->setVariantSet($variantSet);

		$this->flashMessageContainer->add('created');

		$this->redirect('show', 'VariantSet', NULL, array('variantSet' => $variantSet));
	}

	/**
	 * action edit
	 *
	 * @param \Extcode\WtCartProduct\Domain\Model\VariantSet $variantSet
	 * @param \Extcode\WtCartProduct\Domain\Model\VariantAttribute $variantAttribute
	 * @return void
	 */
	public function editAction(\Extcode\WtCartProduct\Domain\Model\VariantSet $variantSet,
							   \Extcode\WtCartProduct\Domain\Model\VariantAttribute $variantAttribute) {
		$this->view->assign('variantSet', $variantSet);
		$this->view->assign('variantAttribute', $variantAttribute);
	}

	/**
	 * action update
	 *
	 * @param \Extcode\WtCartProduct\Domain\Model\VariantSet $variantSet
	 * @param \Extcode\WtCartProduct\Domain\Model\VariantAttribute $variantAttribute
	 * @return void
	 */
	public function updateAction(\Extcode\WtCartProduct\Domain\Model\VariantSet $variantSet,
								 \Extcode\WtCartProduct\Domain\Model\VariantAttribute $variantAttribute) {
		$this->variantAttributeRepository->update($variantAttribute);

		$this->redirect('show', 'VariantSet', NULL, array('variantSet' => $variantSet));
	}

	/**
	 * action delete
	 *
	 * @param \Extcode\WtCartProduct\Domain\Model\VariantSet $variantSet
	 * @param \Extcode\WtCartProduct\Domain\Model\VariantAttribute $variantAttribute
	 * @return void
	 */
	public function deleteAction(\Extcode\WtCartProduct\Domain\Model\VariantSet $variantSet,
								 \Extcode\WtCartProduct\Domain\Model\VariantAttribute $variantAttribute) {
		$this->variantAttributeRepository->remove($variantAttribute);

		$this->redirect('show', 'VariantSet', NULL, array('variantSet' => $variantSet));
	}
}