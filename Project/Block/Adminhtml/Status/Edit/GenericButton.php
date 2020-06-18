<?php


namespace Alevel\Project\Block\Adminhtml\Status\Edit;

use Magento\Backend\Block\Widget\Context;

use Magento\Framework\Exception\NoSuchEntityException;
use Alevel\Project\Api\StatusRepositoryInterface;

/**
 * Class GenericButton
 * @package Alevel\Project\Block\Adminhtml\Status\Edit
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


    /**
     * @return mixed|null
     */
    public function getStatusId()
    {  try {
        return $this->context->getRequest()->getParam('status_id');
    } catch (NoSuchEntityException $e) {
    }
        return null;
    }

    /**
     * @param string $route
     * @param array $params
     * @return string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}

