<?php
/**
 * Row action partial for the leads list.
 *
 * Context provided by ListController:
 * @var \Acme\Leads\Models\Lead $record
 */

if ($record->status !== 'new') {
    return;
}
?>
<button
    type="button"
    class="btn btn-default btn-sm"
    data-request="onMarkContacted"
    data-request-data="record_id: <?= (int) $record->id ?>"
    data-load-indicator="Updating...">
    Mark as contacted
</button>