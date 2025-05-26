<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'display_name')) {
                $table->string('display_name')->nullable();
            }

            if (!Schema::hasColumn('users', 'real_name')) {
                $table->string('real_name')->nullable();
            }

            if (!Schema::hasColumn('users', 'phone')) {
                $table->string('phone')->nullable();
            }
        });
    }


    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['display_name', 'real_name', 'phone']);
        });
    }

};