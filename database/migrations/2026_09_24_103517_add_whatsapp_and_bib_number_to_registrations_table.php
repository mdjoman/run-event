<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWhatsappAndBibNumberToRegistrationsTable extends Migration
{
    public function up()
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->string('whatsapp_number', 20)
                ->nullable()
                ->after('phone');

            $table->string('bib_number', 50)
                ->nullable()
                ->after('whatsapp_number');
        });
    }

    public function down()
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->dropColumn([
                'whatsapp_number',
                'bib_number',
            ]);
        });
    }
}