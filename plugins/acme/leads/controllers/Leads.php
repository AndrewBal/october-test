<?php namespace Acme\Leads\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

/**
 * Leads Backend Controller
 */
class Leads extends Controller
{
    /**
     * @var array Behaviors implemented by this controller.
     */
    public $implement = [
        \Backend\Behaviors\ListController::class,
        \Backend\Behaviors\FormController::class,
    ];

    /**
     * @var string Config file for ListController behavior.
     */
    public $listConfig = 'config_list.yaml';

    /**
     * @var string Config file for FormController behavior.
     */
    public $formConfig = 'config_form.yaml';

    /**
     * @var array Required permissions to access this controller.
     */
    public $requiredPermissions = ['acme.leads.access_leads'];

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Acme.Leads', 'leads');
    }
}