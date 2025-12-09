<?php

namespace App\Helpers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class MailHelper
{
    public static function sendVerifyEmail($email, $token)
    {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = $_ENV['SMTP_HOST'];
            $mail->SMTPAuth = true;
            $mail->Username = $_ENV['SMTP_USER'];
            $mail->Password = $_ENV['SMTP_PASS'];
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom($_ENV['SMTP_USER'], "Ludus Store");
            $mail->addAddress($email);

            $verifyUrl = "http://127.0.0.1:8001/verify?token=" . urlencode($token);

            $html = "
            <div style='font-family: Arial, sans-serif; background:#f8f8f8; padding:40px;'>
                <div style='max-width:600px; margin:0 auto; background:#fff; border-radius:12px; padding:30px;
                    box-shadow:0 4px 12px rgba(0,0,0,0.08); border:1px solid #eee;'>

                    <div style='text-align:center; margin-bottom:25px;'>
                        <h2 style='color:#FF6A00; margin:0; font-weight:700;'>Xác thực tài khoản</h2>
                    </div>

                    <p style='font-size:15px; color:#444;'>
                        Xin chào <strong>$email</strong>,
                    </p>

                    <p style='font-size:15px; color:#555; line-height:1.6;'>
                        Cảm ơn bạn đã đăng ký tài khoản.  
                        Vui lòng nhấn vào nút bên dưới để hoàn tất quá trình xác thực email.
                    </p>

                    <div style='text-align:center; margin:35px 0;'>
                        <a href='$verifyUrl'
                            style='background:#FF6A00; color:white; padding:14px 28px; text-decoration:none;
                            border-radius:6px; font-size:17px; font-weight:600; display:inline-block;
                            box-shadow:0 3px 10px rgba(255,106,0,0.3);'>
                            Xác thực tài khoản
                        </a>
                    </div>

                    <p style='font-size:14px; color:#777;'>
                        Nếu nút không hoạt động, hãy copy và mở đường link sau:
                    </p>

                    <p style='word-break:break-all; font-size:14px; color:#FF6A00; font-weight:bold;'>
                        $verifyUrl
                    </p>

                    <hr style='border:none; border-top:1px solid #eee; margin:30px 0;'>      

                    <p style='font-size:12px; color:#999; text-align:center;'>
                        Nếu bạn không yêu cầu tạo tài khoản, vui lòng bỏ qua email này.<br>
                        © 2025 Auth Service. All rights reserved.
                    </p>

                </div>
            </div>
            ";


            $mail->CharSet = 'UTF-8';
            $mail->Encoding = 'base64';

            $mail->isHTML(true);
            $mail->Subject = "Xác thực tài khoản của bạn";
            $mail->Body = $html;
            $mail->Body = $html;

            $mail->send();
        } catch (Exception $e) {
            error_log("Mail error: " . $mail->ErrorInfo);
        }
    }
}
