<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Exception;
use Requests;
use App\Models\CTDispatches;

class LinesController extends Controller {
    protected $url = "https://autoliv-eu2.leading2lean.com/api/1.0/";
    protected $auth = "ZjbBpxIq0qUYRoEOZkJYlNrEJL5Egkgh";
    protected $site = 15;

    public function getLinesForAMG(Request $request, $local = false, $localAmg = ""){
        if(!$local){
            $this->validate($request, [
                'amg' => 'required'
            ]);
    
            $amg = $request['amg'];
        }else{
            $amg = $localAmg;
        }

        $url = $this->url . "lines/?auth=" . $this->auth . "&site=" . $this->site . "&areacode=$amg&fields=areacode,code,area,id,active&inactive=F";
        $req = Requests::get($url);
        $response = json_decode($req->body, true);
        if($response['success']){
            if(!$local){
                return response()->json(array('success' => true, 'data' => $response['data']), 200);
            }else {
                return $response['data'];
            }
        }

    }

    public function getNoCTForAmg(Request $request){
        $this->validate($request, [
            'amg' => 'required'
        ]);

        try {
            $data = CTDispatches::where('amg', '=', $request['amg'])->where('dispatch_status', '=', 1)->get();
            return response()->json(array('success' => true, 'data' => $data), 200);
        } catch (Exception $e){
            return response()->json(array('success' => false, 'error' => $e), 200);
        }
    }
}