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

namespace Risecommerce\DeleteOrders\Controller\Adminhtml\Order;

use Magento\Backend\App\Action\Context;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Magento\Sales\Model\ResourceModel\Order\CollectionFactory;
use Magento\Ui\Component\MassAction\Filter;
use Risecommerce\DeleteOrders\Helper\Data;

class MassDelete extends \Magento\Sales\Controller\Adminhtml\Order\AbstractMassAction
{
    /**
     * @var Data
     */
    protected $helper;

    /**
     * MassDelete constructor.
     * @param Context $context
     * @param Filter $filter
     * @param CollectionFactory $collectionFactory
     * @param Data $helper
     */
    public function __construct(
        Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory,
        Data $helper
    ) {
        parent::__construct($context, $filter);
        $this->collectionFactory = $collectionFactory;
        $this->helper = $helper;
    }

    /**
     * @param AbstractCollection $collection
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Redirect|\Magento\Framework\Controller\ResultInterface
     * @throws \Exception
     */
    protected function massAction(AbstractCollection $collection)
    {
        $countDeleteOrder = 0;
        foreach ($collection->getItems() as $order) {
            $configStatusArray = $this->helper->getDeleteOrderStatus();
            if (in_array($order->getStatus(), $configStatusArray)) {
                $this->helper->deleteOrder($order);
                $countDeleteOrder++;
            }
        }
        $countNonDeleteOrder = $collection->count() - $countDeleteOrder;

        if ($countNonDeleteOrder) {
            $this->messageManager->addError(__('Only selected order status can be deleted. Please check delete order <a href="'.$this->getUrl('adminhtml/system_config/edit/section/deleteorders').'">configuration</a>.'));
        }

        if ($countDeleteOrder) {
            $this->messageManager->addSuccess(__('You have deleted %1 order(s).', $countDeleteOrder));
        }

        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath($this->getComponentRefererUrl());
        return $resultRedirect;
    }
}
