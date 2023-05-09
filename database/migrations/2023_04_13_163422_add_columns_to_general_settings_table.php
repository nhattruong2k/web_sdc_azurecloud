<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('general_settings', function (Blueprint $table) {
            $table->string('mailer')->nullable()->after('google_analytics');
            $table->string('host')->nullable()->after('mailer');
            $table->integer('port')->nullable()->after('host');
            $table->string('use_name')->nullable()->after('port');
            $table->string('password')->nullable()->after('use_name');
            $table->string('encrytion')->nullable()->after('password');
            $table->string('from_address')->nullable()->after('encrytion');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('general_settings', function (Blueprint $table) {
            //
        });
    }
};
