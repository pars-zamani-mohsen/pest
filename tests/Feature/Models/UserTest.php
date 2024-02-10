<?php

use App\Models\Product;
use App\Models\Tag;
use App\Models\User;

test('createUser', function () {
    $user = User::factory()->create();

    expect($user)
        ->toBeInstanceOf(User::class);
});

test('updateUser', function () {
    $user = User::inRandomOrder()->first() ?? User::factory()->create();

    $user->update([
        'name' => 'mohsen'
    ]);

    $user->refresh();

    expect($user)
        ->toBeInstanceOf(User::class)
        ->and($user->name)->toBe('mohsen');
});

test('relationUserWithTaggable', function () {
    $user = User::inRandomOrder()->first() ?? User::factory()->create();
    $tag = Tag::inRandomOrder()->first() ?? Tag::factory()->create();

    $user->tags()->attach($tag->id);

    expect($user)->toBeInstanceOf(User::class)
        ->and($user->tags->first())->toBeInstanceOf(Tag::class);
});

test('relationUserWithProduct', function () {
    $user = User::factory()->create();
    $productData = Product::factory(5)->for($user)->make()->toArray();

    Product::insert($productData);

    expect($user)->toBeInstanceOf(User::class)
        ->and($user->productCreated()->count())->toBe(5)
        ->and($user->productCreated->first())->toBeInstanceOf(Product::class);
});

test('relationUserWithTag', function () {
    $user = User::factory()->create();
    $tagData = Tag::factory(5)->for($user)->make()->toArray();

    Tag::insert($tagData);

    expect($user)->toBeInstanceOf(User::class)
        ->and($user->tagCreated()->count())->toBe(5)
        ->and($user->tagCreated->first())->toBeInstanceOf(Tag::class);
});
