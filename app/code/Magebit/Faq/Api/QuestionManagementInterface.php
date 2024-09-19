<?php
/**
 * @copyright Copyright (c) 2024 Magebit, Ltd. (https://magebit.com/)
 * @author    Magebit
 * @license   MIT
 */

namespace Magebit\Faq\Api;

interface QuestionManagementInterface
{
    /**
     * Enable a question.
     *
     * @param int $id
     * @return bool
     */
    public function enableQuestion($id);

    /**
     * Disable a question.
     *
     * @param int $id
     * @return bool
     */
    public function disableQuestion($id);
}
