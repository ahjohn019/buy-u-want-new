<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CrudTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function setUp(): void
    { 
        parent::setUp();
    } 


    public function test_model_store(){
        $user = User::find(2);
        $this->actingAs($user);

        $getPreparation = $this->route_preparation();

        foreach($getPreparation as $key => $preparation) {
            $response = $this->post($key, $preparation);
            $response->assertStatus(200);
            $this->assertTrue(true);
        }
    }

    public function tearDown(): void
    { 
        Artisan::call('migrate:refresh --seed');
    } 
}
