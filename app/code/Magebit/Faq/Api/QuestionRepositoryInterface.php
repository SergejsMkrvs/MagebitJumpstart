<?php
/**
 * @copyright Copyright (c) 2024 Magebit, Ltd. (https://magebit.com/)
 * @author    Magebit
 * @license   MIT
 */

namespace Magebit\Faq\Api;

use Magebit\Faq\Api\Data\QuestionInterface;
use Magebit\Faq\Api\Data\QuestionSearchResultsInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

interface QuestionRepositoryInterface
{
    /**
     * Get FAQ by ID
     *
     * @param int $id
     * @return \Magebit\Faq\Api\Data\QuestionInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function get($id);

    /**
     * Save FAQ
     *
     * @param \Magebit\Faq\Api\Data\QuestionInterface $question
     * @return \Magebit\Faq\Api\Data\QuestionInterface
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function save(QuestionInterface $question);

    /**
     * Retrieve FAQs matching the specified criteria.
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Magebit\Faq\Api\Data\QuestionSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria);

    /**
     * Delete FAQ
     *
     * @param \Magebit\Faq\Api\Data\QuestionInterface $question
     * @return bool
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function delete(QuestionInterface $question);

    /**
     * Delete FAQ by ID
     *
     * @param int $id
     * @return bool
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function deleteById($id);
}
