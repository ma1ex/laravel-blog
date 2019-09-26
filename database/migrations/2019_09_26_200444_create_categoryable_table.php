<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * Промежуточная таблица для полиморфной связи категорий со статьями
         * (или с какими-то другими сущностями). Этот вид связывания хорош, чтобы
         * не плодить много таблиц для типа связывания многие-ко-многим
         */
        Schema::create('categoryables', function (Blueprint $table) {
            // id из таблицы категорий
            $table->integer('category_id');
            // id поля связанной таблицы (статьи, товара и т.п.)
            $table->integer('categoryable_id');
            // связанная модель, в которой искать значение в 'categoryable_id'
            $table->string('categoryable_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categoryables');
    }
}
