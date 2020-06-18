<?php


namespace Alevel\Project\Controller\Adminhtml;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use Magento\Backend\Model\View\Result\Page;
/**
 * Class Status
 *
 * @package Alevel\Project\Controller\Adminhtml
 */
abstract class Status extends Action
{

    const ADMIN_RESOURCE = 'Alevel_Project::level';
    protected $_coreRegistry;

    /**
     * @param Context $context
     * @param Registry $coreRegistry
     */
    public function __construct(
       Context $context,
       Registry $coreRegistry
    ) {
        $this->_coreRegistry = $coreRegistry;
        parent::__construct($context);
    }

    /**
     * Init page
     *
     * @param Page $resultPage
     * @return Page
     */
    public function initPage($resultPage)
    {
        $resultPage->setActiveMenu(self::ADMIN_RESOURCE)
            ->addBreadcrumb(__('Alevel'), __('Alevel'))
            ->addBreadcrumb(__('Status'), __('Status'));
        return $resultPage;
    }
}

