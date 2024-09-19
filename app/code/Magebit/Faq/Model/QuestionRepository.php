<?php
/**
 * @copyright Copyright (c) 2024 Magebit, Ltd. (https://magebit.com/)
 * @author    Magebit
 * @license   MIT
 */
namespace Magebit\Faq\Model;

use Magebit\Faq\Api\QuestionRepositoryInterface;
use Magebit\Faq\Api\Data\QuestionInterface;
use Magebit\Faq\Model\ResourceModel\Question as ResourceQuestion;
use Magebit\Faq\Model\ResourceModel\Question\CollectionFactory as QuestionCollectionFactory;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\StateException;

class QuestionRepository implements QuestionRepositoryInterface
{
    protected $resource;
    protected $questionFactory;
    protected $collectionFactory;

    public function __construct(
        ResourceQuestion $resource,
        QuestionFactory $questionFactory,
        QuestionCollectionFactory $collectionFactory
    ) {
        $this->resource = $resource;
        $this->questionFactory = $questionFactory;
        $this->collectionFactory = $collectionFactory;
    }

    public function get($id)
    {
        $question = $this->questionFactory->create();
        $this->resource->load($question, $id);
        if (!$question->getId()) {
            throw new NoSuchEntityException(__('Question with id "%1" does not exist.', $id));
        }
        return $question;
    }

    public function save(QuestionInterface $question)
    {
        try {
            $this->resource->save($question);
        } catch (\Exception $e) {
            throw new CouldNotSaveException(__('Could not save the question: %1', $e->getMessage()));
        }
        return $question;
    }

    public function delete(QuestionInterface $question)
    {
        try {
            $this->resource->delete($question);
        } catch (\Exception $e) {
            throw new CouldNotDeleteException(__('Could not delete the question: %1', $e->getMessage()));
        }
        return true;
    }

    public function deleteById($id)
    {
        $question = $this->get($id);
        return $this->delete($question);
    }

    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        $collection = $this->collectionFactory->create();
        // Apply filters based on $searchCriteria
        return $collection;
    }
}
