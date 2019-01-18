<?php
/**
 *
 * @package     magento2
 * @author      Codilar Technologies
 * @license     https://opensource.org/licenses/OSL-3.0 Open Software License v. 3.0 (OSL-3.0)
 * @link        http://www.codilar.com/
 */

namespace Codilar\AdminLogs\Controller\Adminhtml\Index;


use Codilar\AdminLogs\Api\AdminLogsRepositoryInterface;
use Magento\Backend\App\Action;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Result\Page;

class View extends Action
{

    const ADMIN_RESOURCE = "Codilar_AdminLogs::view";

    /**
     * @var AdminLogsRepositoryInterface
     */
    private $adminLogsRepository;

    /**
     * View constructor.
     * @param Action\Context $context
     * @param AdminLogsRepositoryInterface $adminLogsRepository
     */
    public function __construct(
        Action\Context $context,
        AdminLogsRepositoryInterface $adminLogsRepository
    )
    {
        parent::__construct($context);
        $this->adminLogsRepository = $adminLogsRepository;
    }

    /**
     * Execute action based on request and return result
     *
     * Note: Request will be added as operation argument in future
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function execute()
    {
        try {
            $log = $this->adminLogsRepository->load($this->getRequest()->getParam('id'));
            /** @var Page $page */
            $page = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
            $page->getConfig()->getTitle()->set(__('Admin Log #%1', $log->getId()));
            return $page;
        } catch (NoSuchEntityException $exception) {
            $this->messageManager->addErrorMessage($exception->getMessage());
            return $this->resultRedirectFactory->create()->setRefererOrBaseUrl();
        }
    }
}