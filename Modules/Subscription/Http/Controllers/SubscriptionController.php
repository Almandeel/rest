<?php

namespace Modules\Subscription\Http\Controllers;

use App\Customer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Routing\Controller;
use Modules\Subscription\Models\Plan;
use Illuminate\Contracts\Support\Renderable;
use Modules\Subscription\Models\Subscription;

class SubscriptionController extends Controller
{
    public function dashboard() {
        return view('subscription::dashboard');
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $subscriptions      = Subscription::all();
        $plans              = Plan::all();
        $customers          = Customer::whereNotIn('id', $subscriptions->where('customer_id', '!=',14)->pluck('customer_id')->toArray())->get();
        return view('subscription::subscriptions.index', compact('subscriptions', 'plans', 'customers'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('subscription::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        request()->validate([
            'customer_id'       => 'required',
            'plan_id'           => 'required',
            'payment_type'      => 'required',
        ]);

        $plan = Plan::find($request->plan_id);
        $request_date = $request->all();
        $request_date['start_date'] = Carbon::now('Africa/Khartoum');
        $request_date['end_date'] =  Carbon::now('Africa/Khartoum')->addDays($plan->period);

        $subscription = Subscription::create($request_date);

        return back()->with('success', 'تمت العملية بنجاح');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $plans              = Plan::all();
        $customers          = Customer::get();
        $subscription       = Subscription::find($id);
        return view('subscription::subscriptions.show', compact('subscription', 'customers', 'plans'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('subscription::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $subscription = Subscription::find($id);
        request()->validate([
            'customer_id'       => 'required',
            'plan_id'           => 'required',
            'payment_type'      => 'required',
        ]);

        $plan = Plan::find($request->plan_id);

        $request_date = $request->all();
        $request_date['start_date'] = Carbon::now('Africa/Khartoum');
        $request_date['end_date'] = $request_date['start_date']->addDays($plan->period);

        if($request->type == 'resubscribe') {
            $new_subscription = Subscription::create($request_date);
            $subscription->delete();
        }else {
            $subscription->update($request_date);
        }
        return back()->with('success', 'تمت العملية بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $subscription = Subscription::find($id);

        $subscription->update([
            'canceled_at' => date('Y-m-d')
        ]);

        $subscription->delete();

        return redirect()->route('subscriptions.index')->with('success', 'تمت العملية بنجاح');
    }

    public function barcode($id) 
    {
        $subscriptions;
        if($id == "all")
        {
            $subscriptions = Subscription::all();
        }
        else 
        {
            $subscriptions = Subscription::where('id', $id)->get();
        }
        return view('subscription::subscriptions.barcode', compact('subscriptions'));
    }
}
