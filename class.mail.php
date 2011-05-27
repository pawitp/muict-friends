<?php

/**
 * @throws Exception
 * A simple class for sending emails
 */
class Mail {
    /* @var string $content */
    private $content;

    /* @var string[] $recipients */
    private $recipients = array();

    /* @var string $from */
    private $from = "MUICT9.net <no-reply@muict9.net>";

    /* @var string $subject */
    private $subject;

    /**
     * Constructor: does nothing
     */
    public function __construct() {
    }

    /**
     * Sets the message of the email.
     * @param string $content
     * @return void
     */
    public function setContent($content) {
        $this->content = $content;
    }

    /**
     * Add a recipient to the list of recipients.
     * @param string $recipient
     * @return void
     */
    public function addRecipient($recipient) {
        $this->recipients[] = $recipient;
    }

    /**
     * Sets where the email is from. The default is used if none is set.
     * @param string $from
     * @return void
     */
    public function setFrom($from) {
        $this->from = $from;
    }

    /**
     * Sets the subject of the email.
     * @param string $subject
     * @return void
     */
    public function setSubject($subject) {
        $this->subject = $subject;
    }

    /**
     * Sends the email to all the recipients.
     * Throws an exception when not all the fields are set.
     * @throws Exception
     * @return bool The result of the send
     */
    public function send() {
        if ($this->content == null || empty($this->recipients) || $this->from == null || $this->subject == null) {
            var_dump($this);
            throw new Exception("Not all properties are set");
        }

        $header = <<< EOF
MIME-Version: 1.0
Content-type: text/html; charset=utf-8
From: $this->from
X-Mailer: MUICT9 Friends (friends.muict9.net)
EOF;

        $result = true;
        foreach ($this->recipients as $recipient) {
            if (!mail($recipient, $this->subject, $this->content, $header)) {
                $result = false;
            }
        }

        return $result;
    }
}