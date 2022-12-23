<?php
/**
 * Risecommerce Delete Orders Module
 * php version 7.0.31
 *
 * @category Risecommerce
 * @package  Risecommerce_DeleteOrders
 * @author   Risecommerce <magento@risecommerce.com>
 * @license  https://www.risecommerce.com  Open Software License (OSL 3.0)
 * @link     https://www.risecommerce.com
 */

namespace Risecommerce\DeleteOrders\Helper;

use Magento\Framework\App\Helper\Context;
use Magento\Sales\Model\Order;
use Magento\Framework\Message\ManagerInterface;

/**
 * Class Data
 * @package Risecommerce\DeleteOrders\Helper
 */
class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * @var Order
     */
    protected $order;

    /**
     * @var ManagerInterface
     */
    protected $messageManagerInterface;

    /**
     * Data constructor.
     * @param Context $context
     * @param Order $order
     * @param ManagerInterface $messageManagerInterface
     */
    public function __construct(
        Context $context,
        Order $order,
        ManagerInterface $messageManagerInterface
    ) {
        parent::__construct($context);
        $this->order = $order;
        $this->messageManagerInterface = $messageManagerInterface;
    }

    /**
     * Retrieve config value.
     *
     * @return string
     */
    public function getConfig($config)
    {
        return $this->scopeConfig->getValue($config, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

    /**
     * Check if module is enabled.
     *
     * @return string
     */
    public function isEnabled()
    {
        return $this->getConfig('deleteorders/general/enabled');
    }

    /**
     * Retrieve selected order status for delete order
     *
     * @return array
     */
    public function getDeleteOrderStatus()
    {
        $configStatus = $this->getConfig('deleteorders/general/order_status');
        return explode(',', $configStatus);
    }

    /**
     * Delete order(s).
     *
     * @param $order
     * @throws \Exception
     */
    public function deleteOrder(Order $order)
    {
        try {
            $invoices = $order->getInvoiceCollection();
            if (count($invoices)) {
                foreach ($invoices as $invoice) {
                    $invoice->delete();
                }
            }

            $shipments = $order->getShipmentsCollection();
            if (count($shipments)) {
                foreach ($shipments as $shipment) {
                    $shipment->delete();
                }
            }

            $creditmemos = $order->getCreditmemosCollection();
            if (count($creditmemos)) {
                foreach ($creditmemos as $creditmemo) {
                    $creditmemo->delete();
                }
            }
            $loadedOrder = $this->order->load($order->getEntityId());
            $loadedOrder->delete();
        } catch (\Exception $e) {
            $this->messageManagerInterface->addError($e->getMessage());
        }
    }
}
