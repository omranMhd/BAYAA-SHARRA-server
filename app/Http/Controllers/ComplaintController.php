<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\Complaint;
use App\Models\User;
use App\Http\Requests\ComplaintStoreRequest;
use Illuminate\Http\Request;
use App\Events\AddNewComplaint;

class ComplaintController extends Controller
{
    public function addComplaint(ComplaintStoreRequest $request)
    {
        // return $request;

        if (!User::where('id', $request->user_id)->exists()) {
            // if ($user == null) {
            return response()->json([
                "message" => "no user with this id"
            ], 400);
        }
        if (!Advertisement::where('id', $request->advertisement_id)->exists()) {
            return response()->json([
                "message" => "no advertisement with this id"
            ], 400);
        }

        $new_complaint = Complaint::create([
            "user_id" => $request->user_id,
            "advertisement_id" => $request->advertisement_id,
            "reason" => $request->reason,
        ]);

        event(new AddNewComplaint($new_complaint));

        return response()->json([
            "message" => "sending complaint done successfully"
        ], 201);
    }
}
