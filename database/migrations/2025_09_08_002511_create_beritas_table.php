<?php

use App\Models\Kategori;
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
        Schema::create('beritas', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Kategori::class)->constrained();
            $table->foreignIdFor(User::class)->constrained();
            $table->string('judul');
            $table->string('slug')->unique();
            $table->string('gambar');
            $table->text('isi');
            $table->boolean('isPublish')->default(true);
            $table->integer('diklik');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beritas');
    }
};
