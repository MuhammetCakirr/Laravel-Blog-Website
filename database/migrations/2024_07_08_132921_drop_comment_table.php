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
        Schema::dropIfExists('comment');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('comment', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->foreignId('post_id')->constrained('post');
            $table->foreignId('reply_id')->nullable()->constrained('comment');
            $table->string('guest_name')->nullable();
            $table->string('guest_email')->nullable();
            $table->text("content");
            $table->timestamps();
        });
    }
};
