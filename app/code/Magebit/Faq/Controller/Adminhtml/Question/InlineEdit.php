<?php
/**
 * @copyright Copyright (c) 2024 Magebit, Ltd. (https://magebit.com/)
 * @author    Magebit
 * @license   MIT
 */

namespace Magebit\Faq\Controller\Adminhtml\Question;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\Result\JsonFactory;
use Magebit\Faq\Api\QuestionRepositoryInterface;
use Magento\Framework\Exception\LocalizedException;
use Magebit\Faq\Api\Data\QuestionInterface;

/**
 * Class InlineEdit
 * Handles the inline edit functionality for FAQ questions.
 */
class InlineEdit extends Action
{
    /**
     * @var QuestionRepositoryInterface
     */
    private $questionRepository;

    /**
     * @var JsonFactory
     */
    private $jsonFactory;

    /**
     * Constructor
     *
     * @param Action\Context $context
     * @param QuestionRepositoryInterface $questionRepository
     * @param JsonFactory $jsonFactory
     */
    public function __construct(
        Action\Context $context,
        QuestionRepositoryInterface $questionRepository,
        JsonFactory $jsonFactory
    ) {
        parent::__construct($context);
        $this->questionRepository = $questionRepository;
        $this->jsonFactory = $jsonFactory;
    }

    /**
     * Inline edit action
     *
     * @return \Magento\Framework\Controller\Result\Json
     */
    public function execute()
    {
        /** @var \Magento\Framework\Controller\Result\Json $result */
        $result = $this->jsonFactory->create();
        $postItems = $this->getRequest()->getParam('items', []);

        if (!is_array($postItems) || empty($postItems)) {
            return $result->setData([
                'messages' => [__('Please correct the data sent.')],
                'error' => true,
            ]);
        }

        foreach (array_keys($postItems) as $faqId) {
            try {
                /** @var \Magebit\Faq\Api\Data\QuestionInterface $question */
                $question = $this->questionRepository->get($faqId);
                $questionData = $postItems[$faqId];

                // Update the question object with new data
                foreach ($questionData as $key => $value) {
                    $question->setData($key, $value);
                }

                // Save the updated question object
                $this->questionRepository->save($question);
            } catch (LocalizedException $e) {
                return $result->setData([
                    'messages' => [$e->getMessage()],
                    'error' => true,
                ]);
            } catch (\Exception $e) {
                return $result->setData([
                    'messages' => [__('Something went wrong while saving the FAQ.')],
                    'error' => true,
                ]);
            }
        }

        return $result->setData([
            'messages' => [__('You have successfully saved the FAQ.')],
            'error' => false,
        ]);
    }
}
