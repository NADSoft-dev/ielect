<?php

namespace App\Console\Commands;
use Carbon\Carbon;
use Illuminate\Console\Command;
use DB;
class SendNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notifications:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }


    function sendMessage($message,$id){
		$content = array(
			"en" => $message
			);
		
		$fields = array(
			'app_id' => "7bbeff84-1764-411e-8688-61d90e45a13a",
			'include_player_ids' => array($id),
			'contents' => $content
		);
		
		$fields = json_encode($fields);
   
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");

        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
												   'Authorization: Basic ZThkNGYwYmUtZmYwYy00NDFhLWJlN2EtN2JmMWIwMGY1NWQ2'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

		$response = curl_exec($ch);
		curl_close($ch);
		
		return $response;
	}

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $closeTime=Carbon::createFromFormat('Y-m-d H', '2018-10-30 22');
        $startDate=Carbon::createFromFormat('Y-m-d H', '2018-10-30 8');
        if($startDate->isFuture()) return false;
        $delegates=DB::table('delegate')->whereNotNull('onesignal_token')->select('*')->get();
        foreach($delegates as $row){
            $voted=0;
            $total=0;
            $notVoted=0;
            $electors=DB::table('electors')->where('manid',$row->id)->select('*')->get();
            foreach($electors as $elector){
                $total++;
                if($elector->voted==1) $voted++;
            }
            $notVoted=$total-$voted;

          
            $closeHours=Carbon::now()->diffInHours($closeTime,false);
            if($closeHours>0 && $total){
                $message="ברשימות שלך יש {$total} בוחרים, {$voted} מהם הצביעו, נשארו לסגירת הקלפיות {$closeHours} שעות";
                $this->sendMessage($message,$row->onesignal_token);
            }
          

            
        }





        $delegates=DB::table('personal_list')->whereNotNull('onesignal_token')->select('*')->get();
        foreach($delegates as $row){
            $voted=0;
            $total=0;
            $notVoted=0;
            $electors=DB::table('electors')->where('list',$row->id)->select('*')->get();
            foreach($electors as $elector){
                $total++;
                if($elector->voted==1) $voted++;
            }

          
            $closeHours=Carbon::now()->diffInHours($closeTime,false);
            if($closeHours>0 && $total){
                $message="ברשימות שלך יש {$total} בוחרים, {$voted} מהם הצביעו, נשארו לסגירת הקלפיות {$closeHours} שעות";
                $this->sendMessage($message,$row->onesignal_token);
            }
          

            
        }
    }
}
