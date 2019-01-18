<?php
/**
 *
 * @package     magento2
 * @author      Codilar Technologies
 * @license     https://opensource.org/licenses/OSL-3.0 Open Software License v. 3.0 (OSL-3.0)
 * @link        http://www.codilar.com/
 */

namespace Codilar\AdminLogs\Model\ResourceModel;


use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class AdminLogs extends AbstractDb
{

    const TABLE_NAME = "codilar_admin_logs";

    const ID_FIELD_NAME = "codilar_admin_logs_id";

    /**
     * Resource initialization
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(self::TABLE_NAME, self::ID_FIELD_NAME);
    }
}