<?php
/**
 *
 * @package     magento2
 * @author      Codilar Technologies
 * @license     https://opensource.org/licenses/OSL-3.0 Open Software License v. 3.0 (OSL-3.0)
 * @link        http://www.codilar.com/
 */

namespace Codilar\AdminLogs\Api\Data;


interface AdminLogsInterface
{
    /**
     * @return int
     */
    public function getId();

    /**
     * @param int $id
     * @return $this
     */
    public function setId($id);

    /**
     * @return string
     */
    public function getArea();

    /**
     * @return string
     */
    public function getUsername();

    /**
     * @param string $username
     * @return $this
     */
    public function setUsername($username);

    /**
     * @return string
     */
    public function getIpAddress();

    /**
     * @param string $ipAddress
     * @return $this
     */
    public function setIpAddress($ipAddress);

    /**
     * @return string
     */
    public function getActionType();

    /**
     * @param string $actionType
     * @return $this
     */
    public function setActionType($actionType);

    /**
     * @return array
     */
    public function getActionData();

    /**
     * @param array $actionData
     * @return $this
     */
    public function setActionData($actionData);

    /**
     * @return array
     */
    public function getPostActionMessages();

    /**
     * @param array $postActionMessages
     * @return $this
     */
    public function setPostActionMessages($postActionMessages);

    /**
     * @return string
     */
    public function getCreatedAt();

}