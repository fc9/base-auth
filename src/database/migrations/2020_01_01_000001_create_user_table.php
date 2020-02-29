<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('users');

        $rules = config('auth::validation.rules');
        $username = improveRules($rules['username']);
        $email = improveRules($rules['email']);
        $password = improveRules($rules['password']);
        unset($rules);

        $config = config('auth::parameters.user');
        $status = improve($config['status']);
        $access_profile = improve($config['access_profile']);
        unset($config);

        Schema::create('user', function (Blueprint $table) use ($username, $email, $password, $status, $access_profile) {
            $table->bigIncrements('id')->unsigned();
            $table->unsignedBigInteger('indicator_id')->index()->nullable()->comment('Indicator User Id');
            $table->string('username', $username->max)->unique();
            $table->string('email', $email->max)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 60);
            $table->rememberToken();
            $table->enum('status', $status->values())->default($status->first());
            $table->enum('access_profile', $access_profile->values())->default($access_profile->first());
            $table->timestamp('active_at')->useCurrent();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('indicator_id')->references('id')->on('user')->onUpdate('cascade');

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
        Schema::dropIfExists('user');
    }
}

# php artisan db:seed
# php artisan migrate:refresh --seed --drop-views
