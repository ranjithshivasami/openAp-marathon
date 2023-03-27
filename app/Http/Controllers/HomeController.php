<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpMimeMailParser\Parser;
use Illuminate\Support\Facades\Mail;
use App\Models\Mailcontent;

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
    public function index()
    {
        //echo phpinfo();
        if (! function_exists('imap_open')) {
            echo "Error: IMAP is not configured.";
            exit();
          }
         
            $imapPath = '{mail1.cgvakindia.com:993/imap/ssl}INBOX';
            $username="sivaranjani@cgvakindia.com";
            $password="asWRd21454yy624FurafwW";
           // $password="9Z2stfpCGWvakbu8HBud";
          
            $imapStream = imap_open($imapPath, $username, $password);
            if (!$imapStream) {
                die('Unable to connect to the IMAP server');
            }
            
            $emailHeaders = imap_headers($imapStream);
          
          $email_messages = imap_search($imapStream, 'UNSEEN');
          foreach ($email_messages as $email_message) {
            // Retrieve the email header information
            $email_header = imap_headerinfo($imapStream, $email_message);

            $date = $email_header->date;      
            $emailrecv_date3 = date('Y-m-d H:i:s', strtotime($email_header->date));

           // Display the email sender, subject, and date
            //echo "From: " . $email_header->from[0]->mailbox . "@" . $email_header->from[0]->host . "<br>";
            //echo "Subject: " . $email_header->subject . "<br>";
            //echo "Date: " . $email_header->date . "<br>";
           // echo "Date: ".$emailrecv_date3."<br>";
            // Retrieve the email body
           $email_body = imap_fetchbody($imapStream, $email_message, '1.1');
    
            // Display the email body
           // echo "Body: " . $email_body . "<br>";

            $checkexist=Mail_content::where('mailrecvdate','>',date('Y-m-d H:i:s'))->get();
            if($checkexist){
            Mailcontent::create([
            'from' => $email_header->from[0]->mailbox . "@" . $email_header->from[0]->host,
            'subject' => $email_header->subject,
            'mailrecvdate' => $emailrecv_date3,
            'body'=>$email_body
        ]);
        }
        }
        
        imap_close($imapStream);
        //openapi fun call
        //$get=$this->generate_text($email_body);
        $get=$this->generate_text('I hate chocolate');
        print_r($get);
        return view('home');
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
