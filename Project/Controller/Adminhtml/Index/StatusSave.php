<?php


namespace Alevel\Project\Controller\Adminhtml\Index;

use Magento\Framework\Exception\LocalizedException;
use Psr\Log\LoggerInterface;

use Alevel\Project\Api\StatusRepositoryInterface;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Message\ManagerInterface;
use Alevel\Project\Api\Data\StatusInterfaceFactory;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Model\AbstractModel;
/**
 * @package Alevel\Project\Controller\Adminhtml\Index
 */
class StatusSave extends Action
{
    private $modelFactory;

    /**
     * @var StatusRepositoryInterface
     */
    private $repository;

    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(
        Context $context,
        StatusInterfaceFactory $statusInterfaceFactory,
        StatusRepositoryInterface $repository,
        LoggerInterface $logger
    ) {
        $this->repository       = $repository;
        $this->modelFactory     = $statusInterfaceFactory;
        $this->logger           = $logger;

        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function execute()
    {
        $params = $this->getRequest()->getParams();

        /** @var AbstractModel $model */
        $model = $this->modelFactory->create();

        $model->addData($params);
        $model->setLabel($params['label']);

        try {
            $this->repository->save($model);
            $this->messageManager->addSuccessMessage('Saved!');
        } catch (CouldNotSaveException $e) {
            $this->logger->error($e->getMessage());
            $this->messageManager->addErrorMessage('Error');
        }

        return  $this->_redirect('*/*/');
    }
}

