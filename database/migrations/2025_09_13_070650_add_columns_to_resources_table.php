<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('resources', function (Blueprint $table) {
            $table->string('title')->after('id');
            $table->text('description')->nullable()->after('title');
            $table->enum('type', ['video', 'tool', 'article'])->after('description');
            $table->string('file_path')->nullable()->after('type'); // for uploaded tool/article
            $table->string('url')->nullable()->after('file_path');   // for video/article link
            $table->foreignId('created_by')->nullable()->constrained('users')->after('url')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('resources', function (Blueprint $table) {
            $table->dropColumn(['title', 'description', 'type', 'file_path', 'url', 'created_by']);
        });
    }
};
