<?php
/**
 *
 * @package     magento2
 * @author      Codilar Technologies
 * @license     https://opensource.org/licenses/OSL-3.0 Open Software License v. 3.0 (OSL-3.0)
 * @link        http://www.codilar.com/
 */

namespace Codilar\AdminLogs\Observer\Adminhtml;

use Codilar\AdminLogs\Api\AdminLogsManagementInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Registry;

class Predispatch implements ObserverInterface
{
    /**
     * @var Registry
     */
    private $registry;
    /**
     * @var AdminLogsManagementInterface
     */
    private $adminLogsManagement;

    /**
     * Predispatch constructor.
     * @param Registry $registry
     * @param AdminLogsManagementInterface $adminLogsManagement
     */
    public function __construct(
        Registry $registry,
        AdminLogsManagementInterface $adminLogsManagement
    ) {
        $this->registry = $registry;
        $this->adminLogsManagement = $adminLogsManagement;
    }

    /**
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
        /** @var RequestInterface $request */
        $request = $observer->getEvent()->getData('request');
        $log = $this->adminLogsManagement->buildLog($request);
        $this->registry->register(\Codilar\AdminLogs\Model\ResourceModel\AdminLogs::TABLE_NAME, $log, true);
    }
}
