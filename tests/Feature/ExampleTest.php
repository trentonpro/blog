<?php

it('renders the homepage with posts', function () {
    $response = $this->get('/');

    $response->assertViewHas('posts');
});
