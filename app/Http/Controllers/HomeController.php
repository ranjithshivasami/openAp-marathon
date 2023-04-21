<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpMimeMailParser\Parser;
use Illuminate\Support\Facades\Mail;
use App\Models\Mailcontent;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\UserMailsetting;
use App\Models\EmailQueues;
use Config;
use App\Libraries\SendEmail;
use Carbon\Carbon;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function mailnotify()
    {
        return view('mailnotify');
       
    }
    public function getMailInfo()
    {
        $user = Auth::user();
        $getuserdata = UserMailSetting::where('user_id', $user->id)->get();
      
        if ($getuserdata->count() > 0) {
        $imapPath = '{secure341.inmotionhosting.com:993/imap/ssl}INBOX';
        //foreach ($getuserdata as $data) {
        $username = $getuserdata->primary_email;
        $password = $getuserdata->password;
        // SELECT mailrecvdate FROM `mail_contents` order by mailrecvdate DESC LIMIT 1;
        $imapStream = imap_open($imapPath, $username, $password);
         if (!$imapStream) {
            return view('error', ['message' => 'Unable to connect to the IMAP server']);

         }
        $emailHeaders = imap_headers($imapStream);
          // Get the maximum timestamp value from the Mailcontent table
        $max_timestamp = Mailcontent::where('email_id', $getuserdata->primary_email)->max('mailrecvdate');
        // search for the latest 10 emails
        $email_messages = imap_search($imapStream, 'ALL');
        rsort($email_messages);
        // Get the first 10 messages
        $email_messages = array_slice($email_messages, 0, 10);
         $output = '';
         if (!empty($email_messages)) {
         foreach ($email_messages as $email_number) {
         
         $parser = new Parser();
         $raw_email = imap_fetchbody($imapStream, $email_number, '');
         $parser->setText($raw_email);
         $msgNo = imap_msgno($imapStream, $email_number);
         $from = $parser->getHeader('from');//$host = $parser->getServerHostname();
         $to = $parser->getHeader('to');
         try {
            $email_date = Carbon::createFromFormat('D, d M Y H:i:s O', $parser->getHeader('date'));
            $emailrecv_date = $email_date->format('Y-m-d H:i:s');
        } catch (Exception $e) {
            // Handle parsing errors here, such as setting a default date or skipping the processing of this email
            $emailrecv_date = null;
        }
         $subject = $parser->getHeader('subject');
         $text = $parser->getMessageBody('text');
         $html = $parser->getMessageBody('html');
           
         // Check if the email's timestamp is greater than the maximum timestamp in the table
         if ($emailrecv_date > $max_timestamp) { //print_r($emailrecv_date);
             // Create a new email record in the Mailcontent table
             if (!empty($text)) {
                
             Mailcontent::create([
                 'from' => $from,
                 'subject' => $subject,
                 'mailrecvdate' => $emailrecv_date,
                 'body' => $text,
                 'email_id'=>$getuserdata->primary_email
             ]);
         }
         }

       }
    }
    // }
    }
     //openapi fun call
     $getmaildata = Mailcontent::where('is_process', 0)->limit(10)->get();
     $prompt = '';
     $responses = [];
     if(!empty($getmaildata)){
     foreach ($getmaildata as $email) {
     if (!empty($email['body'])) {
       $prompt .= "{$email['body']}\n\n";
       $score =$this->generate_text($prompt);
       $sentiment = $score >= 0.7 ? 'Positive' : 'Negative'; // assuming a threshold of 0.5 for positive sentiment
       //echo "Email sentiment: {$sentiment}\n";
       $emailModel = Mailcontent::where('id', $email['id'])->first();
       $emailModel->OpenAIemotional_status = $sentiment;
       $emailModel->is_process = 1;
       $emailModel->save();
    
          // Add the sentiment to the responses array
          $responses[] = [
            'from' => $email['from'],
            'sentiment' => $sentiment,
        ];

        }
    }
    }
    return response()->json($responses);
    }
    function generate_text($prompt) {
        //echo $prompt;die;
        // set the request URL
        $url = 'https://api.openai.com/v1/completions';
    
        // set the request headers
        $headers = array(
            'Content-Type: application/json',
            'Authorization: Bearer ' . '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',
        );
    
        // set the request data
        $data = array(
            'model' => 'text-davinci-003',
            'prompt' => $prompt,
            'temperature' => 0,
            'max_tokens' => 60,
            'top_p' => 1,
            'frequency_penalty' => 0,
            'presence_penalty' => 0,
        );
    
        // initialize curl
        $curl = curl_init();
    
        // set curl options
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_POST => true,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_POSTFIELDS => json_encode($data),
        ));
    
        // execute the curl request
        $response = curl_exec($curl);
    
        // check for curl errors
        if ($error = curl_error($curl)) {
            // handle the error
            throw new Exception('Curl error: ' . $error);
        }
    
        // get the HTTP response code
        $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        
        // close curl
        curl_close($curl);  
    
        // check the HTTP response code
        if ($http_code != 200) {
            // handle the error
            throw new Exception('API error: ' . $http_code);
        }
    
        // decode the JSON response
        $result = json_decode($response, true);
    
        // get the generated text
        $text = $result['choices'][0]['text'];
    
        // return the generated text
       return $text;
    }
   
     
}
