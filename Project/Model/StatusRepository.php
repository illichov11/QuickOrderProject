<?php


namespace Alevel\Project\Model;

use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Api\ExtensibleDataObjectConverter;
use Magento\Framework\Exception\CouldNotSaveException;
use Alevel\Project\Api\StatusRepositoryInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Api\DataObjectHelper;
use Alevel\Project\Api\Data\StatusSearchResultsInterfaceFactory;
use Alevel\Project\Api\Data\StatusInterfaceFactory;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Alevel\Project\Model\ResourceModel\Status\CollectionFactory as StatusCollectionFactory;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Alevel\Project\Model\ResourceModel\Status as ResourceStatus;

/**
 * Class StatusRepository
 *
 * @package Alevel\Project\Model
 */
class StatusRepository implements StatusRepositoryInterface
{

    protected $searchResultsFactory;

    protected $dataObjectHelper;

    protected $statusFactory;

    protected $dataObjectProcessor;

    protected $extensionAttributesJoinProcessor;

    protected $statusCollectionFactory;

    private $collectionProcessor;

    protected $dataStatusFactory;

    protected $resource;

    private $storeManager;

    protected $extensibleDataObjectConverter;

    public function __construct(
        ResourceStatus $resource,
        StatusFactory $statusFactory,
        StatusInterfaceFactory $dataStatusFactory,
        StatusCollectionFactory $statusCollectionFactory,
        StatusSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor,
        ExtensibleDataObjectConverter $extensibleDataObjectConverter
    ) {
        $this->resource = $resource;
        $this->statusFactory = $statusFactory;
        $this->statusCollectionFactory = $statusCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataStatusFactory = $dataStatusFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
        $this->collectionProcessor = $collectionProcessor;
        $this->extensionAttributesJoinProcessor = $extensionAttributesJoinProcessor;
        $this->extensibleDataObjectConverter = $extensibleDataObjectConverter;
    }

    /**
     * {@inheritdoc}
     */
    public function save(
        \Alevel\Project\Api\Data\StatusInterface $status
    ) {
        
        $statusData = $this->extensibleDataObjectConverter->toNestedArray(
            $status,
            [],
            \Alevel\Project\Api\Data\StatusInterface::class
        );
        
        $statusModel = $this->statusFactory->create()->setData($statusData);
        
        try {
            $this->resource->save($statusModel);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the status: %1',
                $exception->getMessage()
            ));
        }
        return $statusModel->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function get($statusId)
    {
        $status = $this->statusFactory->create();
        $this->resource->load($status, $statusId);
        if (!$status->getId()) {
            throw new NoSuchEntityException(__('status with id "%1" does not exist.', $statusId));
        }
        return $status->getDataModel();
    }

    /**Dragun\Qorder
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->statusCollectionFactory->create();
        
        $this->extensionAttributesJoinProcessor->process(
            $collection,
            \Alevel\Project\Api\Data\StatusInterface::class
        );
        
        $this->collectionProcessor->process($criteria, $collection);
        
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        
        $items = [];
        foreach ($collection as $model) {
            $items[] = $model->getDataModel();
        }
        
        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(
        \Alevel\Project\Api\Data\StatusInterface $status
    ) {

            $statusModel = $this->statusFactory->create();
            $this->resource->load($statusModel, $status->getStatusId());
            $this->resource->delete($statusModel);


        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($statusId)
    {
        return $this->delete($this->get($statusId));
    }
}

