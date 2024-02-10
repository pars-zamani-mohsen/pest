<?php

test('home', function () {
    $response = $this->get('/');

    expect($response->status())
        ->toBeInt()
        ->toBe(200);
});
