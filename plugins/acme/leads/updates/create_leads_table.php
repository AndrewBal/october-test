<?php namespace Acme\Leads\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateLeadsTable extends Migration
{
    public function up(): void
    {
        Schema::create('acme_leads_leads', function ($table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->string('email');
            $table->string('phone', 50);
            $table->text('message');
            $table->string('status', 20)->default('new');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('acme_leads_leads');
    }
}