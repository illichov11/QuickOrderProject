<?php


namespace Alevel\Project\Model\ResourceModel;

use Alevel\Project\Api\Schema\QuickOrderSchemaInterface;

/**
 * @package Alevel\Project\Model\ResourceModel
 */
class QuickOrder extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(QuickOrderSchemaInterface::TABLE_NAME, QuickOrderSchemaInterface::ORDER_ID_COL_NAME);
    }
}

