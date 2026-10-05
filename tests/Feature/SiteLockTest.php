<?php

namespace Tests\Feature;

use App\Http\Middleware\CheckSiteLock;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SiteLockTest extends TestCase
{
    /**
     * Test maintenance page renders successfully (200 OK).
     */
    public function test_maintenance_page_is_accessible(): void
    {
        $response = $this->get('/maintenance');
        $response->assertStatus(200);
        $response->assertSee('Website Tidak Dapat Digunakan Sementara');
    }

    /**
     * Test redirection when site lock middleware is enabled.
     */
    public function test_routes_redirect_to_maintenance_when_site_is_locked(): void
    {
        $middleware = new CheckSiteLock();
        
        $requestHome = \Illuminate\Http\Request::create('/', 'GET');
        $responseHome = $middleware->handle($requestHome, function () {
            return response('OK');
        });
        
        // Assert redirect response when maintenance lock is active
        $this->assertTrue($responseHome->isRedirect(route('site.maintenance')));
    }
}
