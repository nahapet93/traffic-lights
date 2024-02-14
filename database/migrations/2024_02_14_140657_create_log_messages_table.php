<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Constants;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('log_messages', function (Blueprint $table) {
            $table->tinyIncrements('id');
            $table->string('message', 100);
        });

        DB::table('log_messages')->insert([
            ['id' => Constants::DRIVE_ON_RED, 'message' => 'Проезд на красный. Штраф!'],
            ['id' => Constants::DRIVE_ON_GREEN, 'message' => 'Проезд на зеленый!'],
            ['id' => Constants::DRIVE_ON_YELLOW_OK, 'message' => 'Успели на желтый!'],
            ['id' => Constants::DRIVE_ON_YELLOW_TOO_SOON, 'message' => 'Слишком рано начали движение!']
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_messages');
    }
};
