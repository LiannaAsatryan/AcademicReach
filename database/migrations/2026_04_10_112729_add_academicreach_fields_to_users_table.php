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
        Schema::table('users', function (Blueprint $table) {
            $table->string('niche')->nullable()->after('password');
            $table->string('goal')->nullable()->after('niche');
            $table->enum('tone', ['formal', 'friendly', 'academic'])->default('friendly')->after('goal');
            $table->string('target_audience')->nullable()->after('tone');
            $table->text('offer')->nullable()->after('target_audience');
            $table->boolean('onboarding_completed')->default(false)->after('offer');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'niche',
                'goal',
                'tone',
                'target_audience',
                'offer',
                'onboarding_completed',
            ]);
        });
    }
};
