<?php
namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Requests;

class EditCTController extends Controller {
    protected $getUrl = "https://autoliv-eu2.leading2lean.com/api/1.0/lines/get_cycle_times/";
    protected $updateUrl = "https://autoliv-eu2.leading2lean.com/api/1.0/lines/add_update_cycle_time/";
    protected $auth = "ZjbBpxIq0qUYRoEOZkJYlNrEJL5Egkgh";
    protected $site = 15;


    public function getCycleTime(Request $request){
        $this->validate($request, [
            'line_code' => 'required',
            'product_code' => 'required'
        ]);

        try {
            $url = $this->getUrl . "?auth=" . $this->auth . "&site=" . $this->site . "&line_code=" . $request['line_code'] . "&product_code=" . $request['product_code'];
            $req = Requests::get($url);
            $response = json_decode($req->body, true);
            return response()->json($response, 200);
        } catch (Exception $e){
            return response()->json(array('success' => false, 'error' => $e), 200);
        }
    }
}