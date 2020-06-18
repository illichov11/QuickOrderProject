<?php
namespace Alevel\Project\Controller\Index;

use Alevel\Project\Api\Data\QuickOrderInterfaceFactory;
use Alevel\Project\Api\QuickOrderRepositoryInterface;
use Alevel\Project\Model\Status;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Model\AbstractModel;


class Save extends Action
{
    /**
     * @var QuickOrderRepositoryInterface
     */
    private $quickorderRepository;
    /**
     * @var QuickOrderInterfaceFactory
     */
    private $quickorderInterfaceFactory;



    /**
     * Save constructor.
     * @param Context $context
     * @param QuickOrderRepositoryInterface $quickorderRepository
     * @param QuickOrderInterfaceFactory $quickorderInterfaceFactory
     */
    public function __construct(
        Context $context,
        QuickOrderRepositoryInterface $quickorderRepository,
        QuickOrderInterfaceFactory $quickorderInterfaceFactory
    ) {
        parent::__construct($context);

        $this->quickorderInterfaceFactory = $quickorderInterfaceFactory;
        $this->quickorderRepository = $quickorderRepository;
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|void
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function execute()
    {
        $params = $this->getRequest()->getParams();

        /**
         * @var Status $statusmodel
         * @var AbstractModel $model
         */

        $model = $this->quickorderInterfaceFactory->create();

        try {
            if (!\Zend_Validate::is(trim($params['name']), 'NotEmpty')) {
                throw new LocalizedException(('Enter the Name and try again.'));
            }
            if (!\Zend_Validate::is(trim($params['phone']), 'NotEmpty')) {
                throw new LocalizedException(('Enter the phone and try again.'));
            }
            if (!\Zend_Validate::is(trim($params['email']), 'EmailAddress') && !empty($params['email'])) {
                throw new LocalizedException(__('The email address is invalid. Verify the email address and try again.'));
            }

        $model->setName($params['name']);
        $model->setSku($params['sku']);
        $model->setPhone($params['phone']);
        $model->setEmail($params['email']);
        $this->quickorderRepository->save($model);

            $this->messageManager->addSuccessMessage('Saved!');
        } catch (CouldNotSaveException $e) {
            $this->logger->error($e->getMessage());
            $this->messageManager->addErrorMessage('Error');
        } catch (LocalizedException $e) {
            $this->logger->error($e->getMessage());
            $this->messageManager->addErrorMessage($e->getMessage());
        }

        $this->_redirect($params['url']);
    }
}
