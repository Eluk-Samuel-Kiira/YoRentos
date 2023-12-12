<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estate;
use App\Models\Unit;
use App\Models\Feedback;
use Illuminate\Support\Facades\Validator;


class LandingPageController extends Controller
{
    public function index()
    {        
        $estates = Estate::on('mysql_estates')->with('unitEstate')->where('status', 1)->latest()->get();
        // $units = Unit::on('mysql_estates')->where('status', 0)->latest()->get();

        return view('landing_page.home', compact(
            'estates',
        ));
    }

    public function storeFeedback(Request $request)
    {
        $rules = [
            'contact' => 'required|string|max:5500', // Example rules, adjust as needed
            'message' => 'required|string',
            'user_id' => 'integer', 
        ];
        
        // Validating the request data
        $validator = Validator::make($request->all(), $rules);
        
        // Check if the validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $feedback = new Feedback();
        $feedback->contact = $request->contact;
        $feedback->message = $request->message;
        $feedback->user_id = $request->user_id;
        $feedback->save();
        return redirect()->route('landing.page')->with('success', 'Feedback Submitted');
    }

    public function indexFeedback()
    {
        $feedbacks = Feedback::get();
        return view('feedback.index', compact(
            'feedbacks',
        ));
    }

    public function deleteFeedback($id)
    {
        $feedback = Feedback::where('id', $id)->first();
        if ($feedback)
        {
            $feedback->delete();
            return redirect()->route('feedback.index')->with('success', 'Feedback Deleted');
        } else {
            return redirect()->route('feedback.index')->with('success', 'Feedback Not Found');   
        }

    }
}
