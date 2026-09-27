<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('events', function (Blueprint $table) {

            // ---- Basic meta ----
            if (!Schema::hasColumn('events', 'subtitle')) {
                $table->string('subtitle')->nullable()->after('title');
            }
            if (!Schema::hasColumn('events', 'presented_by')) {
                $table->string('presented_by')->nullable()->after('subtitle');
            }
            if (!Schema::hasColumn('events', 'hero_image')) {
                $table->string('hero_image')->nullable()->after('image');
            }
            if (!Schema::hasColumn('events', 'tagline')) {
                $table->string('tagline')->nullable()->after('hero_image');
            }

            // ---- JSON detail blocks ----
            if (!Schema::hasColumn('events', 'categories')) {
                $table->json('categories')->nullable()->after('description');
            }
            if (!Schema::hasColumn('events', 'entitlements')) {
                $table->json('entitlements')->nullable()->after('categories');
            }
            if (!Schema::hasColumn('events', 'awards')) {
                $table->json('awards')->nullable()->after('entitlements');
            }
            if (!Schema::hasColumn('events', 'schedules')) {
                $table->json('schedules')->nullable()->after('awards');
            }
            if (!Schema::hasColumn('events', 'rules')) {
                $table->json('rules')->nullable()->after('schedules');
            }

            // ---- Race day meta ----
            if (!Schema::hasColumn('events', 'race_type')) {
                $table->string('race_type')->default('Live Road Race')->after('rules');
            }
            if (!Schema::hasColumn('events', 'organizer')) {
                $table->string('organizer')->nullable()->after('race_type');
            }

            // ---- Flag ----
            if (!Schema::hasColumn('events', 'is_featured')) {
                $table->boolean('is_featured')->default(false)->after('organizer');
            }
        });
    }

    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn([
                'subtitle', 'presented_by', 'hero_image', 'tagline',
                'categories', 'entitlements', 'awards', 'schedules', 'rules',
                'race_type', 'organizer', 'is_featured',
            ]);
        });
    }
};