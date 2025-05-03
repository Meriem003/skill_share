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
        Schema::table('sessions', function (Blueprint $table) {
            // Ajout des champs pour les réservations
            $table->foreignId('teacher_id')->nullable()->constrained('etudiants')->onDelete('cascade');
            $table->foreignId('student_id')->nullable()->constrained('etudiants')->onDelete('cascade');
            $table->foreignId('skill_id')->nullable()->constrained('skills')->onDelete('set null');
            $table->dateTime('date_session')->nullable();
            $table->integer('duree')->default(60)->comment('Durée en minutes');
            $table->enum('lieu_type', ['campus', 'en_ligne', 'autre'])->default('campus');
            $table->string('lieu_details')->nullable()->comment('Détails comme salle, lien de réunion ou adresse');
            $table->enum('statut', ['en_attente', 'accepte', 'refuse', 'terminee', 'annule'])->default('en_attente');
            $table->text('commentaire_enseignant')->nullable();
            $table->dateTime('date_fin')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sessions', function (Blueprint $table) {
            $table->dropForeign(['teacher_id']);
            $table->dropForeign(['student_id']);
            $table->dropForeign(['skill_id']);
            $table->dropColumn([
                'teacher_id',
                'student_id',
                'skill_id',
                'date_session',
                'duree',
                'lieu_type',
                'lieu_details',
                'statut',
                'commentaire_enseignant',
                'date_fin'
            ]);
        });
    }
};