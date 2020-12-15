<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('uuid')->unique();
            $table->integer('userid');
            $table->string('title');
            $table->text('lead');
            $table->longText('content');
            $table->string('image');
            $table->string('submissionid')->unique();
            $table->timestamps();
        });

        DB::unprepared('CREATE TRIGGER `InsertContent` BEFORE INSERT ON `content` FOR EACH ROW BEGIN 
            SET NEW.created_at = NOW();
            IF NEW.uuid = "" OR NEW.uuid IS NULL THEN
                SET NEW.uuid = UUID();
            END IF;	
        END');

        DB::unprepared('CREATE TRIGGER `UpdateContent` BEFORE INSERT ON `content` FOR EACH ROW BEGIN
	        SET NEW.updated_at = NOW();
        END');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('content');
        DB::unprepared('DROP TRIGGER `InsertContent`');
        DB::unprepared('DROP TRIGGER `UpdateContent`');
    }
}
