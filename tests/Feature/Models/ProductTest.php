<?php

use App\Models\Product;
use App\Models\Tag;
use App\Models\User;

test('create product', function () {
    $product = Product::factory()->create();

    expect($product)
        ->toBeInstanceOf(Product::class);
});

test('update product', function () {
    $product =  Product::inRandomOrder()->first() ?? Product::factory()->create();

    $product->update([
        'name' => 'myBook',
        'price' => 100.5,
    ]);

    expect($product)
        ->toBeInstanceOf(Product::class)
        ->and($product->name)->toBe('myBook')
        ->and($product->price)->toBeFloat()
        ->and($product->price)->toBe(100.5);
});

test('relation product with user', function () {
    $product = Product::inRandomOrder()->first() ?? Product::factory()->create();

    expect($product)->toBeInstanceOf(Product::class)
        ->and($product->user)->toBeInstanceOf(User::class);
});

test('relation product with tag', function () {
    $product = Product::inRandomOrder()->first() ?? Product::factory()->create();
    $tag = Tag::inRandomOrder()->first() ?? Tag::factory()->create();

    $product->tags()->attach($tag->id);

    expect($product)->toBeInstanceOf(Product::class)
        ->and($product->tags->first())->toBeInstanceOf(Tag::class);
});
