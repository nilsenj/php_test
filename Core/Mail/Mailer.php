<?php
/**
 * Created by PhpStorm.
 * User: nilse
 * Date: 5/24/2016
 * Time: 4:31 PM
 */

namespace Core\Mail;


use App\MailComposers\ComebackToUsMailComposer;
use App\MailComposers\WelcomeMailComposer;
use Core\Mail\Drivers\Mail;
use Core\Mail\Drivers\Gmail;

class Mailer
{
    /**
     * Mail driver instance
     * @var string
     */
    public $mail;
    /**
     * config
     * @var
     */
    public $configuration;

    /**
     * Mailer constructor.
     */
    public function __construct()
    {
        $this->configuration = new \Core\Config\Config('config/mail.php');
        $default = $this->configuration->getConfig('default');
        $this->mailPath = $this->configuration->getConfig('templates');

        if ($default == 'mail') {
            $this->mail = new Mail($this->configuration);
        }
        if ($default == 'gmail') {

            $this->mail = new Gmail($this->configuration);
        }

    }


    /**
     * get mail type from the MailTemplates directory
     *
     * @param $type
     * @return ComebackToUsMailComposer|WelcomeMailComposer|bool
     */

    /*TODO add the possibility to Make instances with a help of reflection by predefined type name*/

    private function getMailType($type) {

        if (strtolower($type) == 'welcomemail') {
            
            return new WelcomeMailComposer();
        }

        if (strtolower($type) == 'comebacktous') {

            return new ComebackToUsMailComposer();
        }

        return false;
    }

    /**
     * do the mail campaign according to the given mail composer instance
     *
     * @param object $mailComposer
     * @param null $voucher
     * @return mixed
     * @throws \Exception
     */
    public function doMail($mailComposer, $voucher = null){

        if ($mailComposer) {

            return $mailComposer->make($voucher);

        } else {
            throw new \Exception($message = "No MailComposer Instance Provided", $code = 403);
        }
    }

    /**
     * do mail campaign By Composer Type
     * @param $type
     * @param null $voucher
     * @return bool
     * @throws \Exception
     */
    public function doMailByType($type, $voucher = null){

        if ($type) {
            $mail = $this->getMailType($type);
            return $mail->make($voucher);

        } else {
            throw new \Exception($message = "No mail Template Provided", $code = 403);
        }
    }
}