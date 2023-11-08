<?php

use App\Models\DownloadableBook;
use App\Models\User;
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
        Schema::create('reacts', function (Blueprint $table) {
            $table->foreignIdFor(DownloadableBook::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->tinyInteger('like')->default(0)->comment('1=>like , 0=>no react');
            $table->tinyInteger('dislike')->default(0)->comment('1=>dislike , 0=>no react');
            //SETTING THE PRIMARY KEYS
            $table->primary(['downloadable_book_id','user_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reacts');
    }
};
