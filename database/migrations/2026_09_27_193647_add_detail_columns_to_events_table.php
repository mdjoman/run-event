<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('events', function (Blueprint $table) {

            if (!Schema::hasColumn('events', 'subtitle')) {
                $table->string('subtitle')->nullable()->after('title');
            }
            if (!Schema::hasColumn('events', 'presented_by')) {
                $table->string('presented_by')->nullable()->after('subtitle');
            }
            if (!Schema::hasColumn('events', 'tagline')) {
                $table->string('tagline')->nullable()->after('presented_by');
            }
            if (!Schema::hasColumn('events', 'hero_image')) {
                $table->string('hero_image')->nullable()->after('image');
            }
            if (!Schema::hasColumn('events', 'race_type')) {
                $table->string('race_type')->default('Live Road Race')->after('description');
            }
            if (!Schema::hasColumn('events', 'organizer')) {
                $table->string('organizer')->nullable()->after('race_type');
            }
            if (!Schema::hasColumn('events', 'is_featured')) {
                $table->boolean('is_featured')->default(false)->after('organizer');
            }

            // JSON blocks
            if (!Schema::hasColumn('events', 'categories')) {
                $table->json('categories')->nullable()->after('is_featured');
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
        });
    }

    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn([
                'subtitle', 'presented_by', 'tagline', 'hero_image',
                'race_type', 'organizer', 'is_featured',
                'categories', 'entitlements', 'awards', 'schedules', 'rules',
            ]);
        });
    }
};