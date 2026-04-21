<?php namespace Acme\Leads\Models;

use Model;

/**
 * Lead Model
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $message
 * @property string $status
 */
class Lead extends Model
{
    use \October\Rain\Database\Traits\Validation;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'acme_leads_leads';

    /**
     * @var array Allowed statuses for a lead.
     */
    public const STATUSES = [
        'new' => 'New',
        'contacted' => 'Contacted',
        'closed' => 'Closed',
    ];

    /**
     * @var array Fillable fields.
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'message',
        'status',
    ];

    /**
     * @var array Validation rules.
     */
    public $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'required|string|max:50',
        'message' => 'required|string|min:5',
        'status' => 'required|in:new,contacted,closed',
    ];

    /**
     * @var array Custom validation attribute names (used in error messages).
     */
    public $attributeNames = [
        'name' => 'Name',
        'email' => 'Email',
        'phone' => 'Phone',
        'message' => 'Message',
        'status' => 'Status',
    ];

    /**
     * Returns the list of statuses for dropdowns (backend form, filters).
     */
    public function getStatusOptions(): array
    {
        return self::STATUSES;
    }
}