<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estate;
use App\Models\District;
use App\Models\Village;
use App\Models\Unit;
use App\Models\User;
use App\Models\Feedback;
use Illuminate\Support\Facades\Validator;


class LandingPageController extends Controller
{
    public function index()
    {        
        $newly_estates = Estate::on('mysql_estates')->with('unitEstate')->where('status', 1)->latest()->take(6)->get();
        $early_estates = Estate::on('mysql_estates')->with('unitEstate')->where('status', 1)->latest()->skip(6)->take(6)->get();
        // $units = Unit::on('mysql_estates')->where('status', 0)->latest()->get();

        return view('landing_page.home', compact(
            'newly_estates',
            'early_estates',
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
        return redirect()->back()->with('success', 'Feedback Submitted');
    }

    public function indexFeedback()
    {
        $feedbacks = Feedback::get();
        $users = User::get();
        return view('feedback.index', compact(
            'feedbacks',
            'users',
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

    public function userDistrict(Request $request)
    {
        $district_name = $request->input('district');
        // $district_name = $request->input('district');

        $district = District::where('district', $district_name)->first();
        if ($district)
        {
            // Fetch villages within the district
            $villagesInDistrict = Village::whereHas('parishName.subcountyName.countyName.districtName', function ($query) use ($district) {
                $query->where('id', $district->id);
            })->pluck('id');
            $estatesInDistrict = Estate::with('villageEstate')->whereIn('village_id', $villagesInDistrict)->get();

            return response()->json(['data' => $estatesInDistrict]);
        } else {
            return response()->json(['success' => false, 'message' => 'District Not Found']);
        }
    }
}
