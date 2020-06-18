<?php


namespace Alevel\Project\Block\Adminhtml\QuickOrder\Edit;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Backend\Block\Widget\Context;
use Alevel\Project\Api\StatusRepositoryInterface;

/**
 * Class GenericButton
 *
 * @package Alevel\Project\Block\Adminhtml\Order\Edit
 */
abstract class GenericButton
{

    protected $context;

    protected $repository;

    public function __construct(
        Context $context,
        StatusRepositoryInterface $repository
    )
    {
        $this->context      = $context;
        $this->repository   = $repository;
    }


    public function getOrderId()
    {
        try {
        return $this->context->getRequest()->getParam('order_id');
    } catch (NoSuchEntityException $e) {
    }
        return null;
    }

    /**
     * Generate url by route and parameters
     *
     * @param   string $route
     * @param   array $params
     * @return  string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}

