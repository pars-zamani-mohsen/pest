<?php

use App\Models\Tag;
use App\Models\User;

test('create tag', function () {
    $tag = Tag::factory()->create();

    expect($tag)
        ->toBeInstanceOf(Tag::class);
});

test('Update tag', function () {
    $tag =  Tag::inRandomOrder()->first() ?? Tag::factory()->create();

    $tag->update([
        'name' => 'VIP'
    ]);

    expect($tag)->toBeInstanceOf(Tag::class)
        ->and($tag->name)->toBe('VIP');
});

test('relation tag with user', function () {
    $tag = Tag::inRandomOrder()->first() ?? Tag::factory()->create();

    expect($tag)->toBeInstanceOf(Tag::class)
        ->and($tag->user)->toBeInstanceOf(User::class);
});
