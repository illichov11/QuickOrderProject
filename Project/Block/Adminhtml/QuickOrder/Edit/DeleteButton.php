<?php


namespace Alevel\Project\Block\Adminhtml\QuickOrder\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Class DeleteButton
 *
 * @package Alevel\Project\Block\Adminhtml\QuickOrder\Edit
 */
class DeleteButton extends GenericButton implements ButtonProviderInterface
{


    public function getButtonData()
    {
        $data = [];
        if ($this->getOrderId()) {
            $data = [
                'label' => __('Delete QuickOrder'),
                'class' => 'delete',
                'on_click' => 'deleteConfirm(\'' . __(
                    'Are you sure you want to do this?'
                ) . '\', \'' . $this->getDeleteUrl() . '\')',
                'sort_order' => 20,
            ];
        }
        return $data;
    }


    public function getDeleteUrl()
    {
        return $this->getUrl('*/*/delete', ['order_id' => $this->getOrderId()]);
    }
}

