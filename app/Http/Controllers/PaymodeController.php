<?php

namespace App\Http\Controllers;

use App\Models\Paymode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class PaymodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        // Store payment data in the database using the Payment model
        $payment = new Advert(); 
        $payment->tx_ref = $request->input('tx_ref');
        $payment->estate_id = $request->input('estate_id');
        $payment->landlord_id = $request->input('landlord_id');
        $payment->amount = $request->input('amount');

        $payment->save();

        // Return a success response (you can customize as needed)
        return response()->json(['message' => 'Payment data stored successfully'], 200);
    }
}
