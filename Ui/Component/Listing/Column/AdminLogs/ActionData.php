<?php
/**
 *
 * @package     magento2
 * @author      Codilar Technologies
 * @license     https://opensource.org/licenses/OSL-3.0 Open Software License v. 3.0 (OSL-3.0)
 * @link        http://www.codilar.com/
 */

namespace Codilar\AdminLogs\Ui\Component\Listing\Column\AdminLogs;


use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\User\Model\UserFactory;
use Magento\User\Model\ResourceModel\User as UserResource;

class ActionData extends Column
{
    /**
     * @var UserFactory
     */
    private $userFactory;
    /**
     * @var UserResource
     */
    private $userResource;
    /**
     * @var UrlInterface
     */
    private $url;

    /**
     * Username constructor.
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param UrlInterface $url
     * @param UserFactory $userFactory
     * @param UserResource $userResource
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $url,
        UserFactory $userFactory,
        UserResource $userResource,
        array $components = [],
        array $data = []
    )
    {
        parent::__construct($context, $uiComponentFactory, $components, $data);
        $this->url = $url;
        $this->userFactory = $userFactory;
        $this->userResource = $userResource;
    }

    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                $item[$this->getData('name')] = $this->getFormattedActionData(\json_decode($item[$this->getData('name')], true));
            }
        }
        return $dataSource;
    }

    protected function getFormattedActionData($actionData) {
        $textLength = 100;
        $dataLength = 5;
        if (is_array($actionData)) {
            $html = '';
            if (count($actionData) > $dataLength) {
                $actionData = array_slice($actionData, 0, $dataLength);
                $actionData[null] = "...";
            }
            foreach ($actionData as $key => $value) {
                if (is_array($value)) {
                    $value = \json_encode($value);
                }
                if (strlen($value) > $textLength) {
                    $value = substr($value, 0, $textLength) . "...";
                }
                if ($key) {
                    $html .= "<p><b>$key</b>: $value</p>";
                } else {
                    $html .= "<p>$value</p>";
                }
            }
            return $html;
        } else {
            return $actionData;
        }
    }

}