<?php

namespace Kanboard\Plugin\Solential\Action;

use Kanboard\Action\Base;
use Kanboard\Model\ProjectGroupRoleModel;
use Kanboard\Model\TaskModel;

class RemoveTaskDueDateAction extends Base
{
    /**
     * Get automatic action description
     *
     * @return string
     */
    public function getDescription()
    {
        return t('Remove due date when moved to a specific column');
    }

    /**
     * Get the list of compatible events.
     *
     * @return array
     */
    public function getCompatibleEvents()
    {
        return [
            TaskModel::EVENT_MOVE_COLUMN,
        ];
    }

    /**
     * Get the required parameter for the action (defined by the user).
     *
     * @return array
     */
    public function getActionRequiredParameters()
    {
        return [
            'column_id' => t('Column'),
        ];
    }

    /**
     * Get the required parameter for the event.
     *
     * @return string[]
     */
    public function getEventRequiredParameters()
    {
        return [
            'task_id',
            'task' => [
                'project_id',
                'column_id',
            ],
        ];
    }

    /**
     * Execute the action.
     *
     * @param array $data Event data dictionary
     *
     * @return bool True if the action was executed or False when not executed
     */
    public function doAction(array $data)
    {
        $values = array(
            'id' => $data['task_id'],
            'date_due' => null,
        );

        return $this->taskModificationModel->update($values);
    }

    /**
     *Check if the event data meet the action condition.
     *
     * @param array $data Event data dictionary
     *
     * @return bool
     */
    public function hasRequiredCondition(array $data)
    {
        return $data['task']['column_id'] == $this->getParam('column_id');
        //return true;
    }
}
