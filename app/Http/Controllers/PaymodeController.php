<?php

namespace App\Http\Controllers;

use App\Models\Paymode;
use App\Models\Estate;
use App\Models\Adverts;
use App\Models\Unitpay;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;


class PaymodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $units = Unitpay::get();
        $total_units = Unitpay::where('status', 1)->sum('amount');
        return view('dashboard.unit-sub', compact(
            'units',
            'total_units'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pay_mode' => 'required|string|max:256',
            'account_name' => 'required|string|max:256',
            'account_number' => 'required|string|max:256',
            'landlord_id' => 'required|integer',
            'estate_id' => 'required|string',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $payment = new Paymode();
        $payment->pay_mode = $request->input('pay_mode');
        $payment->account_name = $request->input('account_name');
        $payment->account_number = $request->input('account_number');
        $payment->landlord_id = $request->input('landlord_id');
        $payment->estate_id = $request->input('estate_id');
        $payment->save();
        return redirect()->route('estate.index')->with('success', 'Payment Details Added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Paymode $paymode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Paymode $paymode)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Paymode $paymode)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Paymode $paymode)
    {
        //
    }

    public function deletePay(Request $request)
    {
        $payId = $request->input('pay_id'); 

        $deletePay = Paymode::find($payId); 
        if ($deletePay) {
            $deletePay->delete(); 
            return response()->json(['success' => true]);
        } else {
            return response()->json([
                'message' => 'Pay Details not found or unable to delete.'
            ]);
        }
    }

    public function advertPay(Request $request)
    {
        $tx_ref = substr(rand(0,time()),0,11);
        $landlord_id = $request->input('landlord_id');
        $estate_id = $request->input('estate_id');
        $estate_uid = $request->input('estate_uid');
        $amount = $request->input('amount');
        $user_id = auth()->user()->id;
        $user_name = auth()->user()->name;
        $user_email = auth()->user()->email;

        if ($user_id == $landlord_id)
        {
            $estate = Estate::where('uid', $estate_uid)->where('id', $estate_id)->first();
            if ($estate)
            {
                // Check for a failed or a successful Transaction
                $existing_adverts = Adverts::where('estate_id', $estate_id)->where('status', 0)->first();
                if ($existing_adverts) 
                {
                    return redirect()->back()->with('success', 'This Estate Has An Advert Still Running');
                } else {
                    
                    $payment = Adverts::updateOrCreate(
                        [
                            'estate_id' => $estate_id,
                        ],
                        [
                            'txn_ref' => $tx_ref,
                            'price' => $amount,
                            'landlord_id' => $landlord_id,
                        ]
                    );
    
                    return redirect()->back()->with('success', 'Details stored Proceed to Check Out Button')
                        ->with('txn_ref', $tx_ref)->with('amount', $amount)->with('estate_id', $estate_id);
                }
            } else {
                return redirect()->back()->with('error', 'Estate Does not Extist');
            }
        } else {
            return redirect()->back()->with('error', 'Account Does Not Belong To You');
        }

    }

    public function payStatus(Request $request)
    {
        $date = now();
        $txn_ref = $request->input('txRef');
        $estate = Adverts::where('txn_ref', $txn_ref)->first();

        if ($estate)
        {
            // user 1 for adverts
            $estate_name = Estate::where('id', $estate->estate_id)->first();
            if ($estate_name)
            {
                $estate_name->update(['sponsored' => 1]);
                Adverts::where('estate_id', $estate->estate_id)->update([
                    'status' => 0,
                    'created_at' => $date, //tracking the month of payment
                ]); // For prove that the transaction is successful and status changes to 0

                return response()->json([
                    'message' => 'Estate '.$estate_name->estate.' sucessfully Advertised.'
                ]);
            }else {
                return response()->json([
                    'message' => 'Estate Not Found.'
                ]);
            }
        } else {
            return response()->json([
                'message' => 'Estate Could Not Be Got.'
            ]);
        }
    }

    function payUnit(Request $request)
    {
        $tx_ref = substr(rand(0,time()),0,11);
        $landlord_id = $request->input('landlord_id');
        $estate_id = $request->input('estate_id');
        $estate_uid = $request->input('estate_uid');
        $user_id = auth()->user()->id;
        $user_email = auth()->user()->email;

        $amount_unit = implode(',', $request->unit_pay);
        $amount = array_sum(explode(',', $amount_unit));
        if (count($request->unit_pay) === 1 && $amount <= 600)
        {
            $duration = 1;
        } else {
            $duration = 2;
        }
        $active_units = Unit::where('estate_id', $estate_id)->count();
        $total_pay = $active_units * $amount;

        if($total_pay == 0){
            $total_pay = $amount + 4000;
        }

        if ($user_id == $landlord_id)
        {
            $estate = Estate::where('uid', $estate_uid)->where('id', $estate_id)->first();
            if ($estate)
            {
                // Check for a failed or a successful Transaction
                $existing_pay = Unitpay::where('estate_id', $estate_id)->where('status', 1)->first();
                if ($existing_pay) 
                {
                    return redirect()->back()->with('success', 'This Estate Unit Payments still Running');
                } else {
                    $payment = Unitpay::updateOrCreate(
                        [
                            'estate_id' => $estate_id,
                        ],
                        [
                            'txn_ref' => $tx_ref,
                            'amount' => $total_pay,
                            'landlord_id' => $landlord_id,
                            'duration' => $duration,
                        ]
                    );
                    return redirect()->back()->with('success', 'Details stored Proceed to Check Out Button')
                        ->with('txn_ref', $tx_ref)->with('amount', $total_pay)->with('estate_id', $estate_id);
                }
            } else {
                return redirect()->back()->with('error', 'Estate Does not Extist');
            }
        } else {
            return redirect()->back()->with('error', 'Estate Does Not Belong To You');
        }
    }

    function unitPayStatus(Request $request)
    {
        $date = now();
        $txn_ref = $request->input('txRef');
        $estate = Unitpay::where('txn_ref', $txn_ref)->first();

        if ($estate)
        {
            // user 1 for adverts
            $estate_name = Estate::where('id', $estate->estate_id)->first();
            if ($estate_name)
            {
                Unitpay::where('estate_id', $estate->estate_id)->update([
                    'status' => 1,
                    'created_at' => $date, //tracking the month of payment
                ]); 
                // For prove that the transaction is successful
                return response()->json([
                    'message' => 'Units sucessfully Activated.'
                ]);
            }else {
                return response()->json([
                    'message' => 'Estate Not Found.'
                ]);
            }
        } else {
            return response()->json([
                'message' => 'Estate Could Not Be Got.'
            ]);
        }
        
    }

    public function estateIncome()
    {
        $estates = Adverts::get();
        $total_estate = Adverts::where('status', 0)->sum('price');
        return view('dashboard.income', compact(
            'estates',
            'total_estate',
        ));
    }

    public function advertStatus($id)
    {
        $this_advert = Adverts::where('id', $id)->first();

        if ($this_advert) {
            $estate_name = Estate::where('id', $this_advert->estate_id)->first();
            if ($this_advert->status == 1) {
                if ($estate_name)
                {
                    $estate_name->update(['sponsored' => 1]);
                }
                $this_advert->where('id', $id)->update(['status' => 0]);
                return redirect()->route('income.index')->with('success', 'Advert Activated successfully');
            } else {
                if ($estate_name)
                {
                    $estate_name->update(['sponsored' => 0]);
                }
                $this_advert->where('id', $id)->update(['status' => 1]);
                return redirect()->route('income.index')->with('success', 'Advert Deactivated successfully');
            }
        } else {
            return redirect()->route('income.index')->with('error', 'Advert Not found');
        }
    }

    public function advertDestroy($id)
    {
        $this_advert = Adverts::where('id', $id)->first();

        if ($this_advert) {
            $estate_name = Estate::where('id', $this_advert->estate_id)->first();
            if ($estate_name)
            {
                $estate_name->update(['sponsored' => 0]);
            }
            $this_advert->delete();
            return redirect()->route('income.index')->with('success', 'Advert Deleted Successfully');
        } else {
            return redirect()->route('income.index')->with('error', 'Advert Not found');
        }   
    }

    public function unitSubStatus($id)
    {
        $this_unit = Unitpay::where('id', $id)->first();

        if ($this_unit) {
            if ($this_unit->status == 1) {
                $this_unit->where('id', $id)->update(['status' => 0]);
                return redirect()->route('income.index')->with('success', 'Unit Deactivated successfully');
            } else {
                $this_unit->where('id', $id)->update(['status' => 1]);
                return redirect()->route('income.index')->with('success', 'Advert Activated successfully');
            }
        } else {
            return redirect()->route('income.index')->with('error', 'Estate Not found');
        }
    }

    public function unitpayDestroy($id)
    {
        $this_unit = Unitpay::where('id', $id)->first();

        if ($this_unit) {
            $this_unit->delete();
            return redirect()->route('income.index')->with('success', 'Unit Sub Deleted Successfully');
        } else {
            return redirect()->route('income.index')->with('error', 'Unit Sub Not found');
        }   
    }
}
