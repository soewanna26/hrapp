<?php

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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->bigIncrements('employee_id')->nullable();
            $table->string('name');
            $table->bigInteger('position_id')->nullable();
            $table->bigInteger('department_id')->nullable();
            $table->bigInteger('salary_id')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('nrc_number')->nullable();
            $table->date('birthday')->nullable();
            $table->enum('gender',['male','female'])->nullable();
            $table->date('joined_date')->nullable();
            $table->date('permanent_date')->nullable();
            $table->date('resign_date')->nullable();
            $table->text('address')->nullable();
            $table->string('profile_img')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
