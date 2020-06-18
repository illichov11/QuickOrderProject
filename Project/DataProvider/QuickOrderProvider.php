<?php


namespace Alevel\Project\DataProvider;


use Magento\Ui\DataProvider\AbstractDataProvider;
use Alevel\Project\Api\Data\QuickOrderInterface;
use Alevel\Project\Model\ResourceModel\QuickOrder\CollectionFactory;

class OrderProvider extends AbstractDataProvider
{

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = []
    )
    {
        $this->collection = $collectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $items = $this->collection->getItems();

        if (empty($items)) {
            return [];
        }

        /** @var $order QuickOrderInterface */
        foreach ($items as $order) {
            $this->loadedData[$order->getId()] = $order->getData();
        }

        return $this->loadedData;
    }
}