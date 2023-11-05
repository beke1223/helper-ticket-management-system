<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\TicketStatus; 

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            // $table->string('status')->default(TicketStatus::OPEN->value);
            $table->string('attachment')->nullable();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('status_changed_by_id')->nullable()->constrained('users');
            $table->timestamps();
        });
    }


    //932
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
