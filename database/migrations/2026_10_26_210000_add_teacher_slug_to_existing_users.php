<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Sluggable\Actions\GenerateSlugAction;
use Spatie\Sluggable\Support\SluggableAttributeResolver;

return new class extends Migration
{
    public function up(): void
    {
        // The teacher added slug to the original create-users migration.
        // Existing databases have already run it, so apply that change here too.
        if (! Schema::hasColumn('users', 'slug')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('slug')->nullable()->unique();
            });

            User::query()->eachById(function (User $user) {
                app(GenerateSlugAction::class)->generate($user, SluggableAttributeResolver::resolveOptions(User::class));
                $user->saveQuietly();
            });

            Schema::table('users', function (Blueprint $table) {
                $table->string('slug')->nullable(false)->change();
            });
        }
    }

    public function down(): void
    {
        // Keep the column: it is also part of the teacher's initial schema.
    }
};
