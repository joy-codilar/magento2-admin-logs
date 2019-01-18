<?php
/**
 *
 * @package     magento2
 * @author      Codilar Technologies
 * @license     https://opensource.org/licenses/OSL-3.0 Open Software License v. 3.0 (OSL-3.0)
 * @link        http://www.codilar.com/
 */

namespace Codilar\AdminLogs\Api;


use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

interface AdminLogsRepositoryInterface
{
    /**
     * @param string $value
     * @param string|null $field
     * @return \Codilar\AdminLogs\Api\Data\AdminLogsInterface
     * @throws NoSuchEntityException
     */
    public function load($value, $field = null);

    /**
     * @return \Codilar\AdminLogs\Api\Data\AdminLogsInterface
     */
    public function create();

    /**
     * @param \Codilar\AdminLogs\Api\Data\AdminLogsInterface $model
     * @return \Codilar\AdminLogs\Api\Data\AdminLogsInterface
     * @throws CouldNotSaveException
     */
    public function save(\Codilar\AdminLogs\Api\Data\AdminLogsInterface $model);

    /**
     * @param \Codilar\AdminLogs\Api\Data\AdminLogsInterface $model
     * @return $this
     * @throws CouldNotDeleteException
     */
    public function delete(\Codilar\AdminLogs\Api\Data\AdminLogsInterface $model);

    /**
     * @return \Codilar\AdminLogs\Model\ResourceModel\AdminLogs\Collection
     */
    public function getCollection();
}