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

namespace Risecommerce\DeleteOrders\Ui;

use Risecommerce\DeleteOrders\Helper\Data;
use Magento\Framework\View\Element\UiComponent\ContextInterface;


class MassAction extends \Magento\Ui\Component\Action
{
    /**
     * @var Data
     */
    private $helper;

    /**
     * MassAction constructor.
     * @param ContextInterface $context
     * @param Data $helper
     * @param array $components
     * @param array $data
     * @param null $actions
     */
    public function __construct(
        ContextInterface $context,
        Data $helper,
        array $components = [],
        array $data = [],
        $actions = null
    ) {
        $this->helper = $helper;
        parent::__construct($context, $components, $data, $actions);
    }

    /**
     * @inheritDoc
     */
    public function prepare()
    {
        $isActive = $this->helper->isEnabled();
        if (!$isActive) {
            $this->unsetData();
            parent::prepare();
        }
    }
}
