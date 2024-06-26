<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


class CreateMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid')->nullable();
            $table->string('name');
            $table->string('permission')->nullable();
            $table->string('url')->default('#');
            $table->integer('order_no')->default('0');
            $table->string('icon')->nullable();
            $table->integer('parent_id')->default(0);
            $table->string('type')->default('dashboard');
            $table->char('status', 1)->default('y');
            $table->uuid('created_by')->nullable();
            $table->uuid('updated_by')->nullable();
            $table->timestamps();
        });

        DB::unprepared("
        CREATE OR REPLACE FUNCTION uuid_menus()
        RETURNS TRIGGER
        LANGUAGE plpgsql
        AS $$
        BEGIN
            IF NEW.uuid IS NULL THEN
              NEW.uuid := uuid_generate_v4();
            END IF;
           RETURN NEW;
        END;
        $$;

        CREATE TRIGGER uuid_menus
        BEFORE INSERT ON menu
        FOR EACH ROW EXECUTE PROCEDURE uuid_menus();
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared("DROP TRIGGER   [IF EXISTS]  `before_insert_menus`");
        Schema::dropIfExists('menu');
    }
}
