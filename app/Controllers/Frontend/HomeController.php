<?php

namespace App\Controllers\Frontend;

use App\Models\User;
use PHPMailer\PHPMailer\SMTP;
use App\Controllers\Controller;
use Carbon\Carbon;
use Respect\Validation\Validator;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class HomeController extends Controller
{
    public function getIndex()
    {
        $this->view('home');
    }

    public function getRegister()
    {
        $this->view('register');
    }

    public function postRegister()
    {
        $username       = $_POST['username'];
        $email          = $_POST['email'];
        $profile_photo  = $_FILES['profile_photo'];
        $password       = $_POST['password'];

        $validator = new Validator();

        if ($validator::alnum()->noWhitespace()->validate($username) === false) {
            $errors['username'] = "Username can only contain alphabets or numeric";
        }
        if (strlen($username) < 6) {
            $errors['username'] = "Username must be at least 6 chars";
        }
        if ($validator::email()->validate($email) === false) {
            $errors['email'] = "Email must be a valid email address";
        }
        if (strlen($password) < 6) {
            $errors['password'] = "Password must be at least 6 chars";
        }
        if ($validator::image()->validate($profile_photo['name'])) {
            $errors['profile_photo'] = "Profile photo must be an image file";
        }

        if (empty($errors)) {
            // process file upload
            $file_name = 'pp_' . time();
            $extension = explode('.', $profile_photo['name']);
            $ext = end($extension);
            move_uploaded_file($profile_photo['tmp_name'], 'media/profile_photo/' . $file_name . '.' . $ext);

            $token = sha1($username . $email . uniqid('llc', true));

            User::create([
                'username'  =>  $username,
                'email'  =>  $email,
                'password'  =>  password_hash($password, PASSWORD_BCRYPT),
                'profile_photo' =>  $file_name . '.' . $ext,
                'email_verification_token'  =>  $token
            ]);

            // sending mail
            $mail = new PHPMailer(true);

            try {
                //Server settings
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
                $mail->isSMTP();                                            // Send using SMTP
                $mail->Host       = 'smtp.mailtrap.io';                    // Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                $mail->Username   = '3a8cbc3e9c2e53';                     // SMTP username
                $mail->Password   = 'ea6eac7ed290c8';                               // SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                $mail->Port       = 2525;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

                //Recipients
                $mail->setFrom('mofizul21@gmail.com', 'Admin');
                $mail->addAddress($email, $username);     // Add a recipient

                // Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = 'Registration successfull.';
                $mail->Body    = 'Dear ' . $username . ', <br>your account has been created. Please click on the button to confirming your email address.<br><button><a href="https://smsecom.test/activate/' . $token . '">Confirm email</a></button><br>Thanks for being with us.';

                $mail->send();
                $_SESSION['success'] = 'Email activated successfully';
                header('Location: /login');
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }

            // display success message
            $_SESSION['success'] = "Registration successfull. Check email inbox to activate account.";
            header('Location: /login');
            exit;
        } else {
            $_SESSION['errors'] = $errors;
            header('Location: /register');
            exit;           
        }
    }

    public function getLogin()
    {
        $this->view('login');
    }

    public function postLogin()
    {
        $email          = $_POST['email'];
        $password       = $_POST['password'];

        $errors = [];

        $validator = new Validator();

        if ($validator::email()->validate($email) === false) {
            $errors['email'] = "Email must be a valid email address";
        }
        if (strlen($password) < 6) {
            $errors['password'] = "Password must be at least 6 chars";
        }

        if (empty($errors)) {
            $user = User::select(['id', 'username', 'email', 'password', 'email_verified_at', 'profile_photo'])->where('email', $email)->first();
            if ($user) {
                if ($user->email_verified_at === null) {
                    errMsg('Your account is not activated yet', 'login');
                }
                if (password_verify($password, $user->password) === true) {
                    $_SESSION['success'] = 'Logged in successful';
                    $_SESSION['user'] = [
                        'id'            =>  $user->id,
                        'email'         =>  $user->email,
                        'username'      =>  $user->username,
                        'profile_photo' =>  $user->profile_photo
                    ];
                    header('Location: /dashboard');
                } else {
                    errMsg('Your password is invalid', 'login');
                }
            } else {
                errMsg('Your email not found in our database', 'login');
            }
        }
    }

    public function getActivate($token = '')
    {
        if (empty($token)) {
            $errors[] = 'Token is empty';
            $_SESSION['errors'] = $errors;
            header('Location: /login');
            exit;
        }

        $user = User::where('email_verification_token', $token)->first();

        if ($user) {
            $user->update([
                'email_verification_token' => null,
                'email_verified_at' => Carbon::now(),
            ]);

            $_SESSION['success'] = "Your account has been activated. Enjoy!";
            header('Location: /login');
            exit;
        } else {
            $errors[] = 'Token or user is invalid';
            $_SESSION['errors'] = $errors;
            header('Location: /login');
            exit;
        }
    }

    public function getLogout(){
        unset($_SESSION['user']);

        $_SESSION['success'] = "You have logout successfully.";
        header('Location: /login');
    }
}
