<?php

namespace Tests\Feature\Http\Controllers\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Admin\EnrollmentCrudController
 */
class EnrollmentCrudControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed('TestSeeder');
        $this->logAdmin();
    }

    /**
     * @test
     */
    public function destroy_returns_an_ok_response()
    {
        $this->markTestIncomplete('This test case was generated by Shift. When you are ready, remove this line and complete this test case.');

        $response = $this->delete(route('enrollment.destroy', ['id' => $id]));

        $response->assertOk();
        $this->assertDeleted($enrollment);

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function index_returns_an_ok_response()
    {
        $response = $this->get(route('enrollment.index'));

        $response->assertOk();

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function search_returns_an_ok_response()
    {
        $this->markTestIncomplete('This test case was generated by Shift. When you are ready, remove this line and complete this test case.');

        $response = $this->post(route('enrollment.search'), [
            // TODO: send request data
        ]);

        $response->assertOk();

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function show_returns_an_ok_response()
    {
        $this->markTestIncomplete('This test case was generated by Shift. When you are ready, remove this line and complete this test case.');

        $response = $this->get(route('enrollment.show', ['id' => $id]));

        $response->assertOk();
        $response->assertViewIs('enrollments.show');
        $response->assertViewHas('enrollment');
        $response->assertViewHas('products');
        $response->assertViewHas('comments');

        // TODO: perform additional assertions
    }

    /**
     * @test
     */
    public function show_details_row_returns_an_ok_response()
    {
        $this->markTestIncomplete('This test case was generated by Shift. When you are ready, remove this line and complete this test case.');

        $response = $this->get(route('enrollment.showDetailsRow', ['id' => $id]));

        $response->assertOk();

        // TODO: perform additional assertions
    }

    // test cases...
}
