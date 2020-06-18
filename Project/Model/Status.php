<?php


namespace Alevel\Project\Model;

use Magento\Framework\Api\DataObjectHelper;
use Alevel\Project\Api\Data\StatusInterface;
use Alevel\Project\Api\Data\StatusInterfaceFactory;

/**
 * Class Status
 *
 * @package Alevel\Project\Model
 */
class Status extends \Magento\Framework\Model\AbstractModel
{

    protected $dataObjectHelper;

    protected $statusDataFactory;

    protected $_eventPrefix = 'alevel_project_status';

    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        StatusInterfaceFactory $statusDataFactory,
        DataObjectHelper $dataObjectHelper,
        \Alevel\Project\Model\ResourceModel\Status $resource,
        \Alevel\Project\Model\ResourceModel\Status\Collection $resourceCollection,
        array $data = []
    ) {
        $this->statusDataFactory = $statusDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Retrieve status model with status data
     * @return StatusInterface
     */
    public function getDataModel()
    {
        $statusData = $this->getData();
        
        $statusDataObject = $this->statusDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $statusDataObject,
            $statusData,
            StatusInterface::class
        );
        
        return $statusDataObject;
    }
}

