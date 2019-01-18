<?php
/**
 *
 * @package     magento2
 * @author      Codilar Technologies
 * @license     https://opensource.org/licenses/OSL-3.0 Open Software License v. 3.0 (OSL-3.0)
 * @link        http://www.codilar.com/
 */

namespace Codilar\AdminLogs\Model;


use Codilar\AdminLogs\Api\Data\AdminLogsInterface;
use Magento\Framework\Model\AbstractModel;
use Codilar\AdminLogs\Model\ResourceModel\AdminLogs as ResourceModel;

class AdminLogs extends AbstractModel implements AdminLogsInterface
{
    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }

    /**
     * @return string
     */
    public function getArea()
    {
        return (string)$this->getData('area');
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return (string)$this->getData('username');
    }

    /**
     * @param string $username
     * @return $this
     */
    public function setUsername($username)
    {
        return $this->setData('username', $username);
    }

    /**
     * @return string
     */
    public function getIpAddress()
    {
        return $this->getData('ip_address');
    }

    /**
     * @param string $ipAddress
     * @return $this
     */
    public function setIpAddress($ipAddress)
    {
        return $this->setData('ip_address', $ipAddress);
    }

    /**
     * @return string
     */
    public function getActionType()
    {
        return (string)$this->getData('action_type');
    }

    /**
     * @param string $actionType
     * @return $this
     */
    public function setActionType($actionType)
    {
        return $this->setData('action_type', $actionType);
    }

    /**
     * @return array
     */
    public function getActionData()
    {
        $actionData = \json_decode($this->getData('action_data'), true);
        if (is_array($actionData)) {
            return $actionData;
        } else {
            return [];
        }
    }

    /**
     * @param array $actionData
     * @return $this
     */
    public function setActionData($actionData)
    {
        return $this->setData('action_data', \json_encode($actionData));
    }

    /**
     * @return array
     */
    public function getPostActionMessages()
    {
        $postActionMessages = \json_decode($this->getData('post_action_messages'), true);
        if (is_array($postActionMessages)) {
            return $postActionMessages;
        } else {
            return [];
        }
    }

    /**
     * @param array $postActionMessages
     * @return $this
     */
    public function setPostActionMessages($postActionMessages)
    {
        return $this->setData('post_action_messages', \json_encode($postActionMessages));
    }

    /**
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->getData('created_at');
    }
}