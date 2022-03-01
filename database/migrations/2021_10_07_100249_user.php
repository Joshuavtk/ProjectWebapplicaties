<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use \Illuminate\Support\Str;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $blueprint) {
            $blueprint->uuid('id')->primary()->default('uuid()');
            $blueprint->string('email');
            $blueprint->string('password');
            $blueprint->smallInteger('role')->default(User::USER_ROLE_USER);
            $blueprint->smallInteger('subscription')->default(User::SUBSCRIPTION_BASIC);
            $blueprint->smallInteger('validation_code')->nullable();
            $blueprint->timestamps();
            $blueprint->softDeletes();

            $blueprint->foreign('created_by')->references('id')->on('users');
            $blueprint->foreign('updated_by')->references('id')->on('users');
        });

        /**
         * Maak een validatie code nadat het record is op geslagen.
         */
        DB::unprepared('
        CREATE TRIGGER trigger_insert_validate_code_after_insert AFTER INSERT ON `users` FOR EACH ROW
            BEGIN
                update `users` set `validation_code` = LPAD(FLOOR(RAND() * 999999.99), 6, "0") where `id` = new.id;
            END
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
