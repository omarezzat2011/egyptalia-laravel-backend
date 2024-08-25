<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use PHPMailer\PHPMailer\PHPMailer;

class EmailController extends Controller
{
    public function sendEmail(Request $request)
    {
        Log::info('SendEmail method called');

        // Validate the form data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:2000',
        ]);

        Log::info('Validation passed');

        // Prepare the email data
        $data = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'subject' => $request->input('subject'),
            'message' => $request->input('message'),
        ];

        // Construct the HTML message
        $htmlMessage = "
            <html>
            <head>
                <title>Contact Form Submission</title>
            </head>
            <body>
                <h1>New Contact Form Submission</h1>
                <p><strong>Name:</strong> {$data['name']}</p>
                <p><strong>Email:</strong> {$data['email']}</p>
                <p><strong>Phone:</strong> {$data['phone']}</p>
                <p><strong>Subject:</strong> {$data['subject']}</p>
                <p><strong>Message:</strong></p>
                <p>{$data['message']}</p>
            </body>
            </html>
        ";

        // Send the email
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->SMTPDebug = 0;
        $mail->Host = 'smtp.hostinger.com';
        $mail->Port = 587;
        $mail->SMTPAuth = true;
        $mail->Username = 'support@egyptalia.com';  // Replace with your actual username
        $mail->Password = 'sU@304050';  // Replace with your actual password
        $mail->setFrom('support@egyptalia.com', 'Contact Form');
        $mail->addReplyTo('support@egyptalia.com', 'Contact Form');
        $mail->addAddress('hassan@egyptalia.com', 'Contact Form Reciever');  // Replace with the actual recipient
        $mail->Subject = $data['subject'];
        $mail->isHTML(true);  // Set email format to HTML
        $mail->Body = $htmlMessage;

        if (!$mail->send()) {
            Log::error('Mail sending failed: ' . $mail->ErrorInfo);
            return response()->json(['error' => 'Failed to send email'], 500);
        }

        Log::info('Email sent successfully');
        return response()->json(['message' => 'Email sent successfully'], 200);

    }
}
