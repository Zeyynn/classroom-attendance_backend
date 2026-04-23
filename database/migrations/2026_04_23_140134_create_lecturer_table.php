<?php

use App\Department;
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
        Schema::create('lecturer', function (Blueprint $table) {
            $table->id('lecturer_id');
            $table->string('user_id');
            $table->string('lecturer_name');
            $table->enum('department', array_column(Department::cases(), 'value'))->default(Department::Undefined->value);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lecturer');
    }
};
