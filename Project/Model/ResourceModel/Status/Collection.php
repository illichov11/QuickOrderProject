<?php


namespace Alevel\Project\Model\ResourceModel\Status;

/**
 * @package Alevel\Project\Model\ResourceModel\Status
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * @var string
     */
    protected $_idFieldName = 'status_id';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            \Alevel\Project\Model\Status::class,
            \Alevel\Project\Model\ResourceModel\Status::class
        );
    }
}

