<?php

use App\Models\Tag;
use App\Models\User;

test('createTag', function () {
    $tag = Tag::factory()->create();

    expect($tag)
        ->toBeInstanceOf(Tag::class);
});

test('UpdateTag', function () {
    $tag =  Tag::inRandomOrder()->first() ?? Tag::factory()->create();

    $tag->update([
        'name' => 'VIP'
    ]);

    expect($tag)->toBeInstanceOf(Tag::class)
        ->and($tag->name)->toBe('VIP');
});

test('relationTagWithUser', function () {
    $tag = Tag::inRandomOrder()->first() ?? Tag::factory()->create();

    expect($tag)->toBeInstanceOf(Tag::class)
        ->and($tag->user)->toBeInstanceOf(User::class);
});
