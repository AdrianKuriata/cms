<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('group_id')->nullable();
            $table->boolean('can_view_admin')->nullable()->default(false);

            // Users
            $table->boolean('can_view_user')->nullable()->default(false);
            $table->boolean('can_create_user')->nullable()->default(false);
            $table->boolean('can_update_user')->nullable()->default(false);
            $table->boolean('can_delete_user')->nullable()->default(false);

            // Groups
            $table->boolean('can_view_group')->nullable()->default(false);
            $table->boolean('can_create_group')->nullable()->default(false);
            $table->boolean('can_update_group')->nullable()->default(false);
            $table->boolean('can_delete_group')->nullable()->default(false);

            // Repositories
            $table->boolean('can_view_repository')->nullable()->default(false);
            $table->boolean('can_create_repository')->nullable()->default(false);
            $table->boolean('can_update_repository')->nullable()->default(false);
            $table->boolean('can_delete_repository')->nullable()->default(false);

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
        Schema::dropIfExists('permissions');
    }
}
