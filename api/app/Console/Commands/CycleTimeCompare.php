<?php
namespace App\Console\Commands;
use Illuminate\Console\Command;
use DateTime;
use Requests;
use App\Models\CTDispatches;

class CycleTimeCompare extends Command {
    protected $signature = "ct:compare";
    protected $description = "Compares daily production summary to line cycle times";
    protected $url = "https://autoliv-eu2.leading2lean.com/api/1.0/";
    protected $auth = "ZjbBpxIq0qUYRoEOZkJYlNrEJL5Egkgh";
    protected $site = 15;
    protected $reportingSubUrl = "reporting/production/daily_summary_data_by_line/";
    protected $showShifts = "true";
    protected $showProducts = "true";
    protected $cycleTimeUrl = "lines/get_cycle_times/";
    protected $dispatchOpenSubUrl = "dispatches/open/";
    protected $dispatchDTC = "Lipsa Cycle Time";

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(){
        $yesterday = new DateTime();
        $yesterday = $yesterday->modify('-1 day')->format('Y-m-d 06:00');
        $today = new DateTime();
        $today = $today->format('Y-m-d 06:00');
        $reportUrl = $this->url . $this->reportingSubUrl . "?auth=" . $this->auth . "&site=" . $this->site . "&start=$yesterday&end=$today&show_shifts=" . $this->showShifts . "&show_products=" . $this->showProducts;
        $reportData = Requests::get($reportUrl);
        $reportData = json_decode($reportData->body, true);

        if($reportData['success']){
            foreach($reportData['data'] as $row){
                if($row['products']){
                    if($row['line_categories'][0] === 22){
                        $ctUrl = $this->url . $this->cycleTimeUrl . "?auth=" . $this->auth . "&site=" . $this->site . "&line_code=" . $row['line'] . "&product_code=" . $row['product'];
                        $cycleTimes = Requests::get($ctUrl);
                        $cycleTimes = json_decode($cycleTimes->body, true);
                        if(!$cycleTimes['success'] || $cycleTimes['success'] && count($cycleTimes['data']) == 0){
                            
                            $check = CTDispatches::where('line', '=', $row['line'])->where('part', '=', $row['product'])->where('dispatch_status', '=', 1)->get();
                            if($check->isEmpty()){
                                //open dispatch and then save to database
                                $headers = ['Content-type' => 'application/x-www-form-urlencoded'];
                                $options = [
                                    'auth' => $this->auth,
                                    'site' => $this->site,
                                    'description' => $row['line'] . " - " . $row['product'],
                                    'dispatchtypecode' => $this->dispatchDTC,
                                    'machinecode' => $row['line']."-General",
                                    'tradecode' => 'Proces'
                                ];

                                $openDispatchUrl = $this->url . $this->dispatchOpenSubUrl;
                                $post = Requests::post($openDispatchUrl, $headers, $options);
                                $response = json_decode($post->body, true);
                                if($response['success']){
                                    $insert = new CTDispatches();
                                    $insert->line = $row['line'];
                                    $insert->part = $row['product'];
                                    $insert->dispatch_id = $response['data']['id'];
                                    $insert->dispatch_status = 1;
                                    $insert->amg = $row['area'];
                                    $insert->save();
                                    $this->info($row['line'] . " - " . $row['product'] . " saved");
                                }
                            }
                        }
                    }
                }
             }
        }
    }
}