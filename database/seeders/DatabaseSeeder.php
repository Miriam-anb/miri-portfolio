<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Service;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // ---- Compte administrateur ----
        // Identifiants par défaut — à changer après la première connexion
        // (via `php artisan tinker` en attendant une page dédiée).
        User::updateOrCreate(
            ['email' => 'admin@miriam-portfolio.test'],
            [
                'name' => 'Miriam Anibaba',
                'password' => Hash::make('ChangeMoi123!'),
            ]
        );

        // ---- Paramètres du site ----
        $settings = [
            'site_name' => 'Miriam Anibaba',
            'hero_title' => 'Je conçois des agents IA',
            'hero_accent' => 'qui automatisent votre activité',
            'hero_subtitle' => "Développeuse spécialisée en agents IA et en automatisation de workflows métier. Intégration d'API (OpenAI, Claude), conception de workflows n8n et développement web — des solutions qui connectent vos outils, vos données et l'intelligence artificielle.",
            'about_text' => "Développeuse spécialisée en agents IA et en automatisation de workflows métier. Expérience en intégration d'API (OpenAI, Claude), en conception de workflows n8n et en développement web. Autonome, rigoureuse et orientée résultats, je conçois des solutions qui connectent applications, données et intelligence artificielle pour fluidifier les opérations et réduire les tâches manuelles.",
            'about_photo' => null,
            'contact_email' => 'anibabamiriam@gmail.com',
            'contact_phone' => '+229 01-57-96-00-97',
            'contact_whatsapp' => '22901579600',
            'linkedin_url' => '#',
            'github_url' => '#',
            'location' => 'Cotonou, Bénin',
        ];

        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        // ---- Services ----
        if (Service::count() === 0) {
            Service::insert([
                [
                    'title' => 'Agents IA & Automatisation',
                    'description' => "Conception d'agents IA et de workflows n8n qui connectent vos outils, API et données pour éliminer les tâches répétitives et fiabiliser vos process.",
                    'icon' => 'sparkles',
                    'position' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'title' => "Intégration d'API & IA générative",
                    'description' => "Intégration des API OpenAI et Claude pour analyser, générer et traiter automatiquement vos contenus, documents et données métier.",
                    'icon' => 'api',
                    'position' => 2,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'title' => 'Tests & Assurance Qualité',
                    'description' => "Tests fonctionnels d'applications et de sites web, validation des parcours utilisateurs, identification et documentation des anomalies.",
                    'icon' => 'check',
                    'position' => 3,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
        }

        // ---- Projets ----
        if (Project::count() === 0) {
            Project::create([
                'title' => "Agent IA de création et publication de vidéos publicitaires",
                'slug' => 'agent-ia-videos-publicitaires',
                'summary' => "Un agent IA qui transforme une fiche produit en vidéo publicitaire prête à publier sur les réseaux sociaux, du script à l'analyse de performance.",
                'description' => "Ce projet automatise l'ensemble du cycle de création publicitaire : à partir d'une fiche produit, l'agent génère un script, produit une vidéo, la publie sur les réseaux sociaux puis suit ses performances — le tout sans intervention manuelle à chaque étape.",
                'tech_stack' => 'n8n · OpenAI API · Claude API · REST APIs · Webhooks',
                'workflow_steps' => ['Produit', 'Analyse IA', 'Script', 'Vidéo', 'Réseaux sociaux', 'Analytics'],
                'featured' => true,
                'position' => 1,
            ]);

            Project::create([
                'title' => 'Automatisation de workflows métier avec n8n',
                'slug' => 'automatisation-workflows-n8n',
                'summary' => "Des workflows n8n connectant formulaires, API et bases de données pour automatiser des process métier récurrents.",
                'description' => "Conception de plusieurs workflows n8n orientés cas d'usage métier : collecte de données via formulaires, appels API, mise à jour de bases de données et notifications automatiques, avec gestion des erreurs et amélioration continue de la fiabilité.",
                'tech_stack' => 'n8n · REST APIs · Webhooks · Google Workspace',
                'workflow_steps' => null,
                'featured' => false,
                'position' => 2,
            ]);

            Project::create([
                'title' => 'Application mobile de suivi de présences',
                'slug' => 'application-suivi-presences',
                'summary' => "Développement et tests d'une application de suivi de présences en équipe, du prototype à la mise en production.",
                'description' => "Développement et amélioration continue d'une application de suivi de présences avec Flutter, en collaboration avec une équipe de développement. Tests fonctionnels réguliers et correction d'anomalies pour fiabiliser l'application avant chaque livraison.",
                'tech_stack' => 'Flutter · Dart · Tests fonctionnels',
                'workflow_steps' => null,
                'featured' => false,
                'position' => 3,
            ]);
        }
    }
}
