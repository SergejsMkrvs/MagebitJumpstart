<?php
/**
 * @copyright Copyright (c) 2024 Magebit, Ltd. (https://magebit.com/)
 * @author    Magebit
 * @license   MIT
 */

declare(strict_types=1);

namespace Magebit\Faq\Model\Question;

use Magebit\Faq\Model\Question;
use Magebit\Faq\Model\QuestionFactory;
use Magebit\Faq\Model\ResourceModel\Question as QuestionResource;
use Magebit\Faq\Model\ResourceModel\Question\CollectionFactory;
use Magento\Framework\App\RequestInterface;
use Magento\Ui\DataProvider\Modifier\PoolInterface;
use Magento\Ui\DataProvider\ModifierPoolDataProvider;

class DataProvider extends ModifierPoolDataProvider
{
    /**
     * @var array
     */
    private array $loadedData;

    /**
     * DataProvider constructor
     *
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $collectionFactory
     * @param QuestionResource $resource
     * @param QuestionFactory $questionFactory
     * @param RequestInterface $request
     * @param array $meta
     * @param array $data
     * @param PoolInterface|null $pool
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        private QuestionResource $resource,
        private QuestionFactory $questionFactory,
        private RequestInterface $request,
        array $meta = [],
        array $data = [],
        PoolInterface $pool = null
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data, $pool);
        $this->collection = $collectionFactory->create();
    }

    public function getData() : array {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $post = $this->getCurrentQuestion();
        $this->loadedData[$post->getId()] = $post->getData();

        return $this->loadedData;
    }

    /**
     *
     * @return Question
     */
    private function getCurrentQuestion(): Question {
        $questionId = $this->getQuestionId();
        $question = $this->questionFactory->create();
        if (!$questionId) {
            return $question;
        }

        $this->resource->load($question, $questionId);

        return $question;
    }

    /**
     *
     * @return int
     */
    private function getQuestionId(): int {
        return (int) $this->request->getParam($this->getRequestFieldName());
    }
}
