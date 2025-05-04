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
        // First check if the table has the etudiant_id column
        if (Schema::hasColumn('evaluations', 'etudiant_id')) {
            Schema::table('evaluations', function (Blueprint $table) {
                // Rename etudiant_id to evalue_id
                $table->renameColumn('etudiant_id', 'evalue_id');
            });
        }
        
        // Now add date_creation column if it doesn't exist
        if (!Schema::hasColumn('evaluations', 'date_creation')) {
            Schema::table('evaluations', function (Blueprint $table) {
                $table->timestamp('date_creation')->nullable()->after('commentaire');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // If we need to revert these changes
        if (Schema::hasColumn('evaluations', 'evalue_id')) {
            Schema::table('evaluations', function (Blueprint $table) {
                $table->renameColumn('evalue_id', 'etudiant_id');
            });
        }

        if (Schema::hasColumn('evaluations', 'date_creation')) {
            Schema::table('evaluations', function (Blueprint $table) {
                $table->dropColumn('date_creation');
            });
        }
    }
};