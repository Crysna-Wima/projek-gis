<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTokenableIdColumnTypeInPersonalAccessTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('personal_access_tokens', function (Blueprint $table) {
            // Create a temporary column to store the converted UUID values
            Schema::table('personal_access_tokens', function (Blueprint $table) {
                $table->uuid('new_tokenable_id')->nullable();
            });

            // Convert existing bigint values to UUID and store in the new column
            DB::table('personal_access_tokens')->orderBy('id')->chunk(200, function ($tokens) {
                foreach ($tokens as $token) {
                    DB::table('personal_access_tokens')
                        ->where('id', $token->id)
                        ->update(['new_tokenable_id' => (string) $token->tokenable_id]);
                }
            });

            // Remove the old bigint column
            Schema::table('personal_access_tokens', function (Blueprint $table) {
                $table->dropColumn('tokenable_id');
            });

            // Rename the new column to tokenable_id
            Schema::table('personal_access_tokens', function (Blueprint $table) {
                $table->renameColumn('new_tokenable_id', 'tokenable_id');
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('personal_access_tokens', function (Blueprint $table) {
            $table->bigIncrements('tokenable_id')->change();
        });
    }
}
