<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lead_magnets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->enum('format', ['guide', 'checklist', 'template', 'swipe_file']);
            $table->string('title');
            $table->longText('content');
            $table->string('pdf_url')->nullable();
            $table->string('hosted_slug')->unique();
            $table->enum('status', ['draft', 'generated', 'exported'])->default('draft');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lead_magnets');
    }
};
