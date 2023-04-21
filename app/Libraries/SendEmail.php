<?php

namespace App\Libraries;

use Mail;

use App\Mail\EmailError;
use App\Models\EmailQueues;

use App\Mail\Notification;

class SendEmail {
    public static function sendRegularEmails()
    {
        $email_details = EmailQueues::where(array('status' => 0, 'error' => 0))
            ->orderBy('priority', 'asc')
            ->take(5)
            ->get()->toarray();

        if (!empty($email_details)) {
            foreach ($email_details as $details) {
                $template = ($details['message'] != '') ? 'default' : $details['template'];
                if ($template != 'default') {
                    $details['template_details'] = json_decode($details['template_details'], true);
                }
                $update_status = EmailQueues::find($details['id']);
                $is_invalid_template = false;
                try {
                    switch ($template) {
                        case 'notification':
                            Mail::send(new Notification($details));
                            break;
                        default:
                            $is_invalid_template = true;
                            $update_status->error = 1;
                            $update_status->error_message = 'invalid template';
                            $update_status->save();
                            break;
                    }
                    if ($is_invalid_template) {
                        continue;
                    }
                    $update_status->status = 1;
                } catch (\Exception $e) {
                    $update_status->error = 1;
                    $update_status->error_message = $e->getMessage();
                }
                $update_status->save();
            }
        }
    }

    public static function reportFailedEmails()
    {
        $email_details = EmailQueues::where(array('status' => 0, 'error' => 1))
            ->orderBy('priority', 'asc')
            ->take(10)
            ->get()->toarray();
        if (!empty($email_details)) {
            foreach ($email_details as $details) {
                $update_status = EmailQueues::find($details['id']);
                Mail::send(new EmailError($details));
                $update_status->status = 1;
                $update_status->save();
            }
        }
    }

    public static function insertTemplateMails()
    {

        $details = array(
            'from' => 'test@gmail.com',
            'to' => 'johndoe@gmail.com',
            'cc' => '',
            'bcc' => '',
            'subject' => 'Subject',
            'message' => '',
            'template' => 'notification',
            'template_details' => '{"name":"Test User"}',
            'attachments' => '',
            'error_message' => '',
            'priority' => 1,
        );
        EmailQueues::create($details);
    }

    public static function reSendRegularEmail($id)
    {
        $email_details = EmailQueues::where('id',  $id)
            ->orderBy('priority', 'asc')
            ->take(5)
            ->get()->toarray();

        if (!empty($email_details)) {
            foreach ($email_details as $details) {
                $template = ($details['message'] != '') ? 'default' : $details['template'];
                if ($template != 'default') {
                    $details['template_details'] = json_decode($details['template_details'], true);
                }
                $update_status = EmailQueues::find($details['id']);
                $is_invalid_template = false;
                try {
                    switch ($template) {
                        case 'notification':
                            Mail::send(new Notification($details));
                            break;
                        default:
                            $is_invalid_template = true;
                            $update_status->error = 1;
                            $update_status->error_message = 'invalid template';
                            $update_status->save();
                            break;
                    }
                    if ($is_invalid_template) {
                        continue;
                    }
                    $update_status->status = 1;
                } catch (\Exception $e) {
                    $update_status->error = 1;
                    $update_status->error_message = $e->getMessage();
                }
                $update_status->save();
            }
        }
    }
}
