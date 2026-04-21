# Acme.Leads

OctoberCMS v3+ plugin that provides a public "contact leads" form with
AJAX submission and a backend UI to manage submitted leads.

## Features

- Public `leadForm` CMS component with October AJAX submission (no raw
  `fetch` / jQuery).
- Server-side validation with inline field errors (`ValidationException`).
- Backend list with search, filter by status, row checkboxes, and a
  custom "Mark as contacted" row action that refreshes the list in place
  via AJAX.
- Backend form with an editable status dropdown.
- Permission-gated backend access (`acme.leads.access_leads`).

## Requirements

- OctoberCMS v3+
- PHP 8.1+
- MySQL 5.7+ / MariaDB 10.3+ (or any DB supported by October)

## Installation

1. Clone the plugin into your October project:

```bash
   git clone https://github.com/AndrewBal/leads-october plugins/acme/leads
```

2. Run migrations:

```bash
   php artisan october:migrate
```

3. Ensure your frontend layout includes the October AJAX framework
   (usually in your theme's `layouts/default.htm` inside `<head>`):

```twig
   {% framework extras %}
```

   Without this, the form will fall back to a normal page reload.

4. (Optional) Assign the `acme.leads.access_leads` permission to the
   backend roles that should manage leads.

## Adding the form to a page

Create (or open) any CMS page in your theme and drop the component:

```twig
title = "Contact"
url = "/contact"
layout = "default"

[leadForm]
==
<div class="container">
    <h1>Contact us</h1>
    {% component 'leadForm' %}
</div>
```

That's it — the form renders, submits via AJAX, shows inline errors on
validation failure, and replaces itself with a "thanks" partial on
success.

## Backend

After installation, a "Leads" item appears in the backend main menu.
Columns: Name, Email, Phone, Status, Created.

- Click a row to edit a lead.
- Use the Status filter in the sidebar to narrow down the list.
- "Mark as contacted" button on each `new` lead updates the status and
  refreshes the list without a full page reload.

## Design notes & assumptions

- **Status** is stored as `VARCHAR(20)` with a default of `new`, not a
  MySQL `ENUM`. Easier to migrate and to extend; allowed values are
  enforced at the model level (`in:new,contacted,closed`).
- Allowed statuses live in a single source of truth —
  `Lead::STATUSES` — and are reused in the backend dropdown, filter,
  and validation rules via `getStatusOptions()`.
- The component sets `status = 'new'` server-side for every new
  submission, so the frontend form never has to send it.
- `ModelException` from the validation trait is caught and re-thrown
  as `ValidationException` so the October AJAX framework can render
  inline field errors automatically.
- The `message` column is intentionally omitted from the list — it
  would be noisy; it is visible in the edit form.

## What I'd improve given more time

- **Per-IP / per-email rate limiting** on submission — the current form
  has nothing between a bot and the database.
- **Extract a `LeadStatus` enum** (PHP 8.1) instead of a const array,
  and use it in rules / dropdowns for tighter typing.
- **Dispatch a `leads.created` event** so other plugins (mailer,
  Slack notifier, CRM sync) can react without modifying this plugin.
- **Backend tests** — at minimum a feature test covering the AJAX
  submission flow (valid submit, validation errors, Mark as contacted).
- **Honeypot field** on the frontend form as a lightweight anti-spam
  measure that keeps the UX clean.