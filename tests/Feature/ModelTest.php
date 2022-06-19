<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Order;
use App\Models\Address;
use App\Models\Product;
use App\Models\Variant;
use App\Models\Category;
use App\Models\Discount;
use App\Models\Biography;
use App\Models\OrderDetails;
use Illuminate\Support\Facades\Schema;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ModelTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function assertGetRelatedData($related_model,$relationship,$foreign_key){
        $this->assertInstanceOf($related_model, $relationship->getRelated());
        $this->assertEquals($foreign_key, $relationship->getForeignKeyName());
    }

    public function assertHasOneUsing($related_model, $relationship, $foreign_key)
    {
        $this->assertInstanceOf(HasOne::class, $relationship);
        $this->assertGetRelatedData($related_model,$relationship,$foreign_key);
        $this->assertTrue(Schema::hasColumns($relationship->getRelated()->getTable(), array($foreign_key)));
    }

    public function assertHasManyUsing($related_model, $relationship, $foreign_key)
    {
        $this->assertInstanceOf(HasMany::class, $relationship);
        $this->assertGetRelatedData($related_model,$relationship,$foreign_key);
        $this->assertTrue(Schema::hasColumns($relationship->getRelated()->getTable(), array($foreign_key)));
    }

    public function assertBelongsToUsing($related_model, $relationship, $foreign_key)
    {
        $this->assertInstanceOf(BelongsTo::class, $relationship);
        $this->assertInstanceOf($related_model, $relationship->getRelated());
        $this->assertEquals($foreign_key, $relationship->getForeignKeyName());
        $this->assertTrue(Schema::hasColumns($relationship->getParent()->getTable(), array($foreign_key)));
    }

    public function getModelList(){        
        $getModelList = [
            'User' =>  new User,
            'Biography' =>  new Biography, 
            'Category' =>  new Category, 
            'Product' => new Product, 
            'Address' => new Address,
            'Order'=> new Order,
            'OrderDetails' => new OrderDetails,
            'Discount' => new Discount,
            'Variant' => new Variant
        ];

        return $getModelList;
    }


    public function test_user_in_correct_relationship(){
        $user_id = 'user_id';
        $notInTest = ["User", "OrderDetails", "Discount", "Variant"];
        $hasOneTest = ['Biography', 'Category', 'Product'];
        $hasManyTest = ['Address', 'Order'];

        foreach($this->getModelList() as $key => $value){
            $lowerKeyCase = strtolower($key);
            if(!in_array($key, $notInTest)){
                $this->assertBelongsToUsing(User::class, $value->user(), $user_id);
            }
            if(in_array($key, $hasOneTest)){
               $this->assertHasOneUsing('App\\Models\\'. $key, $this->getModelList()['User']->$lowerKeyCase(), $user_id);    
            }
            if(in_array($key, $hasManyTest)){
               $this->assertHasManyUsing('App\\Models\\'. $key, $this->getModelList()['User']->$lowerKeyCase(), $user_id);    
            }
        }
    }

    public function test_product_in_correct_relationship(){
        $product_id = 'product_id';

        foreach ($this->getModelList() as $key => $value) {
            $lowerKeyCase = strtolower($key);

            if($key == "Discount"){
                $this->assertHasOneUsing('App\\Models\\'. $key, $this->getModelList()['Product']->$lowerKeyCase(), 'product_id');
                $this->assertBelongsToUsing(Product::class, $this->getModelList()['Discount']->product(),'product_id');
            }
            if($key == "Product"){
                if($this->getModelList()['User']){
                    $this->assertHasOneUsing('App\\Models\\'. $key, $this->getModelList()['User']->$lowerKeyCase(), 'user_id');
                    $this->assertBelongsToUsing(User::class, $this->getModelList()['Product']->user(), 'user_id');
                }
                if($this->getModelList()['Category']){
                    $this->assertHasManyUsing('App\\Models\\'. $key, $this->getModelList()['Category']->$lowerKeyCase(), 'category_id');
                    $this->assertBelongsToUsing(Product::class, $this->getModelList()['Variant']->product(),'product_id');
                }
            }
            if($key == "OrderDetails"){
                $this->assertHasManyUsing('App\\Models\\'. $key, $this->getModelList()['Product']->orderDetails(), 'product_id');
                $this->assertBelongsToUsing(Product::class, $this->getModelList()['OrderDetails']->product(),'product_id');
            } 
            if($key == "Variant") {
                $this->assertHasManyUsing('App\\Models\\'. $key, $this->getModelList()['Product']->$lowerKeyCase(), 'product_id');
                $this->assertBelongsToUsing(Product::class, $this->getModelList()['Variant']->product(),'product_id');
            }
            
        }
    }

    public function test_order_in_correct_relationship(){
        foreach ($this->getModelList() as $key => $value) {
            $lowerKeyCase = strtolower($key);
            
            if($key == "OrderDetails"){
                $this->assertHasManyUsing('App\\Models\\'. $key, $this->getModelList()['Order']->orderDetails(), 'order_id');
                $this->assertBelongsToUsing(Order::class,  $this->getModelList()['OrderDetails']->order(),'order_id');
            }
            if ($key == "Order") {
                $this->assertHasManyUsing('App\\Models\\'. $key, $this->getModelList()['User']->$lowerKeyCase(), 'user_id');
                $this->assertBelongsToUsing(User::class, $this->getModelList()['Order']->user(),'user_id');
            }
        }
    }
}
