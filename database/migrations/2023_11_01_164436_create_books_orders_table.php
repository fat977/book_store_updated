<?php

use App\Models\Order;
use App\Models\PurchasedBook;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('books_orders', function (Blueprint $table) {
            $table->foreignIdFor(PurchasedBook::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignIdFor(Order::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->decimal('price',7,2);
            $table->smallInteger('quantity')->length(2)->default(1);
            //SETTING THE PRIMARY KEYS
            $table->primary(['purchased_book_id','order_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books_orders');
    }
};
