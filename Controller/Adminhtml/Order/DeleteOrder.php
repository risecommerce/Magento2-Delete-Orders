<?php

/**
 * Risecommerce DeleteOrders Module
 * php version 7.0.31
 *
 * @category Risecommerce
 * @package  Risecommerce_DeleteOrders
 * @author   Risecommerce <magento@risecommerce.com>
 * @license  https://www.risecommerce.com  Open Software License (OSL 3.0)
 * @link     https://www.risecommerce.com
 */
namespace Risecommerce\DeleteOrders\Controller\Adminhtml\Order;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Risecommerce\DeleteOrders\Helper\Data;
use Magento\Sales\Model\OrderFactory;

/**
 * Class DeleteOrder
 * @package Risecommerce\DeleteOrders\Controller\Adminhtml\Order
 */
class DeleteOrder extends Action
{
    /**
     * @var Data
     */
    protected $helper;

    /**
     * @var OrderFactory
     */
    protected $orderFactory;

    /**
     * DeleteOrder constructor.
     * @param Context $context
     * @param OrderFactory $orderFactory
     * @param Data $helper
     */
    public function __construct(
        Context $context,
        OrderFactory $orderFactory,
        Data $helper
    ) {
        parent::__construct($context);
        $this->orderFactory= $orderFactory;
        $this->helper = $helper;
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|void
     * @throws \Exception
     */
    public function execute()
    {
        $orderId = $this->getRequest()->getParam('id');
        if ($orderId) {
            $order = $this->orderFactory->create()->load($orderId);
            $configStatusArray = $this->helper->getDeleteOrderStatus();
            if (in_array($order->getStatus(), $configStatusArray)) {
                $this->helper->deleteOrder($order);
                $this->messageManager->addSuccess(__('You have deleted order.'));
                $this->_redirect('sales/*/');
                return;
            }
            $this->messageManager->addError(__('Only selected order status can be deleted. Please check delete order <a href="'.$this->getUrl('adminhtml/system_config/edit/section/deleteorders').'">configuration</a>.'));
            $this->_redirect('sales/order/view', ['order_id' => $orderId]);
            return;
        }
        $this->messageManager->addError(__('There is no order to process'));
        $this->_redirect('sales/*/');
        return;
    }
}
