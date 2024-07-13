<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    public function allComplaints()
    {
        $complaints = Complaint::with("user", "advertisement")->get();

        return response()->json([
            "message" => "get all complaints done",
            "data" => $complaints
        ]);
    }
    public function deleteComplaint($complaint_id)
    {
        $complaint = Complaint::find($complaint_id);

        if ($complaint) {
            $complaint->delete();

            return response()->json([
                "message" => "delete complaint done"
            ]);
        } else {
            return response()->json([
                "message" => "no complaint with this id"
            ], 404);
        }
    }
}
