<?php


namespace Alevel\Project\Model;

use Alevel\Project\Api\Data\QuickOrderSearchResultsInterfaceFactory;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Api\ExtensibleDataObjectConverter;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Api\DataObjectHelper;
use Alevel\Project\Api\Data\QuickOrderInterfaceFactory;
use Alevel\Project\Api\QuickOrderRepositoryInterface;
use Alevel\Project\Model\ResourceModel\QuickOrder as ResourceOrder;
use Alevel\Project\Model\ResourceModel\QuickOrder\CollectionFactory as OrderCollectionFactory;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;

/**
 * @package Alevel\Project\Model
 */
class QuickOrderRepository implements QuickOrderRepositoryInterface
{

    protected $searchResultsFactory;

    protected $dataObjectHelper;

    protected $dataObjectProcessor;

    protected $extensionAttributesJoinProcessor;

    protected $orderFactory;

    private $collectionProcessor;

    protected $resource;

    protected $dataOrderFactory;

    private $storeManager;

    protected $extensibleDataObjectConverter;
    protected $orderCollectionFactory;



    public function __construct(
        ResourceOrder $resource,
        QuickOrderFactory $quickorderFactory,
        QuickOrderInterfaceFactory $dataOrderFactory,
        QuickOrderCollectionFactory $quickorderCollectionFactory,
        QuickOrderSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor,
        ExtensibleDataObjectConverter $extensibleDataObjectConverter
    ) {
        $this->resource = $resource;
        $this->quickorderFactory = $quickorderFactory;
        $this->quickorderCollectionFactory = $quickorderCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataOrderFactory = $dataOrderFactory;
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
        \Alevel\Project\Api\Data\QuickOrderInterface $quickOrder
    ) {
        $orderData = $this->extensibleDataObjectConverter->toNestedArray(
            $quickOrder,
            [],
            \Alevel\Project\Api\Data\QuickOrderInterface::class
        );
        
        $orderModel = $this->orderFactory->create()->setData($orderData);
        
        try {
            $this->resource->save($orderModel);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the order: %1',
                $exception->getMessage()
            ));
        }
        return $orderModel->getDataModel();
    }




    public function get($quickorderId)
    {
        $quickOrder = $this->quickorderFactory->create();
        $this->resource->load($quickOrder, $quickorderId);
        if (!$quickOrder->getId()) {
            throw new NoSuchEntityException(__('order with id "%1" does not exist.', $quickorderId));
        }
        return $quickOrder->getDataModel();
    }





    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->orderCollectionFactory->create();
        
        $this->extensionAttributesJoinProcessor->process(
            $collection,
            \Alevel\Project\Api\Data\QuickOrderInterface::class
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
        \Alevel\Project\Api\Data\QuickOrderInterface $quickOrder
    ) {
        try {
            $orderModel = $this->orderFactory->create();
            $this->resource->load($orderModel, $quickOrder->getOrderId());
            $this->resource->delete($orderModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the order: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($orderId)
    {
        return $this->delete($this->get($orderId));
    }
}

