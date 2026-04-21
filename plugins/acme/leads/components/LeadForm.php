<?php namespace Acme\Leads\Components;

use Flash;
use ValidationException;
use Cms\Classes\ComponentBase;
use Acme\Leads\Models\Lead;
use October\Rain\Database\ModelException;

/**
 * LeadForm Component
 *
 * Renders a public lead submission form and handles AJAX submission.
 */
class LeadForm extends ComponentBase
{
    public function componentDetails(): array
    {
        return [
            'name' => 'Lead Form',
            'description' => 'Renders a public contact-leads form with AJAX submission.',
        ];
    }

    /**
     * AJAX handler for form submission.
     *
     * On success: renders the "thanks" partial in place of the form.
     * On validation error: throws ValidationException so the AJAX framework
     * can display inline field errors automatically.
     */
    public function onSubmit(): array
    {
        $data = array_merge(post(), ['status' => 'new']);

        $lead = new Lead();
        $lead->fill($data);

        try {
            $lead->save();
        } catch (ModelException $e) {
            throw new ValidationException($e->getErrors());
        }

        Flash::success('Thanks, we\'ll be in touch.');

        return [
            '#leadFormWrapper' => $this->renderPartial('@thanks'),
        ];
    }
}