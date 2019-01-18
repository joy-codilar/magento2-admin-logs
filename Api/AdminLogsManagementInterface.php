<?php
/**
 *
 * @package     magento2
 * @author      Codilar Technologies
 * @license     https://opensource.org/licenses/OSL-3.0 Open Software License v. 3.0 (OSL-3.0)
 * @link        http://www.codilar.com/
 */

namespace Codilar\AdminLogs\Api;


interface AdminLogsManagementInterface
{
    /**
     * @param \Magento\Framework\App\RequestInterface $request
     * @return \Codilar\AdminLogs\Api\Data\AdminLogsInterface|null
     */
    public function buildLog(\Magento\Framework\App\RequestInterface $request);

    /**
     * @param string $username
     * @return \Codilar\AdminLogs\Api\Data\AdminLogsInterface[]
     */
    public function getLogsByUsername($username);

    /**
     * @param string $actionType
     * @return \Codilar\AdminLogs\Api\Data\AdminLogsInterface[]
     */
    public function getLogsByActionType($actionType);
}