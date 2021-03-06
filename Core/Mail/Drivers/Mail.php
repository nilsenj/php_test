<?php

namespace Core\Mail\Drivers;


/**
 * Class Mail
 * @package Core\Mail
 */
class Mail implements MailContract
{

    /**
     * @var mixed|null
     */
    public $mailPath;

    /**
     * @var \Core\Config\Config
     */
    public $configuration;

    /**
     * Mail constructor.
     * @param $configuration
     * @throws \Exception
     */
    public function __construct($configuration)
    {
        if (empty($configuration)) {
            throw new \Exception($message = 'No configuration provided', 429); // 429 bad instance data provided
        }
        $this->configuration = $configuration;
        $this->mailPath = $configuration->getConfig('templates');
    }

    /**
     * @param $view
     * @param $data
     * @return mixed
     * @throws \Exception
     */
    protected function getMailTemplateFile($view,  $data = [])
    {
        $path = $this->mailPath;

        echo $path;

        if (!is_dir($path)) {

            throw new \Exception('View for email not found!');
        } else {
            return require_once $this->mailPath . $view;
        }
    }

    /**
     * @param $to
     * @param $subject
     * @param $from
     * @param $view
     * @param $data
     * @param $options
     * @return bool
     * @throws \Exception
     */
    public function compose($to, $subject, $from, $view, $data, $options) {

        $headers   = array();
        $headers[] = "MIME-Version: 1.0";
        $headers[] = "Content-type: text/plain; charset=iso-8859-1";
        $headers[] = "From: {$from}";
        $headers[] = "Bcc: {$to}";
        $headers[] = "Subject: {$subject}";
        $headers[] = "X-Mailer: PHP/".phpversion();

        $message = $this->getMailTemplateFile($view, $data);

        mail($to, $subject, $message, implode("\r\n", $headers));

        return true;
    }
    
    
    
}