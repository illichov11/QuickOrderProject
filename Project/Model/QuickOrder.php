<?php


namespace Alevel\Project\Model;

use Alevel\Project\Api\Data\QuickOrderInterface;
use Alevel\Project\Api\Data\QuickOrderInterfaceFactory;
use Magento\Framework\Api\DataObjectHelper;

/**
 * @package Alevel\Project\Model
 */
class QuickOrder extends \Magento\Framework\Model\AbstractModel
{

    protected $quickorderDataFactory;

    protected $dataObjectHelper;

    protected $_eventPrefix = 'alevel_project_quickorder';


    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        QuickOrderInterfaceFactory $quickorderDataFactory,
        DataObjectHelper $dataObjectHelper,
        \Alevel\Project\Model\ResourceModel\QuickOrder $resource,
        \Alevel\Project\Model\ResourceModel\QuickOrder\Collection $resourceCollection,
        array $data = []
    ) {
        $this->quickorderDataFactory = $quickorderDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }


    public function getDataModel()
    {
        $orderData = $this->getData();
        
        $quickorderDataObject = $this->quickorderDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $quickorderDataObject,
            $orderData,
            QuickOrderInterface::class
        );
        
        return $quickorderDataObject;
    }
}

