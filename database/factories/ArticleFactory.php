<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $articleTitles = [
            'Laravel 8: What\'s New?',
            'Vue.js 3: Composition API',
            'React 17: JSX Transform',
            'Node.js 14: Top Features',
            'Tailwind CSS 2: JIT Mode',
            'Alpine.js 2: x-data',
            'Inertia.js 1: Introduction',
            'Livewire 2: File Upload',
            'Jetstream: Inertia.js',
            'Fortify: Introduction',
            'Sail: Docker Setup',
            'Nova: Custom Metrics',
            'Horizon: Dashboard',
            'Echo: Broadcasting',
            'Dusk: Browser Testing',
            'Sanctum: SPA Authentication',
            'How to Use Passport?',
            'Scout: Full-Text Search',
            'Socialite: OAuth Authentication',
        ];

        $articleContents = [
            '<h5>Laravel 8: What\'s New?</h5><p>Laravel 8 was released on September 8, 2020. It is the latest version of Laravel, which is a popular PHP framework. Laravel 8 comes with many new features and improvements. In this article, we will take a look at some of the most important changes in Laravel 8.</p>',
            '<h5>Vue.js 3: Composition API</h5><p>Vue.js 3 is the latest version of Vue.js, which is a popular JavaScript framework. Vue.js 3 comes with many new features and improvements. One of the most important new features in Vue.js 3 is the Composition API. In this article, we will take a look at the Composition API and how to use it in your Vue.js applications.</p>',
            '<h5>React 17: JSX Transform</h5><p>React 17 is the latest version of React, which is a popular JavaScript library for building user interfaces. React 17 comes with many new features and improvements. One of the most important new features in React 17 is the JSX Transform. In this article, we will take a look at the JSX Transform and how to use it in your React applications.</p>',
            '<h5>Node.js 14: Top Features</h5><p>Node.js 14 is the latest version of Node.js, which is a popular JavaScript runtime. Node.js 14 comes with many new features and improvements. In this article, we will take a look at some of the most important changes in Node.js 14.</p>',
            '<h5>Tailwind CSS 2: JIT Mode</h5><p>Tailwind CSS 2 is the latest version of Tailwind CSS, which is a popular utility-first CSS framework. Tailwind CSS 2 comes with many new features and improvements. One of the most important new features in Tailwind CSS 2 is the Just-In-Time (JIT) mode. In this article, we will take a look at the JIT mode and how to use it in your Tailwind CSS projects.</p>',
            '<h5>Alpine.js 2: x-data</h5><p>Alpine.js 2 is the latest version of Alpine.js, which is a popular JavaScript framework for building interactive web interfaces. Alpine.js 2 comes with many new features and improvements. One of the most important new features in Alpine.js 2 is the x-data directive. In this article, we will take a look at the x-data directive and how to use it in your Alpine.js applications.</p>',
            '<h5>Inertia.js 1: Introduction</h5><p>Inertia.js is a popular JavaScript library for building single-page applications (SPAs) with server-side frameworks like Laravel and Rails. Inertia.js allows you to create SPAs without having to write any client-side JavaScript. In this article, we will take a look at Inertia.js and how to use it in your Laravel applications.</p>',
            '<h5>Livewire 2: File Upload</h5><p>Livewire is a popular PHP framework for building dynamic web interfaces. Livewire allows you to create interactive web applications without having to write any JavaScript code. In this article, we will take a look at how to upload files with Livewire.</p>',
            '<h5>Jetstream: Inertia.js</h5><p>Jetstream is a popular application scaffolding for Laravel. Jetstream comes with many features and improvements. In this article, we will take a look at how to use Inertia.js with Jetstream.</p>',
            '<h5>Fortify: Introduction</h5><p>Fortify is a popular authentication library for Laravel. Fortify allows you to add authentication to your Laravel applications with minimal effort. In this article, we will take a look at how to use Fortify to add authentication to your Laravel applications.</p>',
            '<h5>Sail: Docker Setup</h5><p>Sail is a popular Docker setup for Laravel. Sail allows you to run your Laravel applications in Docker containers with minimal effort. In this article, we will take a look at how to set up Docker with Sail for your Laravel applications.</p>',
            '<h5>Nova: Custom Metrics</h5><p>Nova is a popular administration panel for Laravel. Nova allows you to create custom metrics to track the performance of your Laravel applications. In this article, we will take a look at how to create custom metrics in Nova.</p>',
            '<h5>Horizon: Dashboard</h5><p>Horizon is a popular dashboard for monitoring your Laravel queues. Horizon allows you to monitor the performance of your queues in real-time. In this article, we will take a look at how to use the Horizon dashboard to monitor your Laravel queues.</p>',
            '<h5>Echo: Broadcasting</h5><p>Echo is a popular library for broadcasting events in your Laravel applications. Echo allows you to create real-time web applications with minimal effort. In this article, we will take a look at how to use Echo to broadcast events in your Laravel applications.</p>',
            '<h5>Dusk: Browser Testing</h5><p>Dusk is a popular browser testing library for Laravel. Dusk allows you to write browser tests for your Laravel applications with minimal effort. In this article, we will take a look at how to write browser tests with Dusk.</p>',
            '<h5>Sanctum: SPA Authentication</h5><p>Sanctum is a popular library for adding authentication to your Laravel applications. Sanctum allows you to create single-page applications (SPAs) with minimal effort. In this article, we will take a look at how to use Sanctum to add authentication to your Laravel applications.</p>',
            '<h5>How to Use Passport?</h5><p>Passport is a popular library for adding OAuth2 authentication to your Laravel applications. Passport allows you to create secure APIs with minimal effort. In this article, we will take a look at how to use Passport to add OAuth2 authentication to your Laravel applications.</p>',
            '<h5>Scout: Full-Text Search</h5><p>Scout is a popular library for adding full-text search to your Laravel applications. Scout allows you to create search indexes for your Eloquent models with minimal effort. In this article, we will take a look at how to use Scout to add full-text search to your Laravel applications.</p>',
            '<h5>Socialite: OAuth Authentication</h5><p>Socialite is a popular library for adding OAuth authentication to your Laravel applications. Socialite allows you to authenticate users with popular OAuth providers like Facebook, Twitter, and Google. In this article, we will take a look at how to use Socialite to add OAuth authentication to your Laravel applications.</p>',
        ];

        return [
            'thumbnail' => UploadedFile::fake()->image('thumbnail.jpg'),
            'title' => $this->faker->unique()->randomElement($articleTitles),
            'content' => $this->faker->unique()->randomElement($articleContents),
            'slug' => $this->faker->unique()->slug,
        ];
    }
}
