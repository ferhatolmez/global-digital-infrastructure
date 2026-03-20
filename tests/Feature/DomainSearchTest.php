<?php

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use function Pest\Laravel\{actingAs, get};

uses(DatabaseTransactions::class);

it('redirects guests to login page', function () {
    get('/client/dashboard')->assertRedirect('/login');
});

it('allows authenticated users to access dashboard', function () {
    $user = User::factory()->create();

    actingAs($user)
        ->get('/client/dashboard')
        ->assertStatus(200)
        ->assertSee('Hoş Geldiniz');
});

it('loads the interactive Livewire domain search page', function () {
    $user = User::factory()->create();

    actingAs($user)
        ->get('/client/domains/search')
        ->assertStatus(200)
        ->assertSeeLivewire('client.domain-search');
});
