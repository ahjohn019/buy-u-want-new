<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Providers\RouteServiceProvider;
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

    public function test_login(){
        $user = User::find(2);
        $this->actingAs($user);
        $this->assertTrue(true);

        return $user;
    }

    // public function test_model_store(){
    //     $this->actingAs($this->test_login());
    //     $getPreparation = $this->route_preparation();

    //     foreach($getPreparation as $key => $preparation) {
    //         $response = $this->post($key, $preparation);
    //         $response->assertStatus(200);
    //     }
    // }

    // public function test_model_update(){
    //     $this->actingAs($this->test_login()); 
        
    //     $getPreparation = $this->route_preparation();
        
    //     foreach($getPreparation as $key => $preparation){
    //         $response = $this->put($key.'/'. rand(1,2) , $preparation);
    //         $response->assertStatus(200);
    //     }
    // }

    // public function test_model_delete(){
    //     $this->actingAs($this->test_login());
    //     $getPreparation = $this->route_preparation();

    //     foreach($getPreparation as $key => $preparation) {
    //         $response = $this->delete($key .'/'. rand(1,2) , $preparation);
    //         $response->assertStatus(200);
    //     }
    // }

    // public function test_add_item_into_cart(){
    //     $this->actingAs($this->test_login());
    //     $product = Product::find(2);
    //     $response = $this->post('/carts/addCart/'. $product->id);
    // }

    public function tearDown(): void
    { 
        Artisan::call('migrate:refresh --seed');
    } 
}
