<?php

namespace Alevel\Project\Api\Schema;

interface QuickOrderSchemaInterface
{
    const TABLE_NAME            = 'quick_order';
    const ORDER_ID_COL_NAME     = 'order_id';
    const NAME_COL_NAME         = 'name';
    const PHONE_COL_NAME        = 'phone';
    const EMAIL_COL_NAME        = 'email';
    const SKU_COL_NAME          = 'sku';
    const STATUS_COL_NAME       = 'status';
    const CREATED_AT_COL_NAME   = 'created_at';
    const UPDATED_AT_COL_NAME   = 'updated_at';
}