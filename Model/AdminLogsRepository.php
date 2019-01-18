<?php
/**
 *
 * @package     magento2
 * @author      Codilar Technologies
 * @license     https://opensource.org/licenses/OSL-3.0 Open Software License v. 3.0 (OSL-3.0)
 * @link        http://www.codilar.com/
 */

namespace Codilar\AdminLogs\Model;


use Codilar\AdminLogs\Api\AdminLogsRepositoryInterface;
use Magento\Framework\App\State as AppState;
use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Codilar\AdminLogs\Api\Data\AdminLogsInterfaceFactory as ModelFactory;
use Codilar\AdminLogs\Model\ResourceModel\AdminLogs as ResourceModel;
use \Codilar\AdminLogs\Model\ResourceModel\AdminLogs\CollectionFactory;

class AdminLogsRepository implements AdminLogsRepositoryInterface
{

    /**
     * @var \Codilar\AdminLogs\Api\Data\AdminLogsInterface[]
     */
    private $modelCache = [];

    /**
     * @var ModelFactory
     */
    private $modelFactory;
    /**
     * @var ResourceModel
     */
    private $resourceModel;
    /**
     * @var CollectionFactory
     */
    private $collectionFactory;
    /**
     * @var AppState
     */
    private $appState;

    /**
     * AdminLogsRepository constructor.
     * @param ModelFactory $modelFactory
     * @param ResourceModel $resourceModel
     * @param CollectionFactory $collectionFactory
     * @param AppState $appState
     */
    public function __construct(
        ModelFactory $modelFactory,
        ResourceModel $resourceModel,
        CollectionFactory $collectionFactory,
        AppState $appState
    )
    {
        $this->modelFactory = $modelFactory;
        $this->resourceModel = $resourceModel;
        $this->collectionFactory = $collectionFactory;
        $this->appState = $appState;
    }

    /**
     * @param string $value
     * @param string|null $field
     * @return \Codilar\AdminLogs\Api\Data\AdminLogsInterface
     * @throws NoSuchEntityException
     */
    public function load($value, $field = null)
    {
        $cacheKey = $this->getCacheKey(null, $value, $field);
        if (!array_key_exists($cacheKey, $this->modelCache)) {
            $model = $this->create();
            $this->resourceModel->load($model, $value, $field);
            if (!$model->getId()) {
                throw NoSuchEntityException::singleField($field, $value);
            }
            $this->modelCache[$cacheKey] = $model;
        }
        return $this->modelCache[$cacheKey];
    }

    /**
     * @return \Codilar\AdminLogs\Api\Data\AdminLogsInterface
     */
    public function create()
    {
        return $this->modelFactory->create();
    }

    /**
     * @param \Codilar\AdminLogs\Api\Data\AdminLogsInterface $model
     * @return \Codilar\AdminLogs\Api\Data\AdminLogsInterface
     * @throws CouldNotSaveException
     */
    public function save(\Codilar\AdminLogs\Api\Data\AdminLogsInterface $model)
    {
        try {
            /** @var AdminLogs $model */
            $model->setData('area', $this->appState->getAreaCode());
            $this->resourceModel->save($model);
        } catch (AlreadyExistsException $e) {
            throw new CouldNotSaveException(__($e->getMessage()));
        } catch (\Exception $e) {
            throw new CouldNotSaveException(__("Some error occurred while saving the model"));
        }
        return $model;
    }

    /**
     * @param \Codilar\AdminLogs\Api\Data\AdminLogsInterface $model
     * @return $this
     * @throws CouldNotDeleteException
     */
    public function delete(\Codilar\AdminLogs\Api\Data\AdminLogsInterface $model)
    {
        try {
            $this->resourceModel->delete($model);
        } catch (\Exception $e) {
            throw new CouldNotDeleteException(__("Some error occurred while deleting the model"));
        }
        return $this;
    }

    /**
     * @return \Codilar\AdminLogs\Model\ResourceModel\AdminLogs\Collection
     */
    public function getCollection()
    {
        return $this->collectionFactory->create();
    }

    /**
     * @param \Codilar\AdminLogs\Api\Data\AdminLogsInterface $model
     * @param string $value
     * @param string $field
     * @return string
     */
    protected function getCacheKey($model, $value = '', $field = '') {
        if ($model) {
            return $model->getId().$value.$field;
        } else {
            return $value.$field;
        }
    }
}