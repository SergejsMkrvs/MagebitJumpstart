<?php
/**
 * @copyright Copyright (c) 2024 Magebit, Ltd. (https://magebit.com/)
 * @author    Magebit
 * @license   MIT
 */
namespace Magebit\Faq\Model;

use Magebit\Faq\Api\QuestionManagementInterface;
use Magebit\Faq\Api\QuestionRepositoryInterface;
use Magento\Framework\Exception\NoSuchEntityException;

class QuestionManagement implements QuestionManagementInterface
{
    /**
     * @var QuestionRepositoryInterface
     */
    protected $questionRepository;

    /**
     * Constructor
     *
     * @param QuestionRepositoryInterface $questionRepository
     */
    public function __construct(QuestionRepositoryInterface $questionRepository)
    {
        $this->questionRepository = $questionRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function enableQuestion($id)
    {
        $question = $this->questionRepository->get($id);
        $question->setStatus(1);
        $this->questionRepository->save($question);
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function disableQuestion($id)
    {
        $question = $this->questionRepository->get($id);
        $question->setStatus(0);
        $this->questionRepository->save($question);
        return true;
    }
}
