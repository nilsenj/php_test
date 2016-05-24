<?php
/**
 * Created by PhpStorm.
 * User: nilse
 * Date: 5/24/2016
 * Time: 1:46 AM
 */

namespace Core\Mail;


/**
 * Class MailComposerAbstract
 * @package Core\Mail
 */
abstract class MailComposerAbstract
{
    /**
     * @var Drivers\Gmail|string
     */
    private $mail;
    /**
     * @var
     */
    protected $debug;

    /**
     * Create a new mail instance.
     * MailComposerAbstract constructor.
     * @param null $mail
     */
    public function __construct($mail = null)
    {
        $mailer = new Mailer();
        $this->mail = $mailer->mail;
        $this->debug = $mailer->configuration->getConfig('debug');
    }

    /**
     * @param $toEmail
     * @param $subject
     * @param $from
     * @param $view
     * @param array $data
     * @param null $options
     * @return bool
     * @throws \Exception
     */
    protected function sendMail($toEmail, $subject, $from, $view, array $data = array(), $options = null)
    {
        //check debug status
        if ($this->debug) {
            //Don't send mails in debug mode, just write the emails in console
            echo("Send mail to: " . $toEmail . "\r\n" . "<br>");
        } else {
                $result = $this->mail->compose($toEmail, $subject, $from, $view, $data, $options);
            if (!$result)
            {
                throw new \Exception('mail not sent', 500);
            } else {
                return $result;
            }
        }
    }
}