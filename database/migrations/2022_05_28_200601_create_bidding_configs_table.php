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
        Schema::create('bidding_configs', function (Blueprint $table) {
            $table->id();
            $table->float('amount', 11, 2);
            $table->float('aux_amount', 11, 2);
            $table->integer('percentage_amount');
            $table->boolean('is_send_notification')->default(false);
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->softDeletes('deleted_at', 0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bidding_configs');
    }
};
