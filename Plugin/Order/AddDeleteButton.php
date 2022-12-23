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

namespace Risecommerce\DeleteOrders\Plugin\Order;

use Magento\Framework\UrlInterface;
use Magento\Framework\AuthorizationInterface;
use Magento\Framework\View\LayoutInterface;
use Magento\Sales\Block\Adminhtml\Order\View;
use Risecommerce\DeleteOrders\Helper\Data;

/**
 * Class AddDeleteButton
 * @package Risecommerce\DeleteOrders\Plugin\Order
 */
class AddDeleteButton
{
    /**
     * @var UrlInterface
     */
    protected $urlBuilder;

    /**
     * @var Data
     */
    protected $helper;

    /**
     * @var AuthorizationInterface
     */
    protected $_authorization;

    /**
     * AddDeleteButton constructor.
     * @param UrlInterface $url
     * @param Data $helper
     * @param AuthorizationInterface $authorization
     */
    public function __construct(
        UrlInterface $url,
        Data $helper,
        AuthorizationInterface $authorization
    ) {
        $this->urlBuilder = $url;
        $this->helper = $helper;
        $this->_authorization = $authorization;
    }

    /**
     * @param View $view
     * @param LayoutInterface $layout
     * @return array
     */
    public function beforeSetLayout(View $view, LayoutInterface $layout)
    {
        $isActive = $this->helper->isEnabled();
        $configStatusArray = $this->helper->getDeleteOrderStatus();
        $orderId = $view->getOrderId();
        $orderStatus = $view->getOrder()->getStatus();

        if ($isActive && $this->_authorization->isAllowed('Magento_Sales::delete') && $orderId && in_array($orderStatus, $configStatusArray)) {
            $message = __('Are you sure you want to delete this order? <br> It will permanently delete your orders with related invoices, shipments and creditmemos.');
            $url = $this->urlBuilder->getUrl('deleteorders/order/deleteOrder', ['id' => $orderId]);
            $view->addButton(
                'risecommerce_delete_order',
                [
                    'label'   => __('Delete'),
                    'class'   => 'delete',
                    'onclick' => "confirmSetLocation('{$message}', '{$url}')"
                ]
            );
        }
        return [$layout];
    }
}
