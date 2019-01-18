<?php
/**
 *
 * @package     magento2
 * @author      Codilar Technologies
 * @license     https://opensource.org/licenses/OSL-3.0 Open Software License v. 3.0 (OSL-3.0)
 * @link        http://www.codilar.com/
 */

namespace Codilar\AdminLogs\Setup;


use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Codilar\AdminLogs\Model\ResourceModel\AdminLogs as ResourceModel;

class InstallSchema implements InstallSchemaInterface
{

    /**
     * Installs DB schema for a module
     *
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     * @throws \Zend_Db_Exception
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $adminLogsTableName = $setup->getTable(ResourceModel::TABLE_NAME);
        $adminLogsTable = $setup->getConnection()->newTable(
            $adminLogsTableName
        )->addColumn(
            ResourceModel::ID_FIELD_NAME,
            Table::TYPE_INTEGER,
            null,
            [
                'primary'   =>  true,
                'identity'  =>  true,
                'nullable'  =>  false,
                'unsigned'  =>  true
            ],
            "Entity ID"
        )->addColumn(
            "area",
            Table::TYPE_TEXT,
            20,
            [
                'nullable'  =>  true
            ],
            "User Login"
        )->addColumn(
            "username",
            Table::TYPE_TEXT,
            40,
            [
                'nullable'  =>  true
            ],
            "User Login"
        )->addColumn(
            "ip_address",
            Table::TYPE_TEXT,
            100,
            [
                'nullable'  =>  false
            ],
            "IP Address"
        )->addColumn(
            "action_type",
            Table::TYPE_TEXT,
            300,
            [
                'nullable'  =>  false
            ],
            "Action Type"
        )->addColumn(
            "action_data",
            Table::TYPE_TEXT,
            null,
            [
                'nullable'  =>  false
            ],
            "Action Data (JSON)"
        )->addColumn(
            "post_action_messages",
            Table::TYPE_TEXT,
            null,
            [
                'nullable'  =>  false
            ],
            "Action Messages (JSON)"
        )->addColumn(
            "created_at",
            Table::TYPE_TIMESTAMP,
            null,
            [ 'nullable' => false, 'default' => Table::TIMESTAMP_INIT ],
            "Created At"
        )->addForeignKey(
            $setup->getFkName(
                $adminLogsTableName,
                "username",
                $setup->getTable('admin_user'),
                "username"
            ),
            "username",
            $setup->getTable('admin_user'),
            "username",
            Table::ACTION_NO_ACTION
        );

        $setup->getConnection()->createTable($adminLogsTable);

        $setup->endSetup();
    }
}