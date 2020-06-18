<?php


namespace Alevel\Project\Model\ResourceModel;

use Alevel\Project\Api\Schema\StatusSchemaInterface;

/**
 * Class Status
 *
 * @package Alevel\Project\Model\ResourceModel
 */
class Status extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(StatusSchemaInterface::TABLE_NAME, StatusSchemaInterface::STATUS_ID_COL_NAME);
    }
}

