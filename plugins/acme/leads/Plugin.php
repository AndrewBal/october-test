<?php namespace Acme\Leads;

use Backend;
use System\Classes\PluginBase;

/**
 * Leads Plugin Information File
 */
class Plugin extends PluginBase
{
    public function pluginDetails(): array
    {
        return [
            'name' => 'Contact Leads',
            'description' => 'Collects contact leads from a frontend form and manages them in the backend.',
            'author' => 'Acme',
            'icon' => 'icon-envelope',
        ];
    }

    public function registerComponents(): array
    {
        return [
            \Acme\Leads\Components\LeadForm::class => 'leadForm',
        ];
    }

    public function registerNavigation(): array
    {
        return [
            'leads' => [
                'label' => 'Leads',
                'url' => Backend::url('acme/leads/leads'),
                'icon' => 'icon-envelope',
                'permissions' => ['acme.leads.*'],
                'order' => 500,
            ],
        ];
    }

    public function registerPermissions(): array
    {
        return [
            'acme.leads.access_leads' => [
                'tab' => 'Leads',
                'label' => 'Manage leads',
            ],
        ];
    }
}