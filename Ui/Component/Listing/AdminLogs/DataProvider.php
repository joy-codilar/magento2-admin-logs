<?php
/**
 *
 * @package     magento2
 * @author      Codilar Technologies
 * @license     https://opensource.org/licenses/OSL-3.0 Open Software License v. 3.0 (OSL-3.0)
 * @link        http://www.codilar.com/
 */

namespace Codilar\AdminLogs\Ui\Component\Listing\AdminLogs;


use Codilar\AdminLogs\Api\AdminLogsRepositoryInterface;
use Magento\Ui\DataProvider\AbstractDataProvider;

class DataProvider extends AbstractDataProvider
{
    public function __construct(
        string $name,
        string $primaryFieldName,
        string $requestFieldName,
        AdminLogsRepositoryInterface $adminLogsRepository,
        array $meta = [],
        array $data = []
    )
    {
        $this->collection = $adminLogsRepository->getCollection();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }
}