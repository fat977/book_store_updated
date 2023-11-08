<?php

use App\Models\Author;
use App\Models\Category;
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
        Schema::create('purchased_books', function (Blueprint $table) {
            $table->id();
            $table->json('name',20);
            $table->json('desc');
            $table->string('image');
            $table->decimal('price',7,2);
            $table->smallInteger('quantity')->length(3)->default(1);
            $table->tinyInteger('status')->default(1)->comment('1=>active , 0=> not active');
            $table->timestamp('released_date');
            $table->json('publisher');
            $table->foreignIdFor(Category::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignIdFor(Author::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchased_books');
    }
};
