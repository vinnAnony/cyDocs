<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFileRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('document_id');
            $table->integer('department_id');
            $table->integer('category_id');
            $table->integer('requester_id');
            $table->string('requester_message');
            $table->integer('approver_id')->nullable();
            $table->string('approver_message')->nullable();
            $table->integer('read')->default(0);
            $table->integer('write')->default(0);
            $table->integer('delete')->default(0);
            $table->integer('status')->default(1);
            $table->timestamps();
            $table->dateTime('expires_at')->nullable();

            $table->softDeletes($column = 'deleted_at', $precision = 0);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('file_requests');
    }
}
