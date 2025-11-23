<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement('ALTER TABLE menu_items DROP FOREIGN KEY menu_items_restaurant_id_foreign');
        DB::statement('ALTER TABLE menu_items MODIFY restaurant_id BIGINT UNSIGNED NULL');
        DB::statement('ALTER TABLE menu_items ADD CONSTRAINT menu_items_restaurant_id_foreign FOREIGN KEY (restaurant_id) REFERENCES restaurants(id) ON DELETE SET NULL');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('ALTER TABLE menu_items DROP FOREIGN KEY menu_items_restaurant_id_foreign');
        DB::statement('ALTER TABLE menu_items MODIFY restaurant_id BIGINT UNSIGNED NOT NULL');
        DB::statement('ALTER TABLE menu_items ADD CONSTRAINT menu_items_restaurant_id_foreign FOREIGN KEY (restaurant_id) REFERENCES restaurants(id) ON DELETE CASCADE');
    }
};

