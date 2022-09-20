<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {

            $table->foreignId('client_id')->nullable()->references('id')->on('clients')->onDelete('cascade')->onUpdate('cascade');
            $table->string('status')->default('Active')->index();
            $table->string('profile_image')->nullable();
            $table->foreignId('created_by')->default(null)->nullable()->after('created_at')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamp('deleted_at')->nullable();
            $table->foreignId('deleted_by')->nullable()->constrained('users')->nullable()->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {

            $table->dropForeign('users_created_by_foreign');
            $table->dropColumn('created_by');

            $table->dropForeign('users_updated_by_foreign');
            $table->dropColumn('updated_by');

            $table->dropColumn('deleted_at');

            $table->dropForeign('users_deleted_by_foreign');
            $table->dropColumn('deleted_by');

            // $table->dropColumn('updated_by');
            // $table->dropColumn('deleted_at');
            // $table->dropColumn('deleted_by');


        });
    }
}
