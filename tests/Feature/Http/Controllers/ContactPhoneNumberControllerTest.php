<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ContactPhoneNumberController
 */
class ContactPhoneNumberControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function get_returns_an_ok_response()
    {
        $this->markTestIncomplete('This test case was generated by Shift. When you are ready, remove this line and complete this test case.');

        factory(\App\Models\Contact::class)->create();

        $response = $this->get('phonenumber/contact/{contact}');

        $response->assertOk();

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function store_returns_an_ok_response()
    {
        $this->markTestIncomplete('This test case was generated by Shift. When you are ready, remove this line and complete this test case.');

        factory(\App\Models\Contact::class)->create();

        $response = $this->post('phonenumber/contact/{contact}', [
            // TODO: send request data
        ]);

        $response->assertOk();

        // TODO: perform additional assertions
    }

    // test cases...
}
