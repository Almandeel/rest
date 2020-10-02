<?php

namespace Modules\Cashier\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Restaurant\Models\{Menu, Waiter, Driver, Table, Order};
use App\Item;
class CashierController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('cashier::index');
    }

    public function pos(Request $request)
    {
        $waiters = Waiter::allAvailable();
        $menus_collection = Menu::all();
        $menus_keys = $menus_collection->modelKeys();
        $menus_data = $menus_collection->map(function($menu){
            $menu_data = $menu->getAttributes();
            $menu_data['items'] = array_combine($menu->items->pluck('name')->toArray(), $menu->items->map(function($item){
                $units = [];
                foreach ($item->itemUnits as $unit) {
                    $units[] = [
                        'id' => $unit->id,
                        'name' => $unit->item->name . '-' . $unit->unitName(),
                        'image_url' => $item->image_url,
                        'item_name' => $item->name,
                        'unit_name' => $unit->unitName(),
                        'price' => $unit->price,
                        'status' => [
                            'name' => $unit->status_name,
                            'title' => $unit->status_title,
                            'class' => $unit->status_class,
                        ],
                    ];
                }
                return $units;
            })->toArray());
            return $menu_data;
        })->toArray();
        $menus = array_combine($menus_keys, $menus_data);
        // dd($menus);
        $order = Order::find($request->order_id);
        $tables = Table::allAvailable();
        /*->map(function($table){
            $data = [
                'id' => $table->id,
                'number' => $table->number,
            ];
            return array_merge($data, []);
        });*/
        $drivers = Driver::allAvailable();
        // dd($order->items->first()->item);
        return view('cashier::pos', compact('waiters', 'menus', 'order', 'tables', 'drivers'));
    }
}
