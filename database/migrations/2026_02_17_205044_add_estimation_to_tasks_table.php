<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEstimationToTasksTable extends Migration
{
    public function up()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->unsignedSmallInteger('estimated_time')->nullable()->after('status');
            $table->enum('estimated_unit', ['minutos', 'horas', 'dias'])->nullable()->after('estimated_time');
        });
    }

    public function down()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropColumn(['estimated_time', 'estimated_unit']);
        });
    }
}
