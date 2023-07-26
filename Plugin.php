<?php

namespace Kanboard\Plugin\Solential;

use Kanboard\Core\Plugin\Base;
use Kanboard\Plugin\Solential\Action\ReorderEveryColumnAction;
use Kanboard\Plugin\Solential\Action\RemoveTaskDueDateAction;

class Plugin extends Base
{
    public function initialize()
    {
        global $themeSolentialConfig;

        if (file_exists('plugins/Solential/config.php'))
        {
            require_once('plugins/Solential/config.php');
        }

        $this->template->setTemplateOverride('header/title', 'Solential:layout/header/title');
        $this->template->setTemplateOverride('board/table_tasks', 'Solential:layout/board/table_tasks');
        $this->template->hook->attach('template:auth:login-form:before', 'Solential:layout/auth/index');

        $this->hook->on("template:layout:css", array("template" => "plugins/Solential/Assets/css/theme.css"));
        $this->hook->on('template:layout:js', array('template' => 'plugins/Solential/Assets/js/theme.js'));

        $this->actionManager->register(new ReorderEveryColumnAction($this->container));
        $this->actionManager->register(new RemoveTaskDueDateAction($this->container));
    }

    public function getPluginName()
    {
        return 'Solential';
    }

    public function getPluginDescription()
    {
        return t('Solential theme and plugins');
    }

    public function getPluginAuthor()
    {
        return 'Kevin Burns';
    }

    public function getPluginVersion()
    {
        return '1.2.0';
    }

    public function getCompatibleVersion()
    {
        return '>=1.2.30';
    }

    public function getPluginHomepage()
    {
        return 'https://github.com/burnsy1882/SolentialKanboard';
    }
}
