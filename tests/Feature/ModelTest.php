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

    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

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


    public function test_user_in_correct_relationship(){
        $user = new User;
        $address = new Address;
        $biography = new Biography;
        $category = new Category;
        $products = new Product;
        $order = new Order;

        $user_id = 'user_id';

        $this->assertHasOneUsing(Biography::class, $user->biography(), $user_id);
        $this->assertBelongsToUsing(User::class, $biography->user(), $user_id);

        $this->assertHasManyUsing(Address::class, $user->addresses(), $user_id);
        $this->assertBelongsToUsing(User::class, $address->user(), $user_id);

        $this->assertHasOneUsing(Category::class, $user->category(), $user_id);
        $this->assertBelongsToUsing(User::class, $category->user(), $user_id);

        $this->assertHasOneUsing(Product::class, $user->product(), $user_id);
        $this->assertBelongsToUsing(User::class, $products->user(), $user_id);

        $this->assertHasManyUsing(Order::class, $user->order(), $user_id);
        $this->assertBelongsToUsing(User::class, $products->user(), $user_id);
    }

    public function test_product_in_correct_relationship(){
        $product = new Product;
        $category = new Category();
        $variant = new Variant();
        $discount = new Discount();
        $user = new User();
        $orderDetails = new OrderDetails();

        $this->assertHasManyUsing(Variant::class, $product->variant(), 'product_id');
        $this->assertBelongsToUsing(Product::class, $variant->product(),'product_id');

        $this->assertHasManyUsing(Product::class, $category->product(), 'category_id');
        $this->assertBelongsToUsing(Category::class, $product->category(),'category_id');

        $this->assertHasOneUsing(Product::class, $user->product(), 'user_id');
        $this->assertBelongsToUsing(User::class, $product->user(),'user_id');

        $this->assertHasOneUsing(Discount::class, $product->discount(), 'product_id');
        $this->assertBelongsToUsing(Product::class, $discount->product(),'product_id');

        $this->assertHasManyUsing(OrderDetails::class, $product->orderDetails(), 'product_id');
        $this->assertBelongsToUsing(Product::class, $orderDetails->product(),'product_id');
    }

    public function test_order_in_correct_relationship(){
        $user = new User();
        $order = new Order();
        $orderDetails = new OrderDetails();

        $this->assertHasManyUsing(OrderDetails::class, $order->orderDetails(), 'order_id');
        $this->assertBelongsToUsing(Order::class, $orderDetails->order(),'order_id');

        $this->assertHasManyUsing(Order::class, $user->order(), 'user_id');
        $this->assertBelongsToUsing(User::class, $order->user(),'user_id');
    }
}
