<?php

namespace Modules\Subscription\Database\Seeders;

use App\Account;
use App\Customer;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class SubscriptionDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $account = Account::newCustomer();

        $customer = Customer::create([
            'name' => 'عميل خاص',
            'phone' => '0900000000',
            'account_id' =>  $account->id,
        ]);

        // $this->call("OthersTableSeeder");
    }
}
