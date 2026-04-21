<?php if ($this->user->hasAccess('acme.leads.access_leads')): ?>
    <div data-control="toolbar">
        
        <a
            href="<?= Backend::url('acme/leads/leads/create') ?>"
            class="btn btn-primary oc-icon-plus">
            New Lead
        </a>

        <button
            class="btn btn-default oc-icon-trash-o"
            disabled="disabled"
            onclick="$(this).data('request-data', {checked: $('.control-list').listWidget('getChecked')})"
            data-request="onDelete"
            data-request-confirm="Delete selected leads?"
            data-trigger-action="enable"
            data-trigger=".control-list input[type=checkbox]"
            data-trigger-condition="checked"
            data-request-success="$(this).prop('disabled', 'disabled')"
            data-stripe-load-indicator>
            Delete selected
        </button>
    </div>
<?php endif ?>