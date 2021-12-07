<?php
namespace App\Http\Controllers;
use App\Models\CTDispatches;
use Exception;
use Illuminate\Http\Request;
use Requests;

class CTController extends Controller {
    public function setCycleTimeForPart(Request $request){
        //return response()->json($request, 200);
        $this->validate($request, [
            'cycle_time' => 'required',
            'line' => 'required',
            'part' => 'required',
            'op_count' => 'required',
            'max_parts' => 'optional',
            'plan_rate' => 'required',
            //'row_id' => 'required'
        ]);

        try {
            $url = "https://autoliv-eu2.leading2lean.com/api/1.0/lines/add_update_cycle_time/";
            $headers = ['Content-type' => "application/x-www-form-urlencoded"];
            $options = [
                "auth" => "ZjbBpxIq0qUYRoEOZkJYlNrEJL5Egkgh",
                "site" => 15,
                "cycle_time_seconds" => $request['cycle_time'],
                "product_code" => $request['part'],
                "operator_count" => $request['op_count'],
                "planning_rate_percentage" => $request['plan_rate'],
                "line_code" => $request['line'],
            ];

            if(strlen($request['max_part']) > 0){
                array_push($options, ['max_parts_per_pitch' => $request['max_parts']]);
            }

            $req = Requests::post($url, $headers, $options);
            $response = json_decode($req->body, true);
            //return response()->json($response, 200);
            if($response['success']){
                return response()->json(array('success' => true), 200);
            }
        } catch (Exception $e){
            return response()->json(array('success' => false, 'error' => $e), 200);
        }
    }

    public function closeDispatch(Request $request){
        $this->validate($request, [
            'dispatch_id' => 'required'
        ]);
        $headers = ['Content-type' => "application/x-www-form-urlencoded"];
        $closeDispatchUrl = "https://autoliv-eu2.leading2lean.com/api/1.0/dispatches/close/" . $request['dispatch_id'] . "/";
        $completeDispatchUrl = "https://autoliv-eu2.leading2lean.com/api/1.0/dispatches/complete/" . $request['dispatch_id'] . "/";
        $options = [
            "auth" => "ZjbBpxIq0qUYRoEOZkJYlNrEJL5Egkgh",
            "site" => 15,
        ];

        $completeReq = Requests::post($completeDispatchUrl, $headers, $options);
        $completeResp = json_decode($completeReq->body, true);
        if($completeResp['success']){
            $closeReq = Requests::post($closeDispatchUrl, $headers, $options);
            $closeResp = json_decode($closeReq->body, true);
            
            if($closeResp['success']){
                CTDispatches::where('dispatch_id', '=', $request['dispatch_id'])->update(['dispatch_status' => 0]);
                return response()->json(array('success' => true), 200);   
            }elseif($closeResp['error'] === "Dispatch already closed"){
                CTDispatches::where('dispatch_id', '=', $request['dispatch_id'])->update(['dispatch_status' => 0]);
                return response()->json(array('success' => true), 200);   
            }
        }
    }
}