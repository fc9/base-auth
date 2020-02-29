<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePasswordResetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('password_resets');

        $email = improveRules(config('auth::validation.rules.email'));
        $token = improveRules(config('auth::validation.rules.token'));

        Schema::create('password_reset', function (Blueprint $table) use ($email, $token) {
            $table->string('email', $email->max)->index();
            //$table->string('token', $token->size);
            $table->string('token');
            $table->timestamp('created_at')->nullable();

            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_general_ci';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('password_reset');
    }
}
