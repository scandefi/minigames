<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRoundColumnToScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('scores', function (Blueprint $table) {
            $table->foreignId('round_id')->constrained('rounds')->after('score');
            $table->string('round_name')->after('round_id');
        });

        DB::table('scores')->where('round_id', NULL)->update(['round_id' => 1, 'round_name' => '1']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('scores', function (Blueprint $table) {
            $table->dropColumn('round_id');
            $table->dropColumn('round_name');
        });
    }
}
