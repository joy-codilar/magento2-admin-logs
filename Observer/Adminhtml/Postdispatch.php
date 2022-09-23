<?php
/**
 *
 * @package     magento2
 * @author      Codilar Technologies
 * @license     https://opensource.org/licenses/OSL-3.0 Open Software License v. 3.0 (OSL-3.0)
 * @link        http://www.codilar.com/
 */

namespace Codilar\AdminLogs\Observer\Adminhtml;


use Codilar\AdminLogs\Api\AdminLogsRepositoryInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Logger\Monolog;
use Magento\Framework\Message\ManagerInterface;
use Magento\Framework\Registry;

class Postdispatch implements ObserverInterface
{
    /**
     * @var Registry
     */
    private $registry;
    /**
     * @var ManagerInterface
     */
    private $messageManager;
    /**
     * @var AdminLogsRepositoryInterface
     */
    private $adminLogsRepository;
    /**
     * @var Monolog
     */
    private $monolog;

    /**
     * Postdispatch constructor.
     * @param Registry $registry
     * @param ManagerInterface $messageManager
     * @param AdminLogsRepositoryInterface $adminLogsRepository
     * @param Monolog $monolog
     */
    public function __construct(
        Registry $registry,
        ManagerInterface $messageManager,
        AdminLogsRepositoryInterface $adminLogsRepository,
        Monolog $monolog
    )
    {
        $this->registry = $registry;
        $this->messageManager = $messageManager;
        $this->adminLogsRepository = $adminLogsRepository;
        $this->monolog = $monolog;
    }

    /**
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
        $log = $this->registry->registry(\Codilar\AdminLogs\Model\ResourceModel\AdminLogs::TABLE_NAME);
        if ($log instanceof \Codilar\AdminLogs\Api\Data\AdminLogsInterface) {
            $messages = [];
            foreach ($this->messageManager->getMessages()->getItems() as $message) {
                $messages[] = [
                    'type'  =>  $message->getType(),
                    'text'  =>  $message->getText()
                ];
            }
            $log->setPostActionMessages($messages);
            try {
                $this->adminLogsRepository->save($log);
                $this->log("Admin log successful");
            } catch (CouldNotSaveException $e) {
                $this->log($e->getMessage());
            }
        }
    }

    protected function log($message) {
        $this->monolog->info("CODILAR ADMIN LOGS: $message");
    }
}
