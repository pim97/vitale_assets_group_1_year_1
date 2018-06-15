<?php

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

/**
 * Breadcrumbs by Dave J. Miller
 * https://github.com/davejamesmiller/laravel-breadcrumbs
 */

// Dashboard
Breadcrumbs::register('dashboard', function ($breadcrumbs) {
    $breadcrumbs->push('Dashboard', route('dashboard'));
});

/**
 * Assets
 */

// Dashboard > Categorieën
Breadcrumbs::register('assets', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Assets', route('assets.index'));
});

// Dashboard > Assets > [Asset]
Breadcrumbs::register('asset', function ($breadcrumbs, $asset) {
    $breadcrumbs->parent('assets');
    $breadcrumbs->push($asset->name, route('assets.show', $asset->id));
});

// Dashboard > Categorieën > Categorie aanmaken
Breadcrumbs::register('assetCreate', function ($breadcrumbs) {
    $breadcrumbs->parent('assets');
    $breadcrumbs->push('Asset aanmaken', route('assets.create'));
});

/**
 * Categorieën
 */

// Dashboard > Categorieën
Breadcrumbs::register('categories', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Categorieën', route('categories.index'));
});

// Dashboard > Categorieën > [Category]
Breadcrumbs::register('category', function ($breadcrumbs, $category) {
    $breadcrumbs->parent('categories');
    $breadcrumbs->push($category->name, route('categories.show', $category->id));
});

// Dashboard > Categorieën > Categorie aanmaken
Breadcrumbs::register('categoryCreate', function ($breadcrumbs) {
    $breadcrumbs->parent('categories');
    $breadcrumbs->push('Categorie aanmaken', route('categories.create'));
});

/**
 * Breslocaties
 */

// Dashboard > Breslocaties
Breadcrumbs::register('breaches', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Breslocaties', route('breaches.index'));
});

// Dashboard > Breslocaties > [Breslocatie]
Breadcrumbs::register('breach', function ($breadcrumbs, $breach) {
    $breadcrumbs->parent('breaches');
    $breadcrumbs->push($breach->name, route('breaches.show', $breach->id));
});

// Dashboard > Breslocaties > Breslocatie aanmaken
Breadcrumbs::register('breachCreate', function ($breadcrumbs) {
    $breadcrumbs->parent('breaches');
    $breadcrumbs->push('Breslocatie aanmaken', route('breaches.create'));
});

/**
 * Belastingniveaus
 */

// Dashboard > Belastingniveaus
Breadcrumbs::register('loadlevels', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Belastingniveaus', route('loadlevels.index'));
});

// Dashboard > Belastingniveaus > [Belastingniveau]
Breadcrumbs::register('loadlevel', function ($breadcrumbs, $loadLevel) {
    $breadcrumbs->parent('loadlevels');
    $breadcrumbs->push($loadLevel->name, route('loadlevels.show', $loadLevel->id));
});

// Dashboard > Belastingniveaus > Belastingniveau aanmaken
Breadcrumbs::register('loadlevelCreate', function ($breadcrumbs) {
    $breadcrumbs->parent('loadlevels');
    $breadcrumbs->push('Belastingniveau aanmaken', route('loadlevels.create'));
});

/**
 * Gebruikers
 */

// Dashboard > Gebruikers
Breadcrumbs::register('users', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Gebruikers', route('users.index'));
});

// Dashboard > Gebruikers > [Gebruiker]
Breadcrumbs::register('user', function ($breadcrumbs, $user) {
    $breadcrumbs->parent('users');
    $breadcrumbs->push($user->name, route('users.show', $user->id));
});

// Dashboard > Gebruiker > Gebruiker aanmaken
Breadcrumbs::register('userCreate', function ($breadcrumbs) {
    $breadcrumbs->parent('users');
    $breadcrumbs->push('Gebruiker aanmaken', route('users.create'));
});

/**
 * Nieuwsberichten
 */

// Dashboard > Nieuwsberichten
Breadcrumbs::register('newsposts', function($breadcrumbs) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Nieuwsberichten', route('news.index'));
});

// Dashboard > Nieuwsberichten > [Nieuwsbericht]
Breadcrumbs::register('news', function($breadcrumbs, $newspost) {
    $breadcrumbs->parent('newsposts');
    $breadcrumbs->push($newspost->title, route('news.show', $newspost->id));
});

// Dashboard > Nieuwsberichten > Nieuwsbericht aanmaken
Breadcrumbs::register('newsCreate', function ($breadcrumbs) {
    $breadcrumbs->parent('newsposts');
    $breadcrumbs->push('Nieuwsbericht aanmaken', route('news.create'));
});

/**
 * Roles
 */

// Dashboard > Roles
Breadcrumbs::register('roles', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('Roles', route('roles.index'));
});

// Dashboard > Roles > [Role]
Breadcrumbs::register('role', function ($breadcrumbs, $user) {
    $breadcrumbs->parent('roles');
    $breadcrumbs->push($user->name, route('roles.show', $user->id));
});

// Dashboard > Roles > Roles aanmaken
Breadcrumbs::register('roleCreate', function ($breadcrumbs) {
    $breadcrumbs->parent('roles');
    $breadcrumbs->push('Roles aanmaken', route('roles.create'));
});

// Dashboard > Gebruikers > Avatar
Breadcrumbs::register('avatar', function ($breadcrumbs) {
    $breadcrumbs->parent('users');
    $breadcrumbs->push("Avatar configuratie", route('users.avatar'));
});
