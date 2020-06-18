<?php


namespace Alevel\Project\Model\ResourceModel\QuickOrder;

/**
 *
 * @package Alevel\Project\Model\ResourceModel\QuickOrder
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * @var string
     */
    protected $_idFieldName = 'order_id';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            \Alevel\Project\Model\QuickOrder::class,
            \Alevel\Project\Model\ResourceModel\QuickOrder::class
        );
    }
}

