<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpMimeMailParser\Parser;
use Illuminate\Support\Facades\Mail;
use App\Models\Mailcontent;
use Exception;


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
    
        if (! function_exists('imap_open')) {
            echo "Error: IMAP is not configured.";
            exit();
          }
         
            $imapPath = '{secure341.inmotionhosting.com:993/imap/ssl}INBOX';
            $username="sivaranjani@cgvakindia.com";
            $password="CGwelcome@123";
            // Connect to the IMAP server
            //To get the recent mail from reply mail in imap php//
          /*  $imap_stream = imap_open($imapPath, $username, $password);

            // Search for emails in the INBOX folder
            $email_ids = imap_search($imap_stream, "ALL");

            // Loop through each email
            foreach ($email_ids as $email_id) {
                // Get the email overview
                $overview = imap_fetch_overview($imap_stream, $email_id, 0)[0];
                //print_r($overview);
            // print_r($overview->in_reply_to);
                // Check if the email is a reply to a previous email
                if (!empty($overview->in_reply_to)) {
                    // Search for the previous email in the mailbox
                    $prev_email_ids = imap_search($imap_stream, 'HEADER Message-ID "' . $overview->in_reply_to . '"');
                    
                    // If the previous email is found, loop through each email to find the most recent reply
                    if (!empty($prev_email_ids)) {
                        $most_recent_reply_id = null;
                        $most_recent_reply_date = null;
                        foreach ($prev_email_ids as $prev_email_id) {
                            $prev_overview = imap_fetch_overview($imap_stream, $prev_email_id, 0)[0];
                            if ($most_recent_reply_date === null || $prev_overview->date > $most_recent_reply_date) {
                                $most_recent_reply_id = $prev_email_id;
                                $most_recent_reply_date = $prev_overview->date;
                            }
                        }
                        // $most_recent_reply_id now contains the ID of the most recent reply to the previous email
                        // Print the headers and body of the most recent reply
                        $most_recent_reply_headers = imap_fetchheader($imap_stream, $most_recent_reply_id, FT_PREFETCHTEXT);
                        $most_recent_reply_body = imap_fetchbody($imap_stream, $most_recent_reply_id, '1.1', FT_UID | FT_PREFETCHTEXT);
                        echo "Most recent reply headers: \n" . $most_recent_reply_headers . "\n";
                        echo "Most recent reply body: \n" . $most_recent_reply_body . "\n";
                    }
                } else {
                    // This is a fresh email, print its headers and body
                    $email_headers = imap_fetchheader($imap_stream, $email_id, FT_PREFETCHTEXT);
                    $email_body = imap_fetchbody($imap_stream, $email_id, '1.1', FT_UID | FT_PEEK | FT_INTERNAL);

                    //$email_body = imap_fetchbody($imap_stream, $email_id, '1.1', FT_UID | FT_PREFETCHTEXT);
                    echo "Email headers: \n" . $email_headers . "\n";echo "<br>";
                    echo "Email body: \n" . $email_body . "\n";
                }
                // Print the date and from address for both types of emails
                echo "Date: " . $overview->date . "\n";
                echo "From: " . $overview->from . "\n\n";
            }

            // Close the IMAP connection
            imap_close($imap_stream);
            die;*/
           // Open connection
//$mbox = imap_open($imapPath,$username,$password) or die('Cannot connect to CGVAK: ' . imap_last_error());
// $msgnos = imap_search($mbox, "ALL", SE_UID);
// $i=0;
// foreach($msgnos as $msgUID) {
//     $msgNo = imap_msgno($mbox, $msgUID);
//     $head = imap_headerinfo($mbox, $msgNo);
//     $mail[$i][] = $msgUID;
//     $mail[$i][] = $head->Recent;    
//     $mail[$i][] = $head->Unseen;    
//     $mail[$i][] = $head->from[0]->mailbox."@".$head->from[0]->host; 
//     $mail[$i][] = utf8_decode(imap_utf8($head->subject));   
//     $mail[$i][] =  imap_fetchbody($mbox, $mail->msgno, '1');
  
//     $mail[$i][] = $head->udate;
// }
// return $mail;
// imap_close($mbox);
          
           $imapStream = imap_open($imapPath, $username, $password);
            if (!$imapStream) {
                die('Unable to connect to the IMAP server');
            }
            
            $emailHeaders = imap_headers($imapStream);
          
          $email_messages = imap_search($imapStream, 'ALL');
          $output = '';

          foreach ($email_messages as $email_number) {
            $parser = new Parser();
            $raw_email = imap_fetchbody($imapStream, $email_number, '');
            $parser->setText($raw_email);
            $msgNo = imap_msgno($imapStream, $email_number);
            $from = $parser->getHeader('from');//$host = $parser->getServerHostname();
            $to = $parser->getHeader('to');
            $emailrecv_date = date('Y-m-d H:i:s', strtotime($parser->getHeader('date')));
            $subject = $parser->getHeader('subject');
            $text = $parser->getMessageBody('text');
            $html = $parser->getMessageBody('html');
            // //echo $msgNo;
            echo 'Message from: ' . $from. "<br>";
            echo 'Message subject: ' . $subject. "<br>";
            echo 'Message date: ' . $emailrecv_date. "<br>";
            echo 'Message Body: ' . $text. "<br>";
          //echo 'Message host: ' . $host. "<br>";
            // Do something with the extracted data
            // For example, store it in a database or format it as CSV or JSON
            // $emailStructure = imap_fetchstructure($imapStream,$email_number);

            // if(!isset($emailStructure->parts)) {
            // $output .= imap_body($imapStream, $email_number, FT_PEEK);
            // }
            // echo $output;

            $checkexist=Mailcontent::where('mailrecvdate','>',date('Y-m-d H:i:s'))->get();
           if($checkexist){
            Mailcontent::create([
            'from' => $from,
            'subject' => $subject,
            'mailrecvdate' => $emailrecv_date,
            'body'=>$text
        ]);
       }
          }
     
        //openapi fun call
        $getmaildata=Mailcontent::skip(16)->take(4)->get();
        $prompt = '';
        foreach ($getmaildata as $email) {
        if (!empty($email['body'])) {
          $prompt .= "{$email['body']}\n\n";
          $score =$this->generate_text($prompt);
          $sentiment = $score >= 0.5 ? 'Positive' : 'Negative'; // assuming a threshold of 0.5 for positive sentiment
          echo "Email sentiment: {$sentiment}\n";
          $emailModel = Mailcontent::where('id', $email['id'])->first();
          $emailModel->OpenAIemotional_status = $sentiment;
          $emailModel->is_process = 1;
          $emailModel->save();
        }
      }
      $prompt .= "Email sentiment ratings:";
        return view('home');
    }

    function generate_text($prompt) {
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
