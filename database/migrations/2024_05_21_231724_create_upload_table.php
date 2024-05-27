<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('upload', function (Blueprint $table) {
            $table->increments('id');
            $table->string('url')->default('wtf');
            $table->string('related_table');
            $table->integer('related_table_id');
            $table->boolean('deleted')->default(false);
            $table->boolean('main')->default(true);
            $table->timestamps();

            $table->index(['related_table', 'related_table_id']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('upload');
    }
};
