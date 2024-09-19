<?php
/**
 * @copyright Copyright (c) 2024 Magebit, Ltd. (https://magebit.com/)
 * @author    Magebit
 * @license   MIT
 */

namespace Magebit\Faq\Block;

use Magento\Framework\View\Element\Template;
use Magebit\Faq\Model\ResourceModel\Question\CollectionFactory as QuestionCollectionFactory;

class QuestionList extends Template
{
    /**
     * @var QuestionCollectionFactory
     */
    protected $questionCollectionFactory;

    /**
     * Constructor
     *
     * @param Template\Context $context
     * @param QuestionCollectionFactory $questionCollectionFactory
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        QuestionCollectionFactory $questionCollectionFactory,
        array $data = []
    ) {
        $this->questionCollectionFactory = $questionCollectionFactory;
        parent::__construct($context, $data);
    }

    /**
     * Get a collection of FAQ questions sorted by position
     *
     * @return \Magebit\Faq\Model\ResourceModel\Question\Collection
     */
    public function getQuestions()
    {
        $collection = $this->questionCollectionFactory->create();
        $collection->addFieldToFilter('status', 1);
        $collection->setOrder('position', 'ASC');

        return $collection;
    }
}
