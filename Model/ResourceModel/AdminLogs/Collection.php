<?php
/**
 *
 * @package     magento2
 * @author      Codilar Technologies
 * @license     https://opensource.org/licenses/OSL-3.0 Open Software License v. 3.0 (OSL-3.0)
 * @link        http://www.codilar.com/
 */

namespace Codilar\AdminLogs\Model\ResourceModel\AdminLogs;


use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Codilar\AdminLogs\Model\AdminLogs as Model;
use Codilar\AdminLogs\Model\ResourceModel\AdminLogs as ResourceModel;

class Collection extends AbstractCollection
{

    protected $_mainTable = ResourceModel::TABLE_NAME;
    protected $_idFieldName = ResourceModel::ID_FIELD_NAME;

    protected function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}