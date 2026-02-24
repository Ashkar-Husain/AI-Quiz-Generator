<?php

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

if (!function_exists('sendCustomMail')) {

    function sendCustomMail(
        $to,
        $subject,
        $content,
        $isView = false,
        $cc = [],
        $bcc = [],
        $attachments = []
    ) {
        try {

            Mail::send(
                $isView ? $content : [],
                $isView ? [] : [],
                function ($message) use ($to, $subject, $content, $isView, $cc, $bcc, $attachments) {

                    $message->to($to)
                        ->subject($subject);

                    // If raw HTML message
                    if (!$isView) {
                        $message->html($content);
                    }

                    // CC
                    if (!empty($cc)) {
                        $message->cc($cc);
                    }

                    // BCC
                    if (!empty($bcc)) {
                        $message->bcc($bcc);
                    }


                    // Attachments
                    if (!empty($attachments)) {
                        foreach ($attachments as $file) {

                            // If URL
                            if (filter_var($file, FILTER_VALIDATE_URL)) {

                                $tempPath = storage_path('app/temp_' . time() . '.pdf');
                                file_put_contents($tempPath, file_get_contents($file));

                                $message->attach($tempPath);
                            }
                            // If Local File
                            elseif (file_exists($file)) {
                                $message->attach($file);
                            }
                        }
                    }
                }
            );

            return [
                'status' => true,
                'message' => 'Email sent successfully'
            ];
        } catch (\Exception $e) {

            Log::error('Mail Error: ' . $e->getMessage());

            return [
                'status' => false,
                'message' => $e->getMessage()
            ];
        }
    }
}
