<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // المستخدم الذي قام بالنشاط
            $table->string('action'); // نوع النشاط
            $table->string('subject_type'); // نوع الكيان الذي تم عليه النشاط (مثل Ticket, Comment)
            $table->unsignedBigInteger('subject_id'); // ID الكيان
            $table->timestamps();
    
            // العلاقة مع جدول المستخدمين
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
