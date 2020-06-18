<?php


namespace Alevel\Project\DataProvider;


use Magento\Ui\DataProvider\AbstractDataProvider;
use Alevel\Project\Api\Data\StatusInterface;
use Alevel\Project\Model\ResourceModel\Status\CollectionFactory;

class StatusProvider extends AbstractDataProvider
{

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = []
    ) {
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

        /** @var $status StatusInterface */
        foreach ($items as $status) {
            $this->loadedData[$status->getId()] = $status->getData();
        }

        return $this->loadedData;
    }
}