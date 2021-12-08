<?php

namespace Kanboard\Plugin\Solential;

use Kanboard\Core\Plugin\Base;

class Plugin extends Base
{
    public function initialize()
    {
        global $themeSolentialConfig;

        if (file_exists('plugins/Solential/config.php'))
        {
            require_once('plugins/Solential/config.php');
        }

        if (file_exists('plugins/Customizer'))
        {
            $this->template->setTemplateOverride('header/title', 'Solential:layout/header/customizerTitle');
            $this->template->setTemplateOverride('layout', 'Solential:layout');
        }
        elseif (isset($themeSolentialConfig['logo']))
        {
            $this->template->setTemplateOverride('header/title', 'Solential:layout/header/title');
            $this->template->setTemplateOverride('board/table_tasks', 'Solential:layout/board/table_tasks');
            $this->template->setTemplateOverride('layout', 'Solential:layout');
        }
        else
        {
            $this->template->setTemplateOverride('layout', 'Solential:layout');
        }

        $this->hook->on("template:layout:css", array("template" => "plugins/Solential/Assets/css/theme.css"));
        $this->hook->on('template:layout:js', array('template' => 'plugins/Solential/Assets/js/theme.js'));
    }

    public function getPluginName()
    {
        return 'Solential';
    }

    public function getPluginDescription()
    {
        return t('Solential Theme');
    }

    public function getPluginAuthor()
    {
        return 'Kevin Burns';
    }

    public function getPluginVersion()
    {
        return '1.0.0';
    }
    public function getCompatibleVersion()
    {
        return '>=1.0.0';
    }

    public function getPluginHomepage()
    {
        return 'https://github.com/burnsy1882/SolentialKanboard';
    }
}
