<?php namespace Acme\Leads\Controllers;

use BackendMenu;
use Backend\Classes\Controller;

use Flash;
use Acme\Leads\Models\Lead;

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


    /**
     * AJAX handler: mark a lead as contacted.
     *
     * Expects a `record_id` field from the list row. Updates the lead's
     * status to "contacted", flashes a success message, and returns the
     * re-rendered list so the row updates in place.
     */
    public function index_onMarkContacted(): array
    {
        $recordId = post('record_id');

        $lead = Lead::findOrFail($recordId);
        $lead->status = 'contacted';
        $lead->save();

        Flash::success(sprintf('Lead "%s" marked as contacted.', $lead->name));

        return $this->listRefresh();
    }
}