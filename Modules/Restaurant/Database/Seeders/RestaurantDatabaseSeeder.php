<?php

namespace Modules\Restaurant\Database\Seeders;
use App\{Store, Item, Unit};
use Modules\Restaurant\Models\{Hall, Menu, Table, Waiter};
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class RestaurantDatabaseSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        // Model::unguard();
        $this->truncateTables();
        $stores = factory(Store::class, 5)->create();
        $halls = factory(Hall::class, 5)->create();
        $tables = factory(Table::class, 30)->create();
        $menus = factory(Menu::class, 5)->create();
        $units = factory(Unit::class, 5)->create();
        $items = factory(Item::class, 10)->create();
        $waiters = factory(Waiter::class, 5)->create();
        for($index = 0; $index < count($items); $index++) {
            $item = $items[$index];
            $image_name = $index + 1;
            $image_name .= '.jpg';
            $item->update(['image' => $image_name]);
        }
        // $this->call("OthersTableSeeder");
    }
    public function truncateTables()
    {
        Schema::disableForeignKeyConstraints();
        \DB::table('halls')->truncate();
        \DB::table('tables')->truncate();
        \DB::table('menus')->truncate();
        \DB::table('items')->truncate();
        \DB::table('item_menu')->truncate();
        \DB::table('units')->truncate();
        \DB::table('item_unit')->truncate();
        \DB::table('waiters')->truncate();
        // \App\Permission::truncate();
        Schema::enableForeignKeyConstraints();
    }
}