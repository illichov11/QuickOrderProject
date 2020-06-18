<?php


namespace Alevel\Project\Setup;

use Alevel\Project\Api\Schema\StatusSchemaInterface;
use Alevel\Project\Api\Schema\QuickOrderSchemaInterface;

use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{
    /**
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @throws \Zend_Db_Exception
     */
    public function install(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    )
    {
        $setup->startSetup();
        $this->createStatusTable($setup);
        $this->createOrderTable($setup);
        $setup->getConnection()->addForeignKey(
            $setup->getFkName(
                $setup->getTable(QuickOrderSchemaInterface::TABLE_NAME),
                QuickOrderSchemaInterface::STATUS_COL_NAME,
                $setup->getTable(StatusSchemaInterface::TABLE_NAME),
                StatusSchemaInterface::STATUS_ID_COL_NAME
            ),
            $setup->getTable(QuickOrderSchemaInterface::TABLE_NAME),
            QuickOrderSchemaInterface::STATUS_COL_NAME,
            $setup->getTable(StatusSchemaInterface::TABLE_NAME),
            StatusSchemaInterface::STATUS_ID_COL_NAME,
            Table::ACTION_NO_ACTION
        );
        $setup->endSetup();
    }

    /**
     * @param SchemaSetupInterface $setup
     * @throws \Zend_Db_Exception
     */
    public function createOrderTable(SchemaSetupInterface $setup)
    {
        $table = $setup->getConnection()->newTable(
            $setup->getTable(QuickOrderSchemaInterface::TABLE_NAME)
        )->addColumn(
            QuickOrderSchemaInterface::ORDER_ID_COL_NAME,
            Table::TYPE_INTEGER,
            null,
            ['identity' => true, 'nullable' => false, 'primary' => true, 'unsigned' => true],
            'ID'
        )->addColumn(
            QuickOrderSchemaInterface::NAME_COL_NAME,
            Table::TYPE_TEXT,
            32,
            ['nullable' => false],
            'Name'
        )->addColumn(
            QuickOrderSchemaInterface::SKU_COL_NAME,
            Table::TYPE_TEXT,
            32,
            ['nullable' => true],
            'Name'
        )->addColumn(
            QuickOrderSchemaInterface::PHONE_COL_NAME,
            Table::TYPE_TEXT,
            32,
            ['nullable' => true]
        )->addColumn(
            QuickOrderSchemaInterface::EMAIL_COL_NAME,
            Table::TYPE_TEXT,
            32,
            ['nullable' => true]
        )->addColumn(
            QuickOrderSchemaInterface::STATUS_COL_NAME,
            Table::TYPE_INTEGER,
            null,
            ['nullable' => true, 'unsigned' => true]
        )->addColumn(
            QuickOrderSchemaInterface::CREATED_AT_COL_NAME,
            Table::TYPE_TIMESTAMP,
            null,
            ['nullable' => false, 'default' => Table::TIMESTAMP_INIT],
            'Date of Last Flag Update'
        )->addColumn(
            QuickOrderSchemaInterface::UPDATED_AT_COL_NAME,
            Table::TYPE_TIMESTAMP,
            null,
            ['nullable' => true, 'default' => Table::TIMESTAMP_INIT_UPDATE]
        )->addIndex(
            $setup->getIdxName(
                $setup->getTable(QuickOrderSchemaInterface::TABLE_NAME),
                [QuickOrderSchemaInterface::NAME_COL_NAME],
                AdapterInterface::INDEX_TYPE_FULLTEXT
            ),
            [QuickOrderSchemaInterface::NAME_COL_NAME],
            ['type' => AdapterInterface::INDEX_TYPE_FULLTEXT]
        )->setComment(
            'Quick order'
        );
        $setup->getConnection()->createTable($table);
    }

    /**
     * @param SchemaSetupInterface $setup
     * @throws \Zend_Db_Exception
     */
    private function createStatusTable(SchemaSetupInterface $setup)
    {
        $table = $setup->getConnection()->newTable(
            $setup->getTable(StatusSchemaInterface::TABLE_NAME)
        )->addColumn(
            StatusSchemaInterface::STATUS_ID_COL_NAME,
            Table::TYPE_INTEGER,
            null,
            ['identity' => true, 'nullable' => false, 'primary' => true, 'unsigned' => true],
            'ID'
        )->addColumn(
            StatusSchemaInterface::STATUS_CODE_COL_NAME,
            Table::TYPE_TEXT,
            16,
            ['nullable' => false],
            'Status code'
        )->addColumn(
            StatusSchemaInterface::STATUS_LABEL_COL_NAME,
            Table::TYPE_TEXT,
            32,
            ['nullable' => true],
            'Status Label'
        )->addColumn(
            StatusSchemaInterface::IS_DEFAULT,
            Table::TYPE_SMALLINT,
            1,
            ['nullable' => false, 'default' => 0]
        )->setComment(
            'Quick Order Status'
        );
        $setup->getConnection()->createTable($table);
    }
}

