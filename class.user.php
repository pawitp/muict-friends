<?php

class InvalidUserIdException extends Exception {}

class User {
    private $dirty = array();
    private $values = array();
    
    public function __construct($id, $preload = '') {
        $this->values["id"] = $id;
        $this->loadProperties(empty($preload) ? $preload : "id");
    }
    
    public function getId() {
        // This value is always available
        return $this->values["id"];
    }
    
    public function getThaiNickname() {
        return $this->getProperty("nickname");
    }
    
    public function getEngNickname() {
        return $this->getProperty("eng_nickname");
    }
    
    public function getAbout() {
        return $this->getProperty("about");
    }
    
    public function getSec() {
        return $this->getProperty("sec");
    }
    
    public function getFacebookName() {
        return $this->getProperty("fbname");
    }
    
    public function getFacebookUrl() {
        return $this->getProperty("fburl");
    }
    
    public function getFacebookEmail() {
        return $this->getProperty("fbemail");
    }
    
    public function getFacebookId() {
        return $this->getProperty("fbid");
    }
    
    public function getFacebookPicUrl() {
        return $this->getProperty("fbpic");
    }
    
    public function getEmail() {
        return $this->getProperty("email");
    }
    
    public function getMobile() {
        return $this->getProperty("mobile");
    }
    
    public function getSkype() {
        return $this->getProperty("skype");
    }
    
    public function getTwitter() {
        return $this->getProperty("twitter");
    }
    
    public function getGTalk() {
        return $this->getProperty("gtalk");
    }
    
    public function getWhatsApp() {
        return $this->getProperty("whatsapp");
    }
    
    public function getIdStatus() {
        return $this->getProperty("idstatus");
    }
    
    public function isAdmin() {
        return $this->getProperty("admin") > 0;
    }
    
    public function verifyPassword($password) {
        $encpass = substr(sha1($password), 0, 20);
        return $encpass == $this->getProperty("password");
    }
    
    public function verifyEncodedPassword($password, $secret) {
        $enc_db_pass = sha1($secret . $this->getProperty("password"));
        return $password == $enc_db_pass;
    }
    
    public function verifyActivationCode($code) {
        return $code == $this->getProperty("activation_code");
    }
    
    public function verifyPasswordRecoveryCode($code) {
        return $code == $this->getProperty("password_recovery_code");
    }
    
    private function getProperty($prop) {
        if (!array_key_exists($prop, $this->values)) {
            $this->loadProperties($prop);
        }
        
        return $this->values[$prop];
    }
    
    private function loadProperties($props) {
        $res = mysql_query_log("SELECT $props FROM muict WHERE id = " . $this->values['id']);
        
        if (mysql_num_rows($res) == 0) {
            throw new InvalidUserIdException();
        }
        
        $row = mysql_fetch_assoc($res);
        
        foreach ($row as $key => $value) {
            $this->values[$key] = $value;
        }
    }
}

?>