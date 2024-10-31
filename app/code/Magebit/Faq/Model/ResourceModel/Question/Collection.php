<?php
/**
 * @copyright Copyright (c) 2024 Magebit, Ltd. (https://magebit.com/)
 * @author    Magebit
 * @license   MIT
 */
namespace Magebit\Faq\Model\ResourceModel\Question;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Magebit\Faq\Model\Question;
use Magebit\Faq\Model\ResourceModel\Question as QuestionResource;

class Collection extends AbstractCollection
{
    /**
     * Initialize collection model and resource model
     */
    protected function _construct()
    {
        $this->_init(Question::class, QuestionResource::class);
    }
}
