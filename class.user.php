<?php

class InvalidUserIdException extends Exception {}

class ValidationException extends Exception {
    private $display;
    private $type;
    private $data;
    
    public function __construct($display, $type, $data) {
        $this->display = $display;
        $this->type = $type;
        $this->data = $data;
        
        l("VerifyFail", $data, "$type | $display");
    }
    
    public function getDisplayName() {
        return $this->display;
    }
    
    public function getType() {
        return $this->type;
    }
    
    public function getData() {
        return $this->data;
    }
}

class User {
    private $dirty = array();
    private $values = array();

    private function __construct() { }

    public static function fromId($id, $preload = 'id') {
        $user = new User();
        $user->values["id"] = intval($id);
        $user->loadProperties($preload);

        return $user;
    }

    public function __destruct() {
        if (!empty($this->dirty)) {
            $list = implode(", ", array_keys($this->dirty));
            l("UserNotSaved", $list, "");
            echo ("User object not saved. Dirty: " . $list);
        }
    }
    
    public function getId() {
        // This value is always available
        return $this->values["id"];
    }
    
    // 1 = นาย, 2 = นางสาว
    public function getNamePrefix() {
        return $this->getProperty("type");
    }

    public function setNamePrefix($value) {
        if ($value == 1 || $value == 2) {
            $this->setProperty("type", $value);
        }
        else {
            throw new ValidationException("คำนำหน้าชื่อ", "type", $value);
        }
    }

    public function getThaiNamePrefix() {
        return ($this->getProperty("type") == 1) ? "นาย" : "นางสาว";
    }
    
    public function getThaiFirstName() {
        return $this->getProperty("name");
    }
    
    public function getThaiLastName() {
        return $this->getProperty("sname");
    }
    
    public function getThaiFullName() {
        return $this->getThaiNamePrefix() . " " . $this->getThaiFirstName() . " " . $this->getThaiLastName();
    }
    
    public function getThaiNickname() {
        return $this->getProperty("nickname");
    }
    
    public function setThaiNickname($value) {
        $this->throwIfFalse(preg_match("/^[0-9ก-๙ \(\)\[\]เ]+$/", $value), "ชื่อเล่นภาษาไทย", "nickname", $value);
        $this->setProperty("nickname", $value);
    }
    
    public function getEngNickname() {
        return $this->getProperty("eng_nickname");
    }
    
    public function setEngNickname($value) {
        $this->throwIfFalse(preg_match("/^[A-Za-z0-9 \(\)\[\]]+$/", $value), "ชื่อเล่นภาษาอังกฤษ", "eng_nickname", $value);
        $this->setProperty("eng_nickname", $value);
    }

    public function getRound() {
        return $this->getProperty("round");
    }

    public function getAbout() {
        return $this->getProperty("about");
    }
    
    public function setAbout($value) {
        // TODO: safe html
        $this->setProperty("about", $value);
    }
    
    public function getSec() {
        $sec = intval($this->getProperty("sec"));
        if ($sec == 0) {
            $sec = "N/A";
        }
        return $sec;
    }
    
    public function setSec($value) {
        if ($value > 0 && $value < 4) {
            $this->setProperty("sec", $value);
        }
        else {
            throw new ValidationException("Sec", "sec", $value);
        }
    }
    
    // No validation needed for facebook setters -> valid values from facebook
    public function getFacebookName() {
        return $this->getProperty("fbname");
    }
    
    public function setFacebookName($value) {
        $this->setProperty("fbname", $value);
    }
    
    public function getFacebookUrl() {
        return $this->getProperty("fburl");
    }
    
    public function setFacebookUrl($value) {
        $this->setProperty("fburl", $value);
    }
    
    public function getFacebookEmail() {
        return $this->getProperty("fbemail");
    }
    
    public function setFacebookEmail($value) {
        $this->setProperty("fbemail", $value);
    }
    
    public function getFacebookId() {
        return $this->getProperty("fbid");
    }
    
    public function setFacebookId($value) {
        $this->setProperty("fbid", $value);
    }
    
    public function getFacebookImageUrl() {
        return $this->getProperty("fbpic");
    }
    
    public function setFacebookImageUrl($value) {
        $this->setProperty("fbpic", $value);
    }
    
    public function getEmail() {
        return $this->getProperty("email");
    }
    
    public function setEmail($value) {
        $this->throwIfFalse($this->validateEmail($value), "อีเมล", "email", $value);
        $this->setProperty("email", $value);
    }
    
    public function clearEmail() {
        $this->setProperty("email", null);
    }
    
    public function getMobile() {
        return $this->getProperty("mobile");
    }
    
    public function setMobile($value) {
        $this->throwIfFalse($this->validateMobile($value), "เบอร์มือถือ", "mobile", $value);
        $this->setProperty("mobile", $value);
    }
    
    public function clearMobile() {
        $this->setProperty("mobile", null);
    }
    
    public function getSkype() {
        return $this->getProperty("skype");
    }
    
    public function setSkype($value) {
        $this->throwIfFalse($this->validateUsername($value), "Skype", "skype", $value);
        $this->setProperty("skype", $value);
    }
    
    public function clearSkype() {
        $this->setProperty("skype", null);
    }
    
    public function getBBM() {
        return $this->getProperty("bb");
    }
    
    public function setBBM($value) {
        $this->throwIfFalse(preg_match("/^[0-9A-Fa-f]+$/", $value), "BB Pin", "bbm", $value);
        $this->setProperty("bb", $value);
    }
    
    public function clearBBM() {
        $this->setProperty("bb", null);
    }
    
    public function getMSN() {
        return $this->getProperty("msn");
    }
    
    public function setMSN($value) {
        $this->throwIfFalse($this->validateEmail($value), "MSN", "msn", $value);
        $this->setProperty("msn", $value);
    }
    
    public function clearMSN() {
        $this->setProperty("msn", null);
    }
    
    public function getTwitter() {
        return $this->getProperty("twitter");
    }
    
    public function setTwitter($value) {
        $this->throwIfFalse($this->validateUsername($value), "Twitter", "twitter", $value);
        $this->setProperty("twitter", $value);
    }
    
    public function clearTwitter() {
        $this->setProperty("twitter", null);
    }
        
    public function getGTalk() {
        return $this->getProperty("gtalk");
    }
    
    public function setGTalk($value) {
        $this->throwIfFalse($this->validateEmail($value), "GTalk", "gtalk", $value);
        $this->setProperty("gtalk", $value);
    }
    
    public function clearGTalk() {
        $this->setProperty("gtalk", null);
    }
    
    public function getWhatsApp() {
        return $this->getProperty("whatsapp");
    }

    public function setWhatsApp($value) {
        $this->throwIfFalse($this->validateMobile($value), "WhatsApp", "whatsapp", $value);
        $this->setProperty("whatsapp", $value);
    }
    
    public function clearWhatsApp() {
        $this->setProperty("whatsapp", null);
    }
    
    public function getIdStatus() {
        return $this->getProperty("idstatus");
    }
    
    public function setIdStatus($value) {
        return $this->setProperty("idstatus", $value);
    }
    
    public function getImageUrl() {
        return $this->getProperty("img");
    }

    public function setImageUrl($value) {
        $this->setProperty("img", $value);
    }

    public function isAdmin() {
        return $this->getProperty("admin") > 0;
    }
    
    public function setAdmin($bool) {
        if ($bool) {
            $this->setProperty("admin", true);
        }
        else {
            $this->setProperty("admin", false);
        }
    }
    
    public function getBirthday() {
        return $this->getProperty("BD");
    }

    public function setBirthday($value) {
        return $this->setProperty("BD", $value);
    }

    public function verifyPassword($password) {
        $encpass = substr(sha1($password), 0, 20);
        return $encpass == $this->getProperty("password");
    }
    
    public function verifyEncodedPassword($password, $secret) {
        $enc_db_pass = sha1($secret . $this->getProperty("password"));
        return $password == $enc_db_pass;
    }
    
    public function setPassword($value) {
        $this->setProperty("password", substr(sha1($value), 0, 20));
    }
    
    public function verifyActivationCode($code) {
        return $this->verifyCode("activation_code", $code, true);
    }

    public function getActivationCode() {
        return $this->getProperty("activation_code");
    }

    public function generateActivationCode() {
        return $this->generateCode("activation_code");
    }
    
    public function verifyPasswordRecoveryCode($code) {
        return $this->verifyCode("password_recovery_code", $code);
    }

    public function getPasswordRecoveryCode() {
        return $this->getProperty("password_recovery_code");
    }

    public function generatePasswordRecoveryCode() {
        return $this->generateCode("password_recovery_code");
    }

    public function clearPasswordRecoveryCode() {
        $this->setProperty("password_recovery_code", null);
    }

    public function verifyCode($prop, $code, $delete = false) {
        $dbcode = $this->getProperty($prop);
        $ret = ($code == $dbcode && $dbcode != "");
        if ($ret && $delete) {
            $this->setProperty($prop, null);
        }
        return $ret;
    }
    
    private function generateCode($prop) {
        $code = generate_code();
        $this->setProperty($prop, $code);
        return $code;
    }

    public function deleteAccount() {
        $this->setProperty("email", null);
        $this->setProperty("password", null);
        $this->setProperty("idstatus", -1);
    }

    // Reset dirty, does not reset values
    public function discard() {
        $this->dirty = array();
    }

    public function save() {
        if (empty($this->dirty)) {
            return;
        }
        
        $update = "";
        foreach (array_keys($this->dirty) as $prop) {
            $value = $this->values[$prop];
            if ($value == null) {
                $escaped = "NULL";
            }
            else {
                $escaped = "'" . mysql_real_escape_string($value) . "'";
            }
            
            $update .= "$prop=$escaped,";
        }
        $update = substr($update, 0, -1); // Remove trailing comma
        
        mysql_query_log("UPDATE muict SET $update WHERE id=" . $this->getId());
        
        $this->dirty = array();
    }
    
    private function getProperty($prop) {
        if (!array_key_exists($prop, $this->values)) {
            $this->loadProperties($prop);
        }
        
        return $this->values[$prop];
    }

    private function setProperty($prop, $value) {
        $this->values[$prop] = $value;
        $this->dirty[$prop] = true;
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
    
    private function validateMobile($num) {
        return preg_match("/^[0-9]+$/", $num);
    }
    
    private function validateEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
    
    private function validateUsername($username) {
        return preg_match("/^[0-9A-Za-z\.\,\# _]+$/", $username);
    }
    
    private function throwIfFalse($bool, $display, $type, $data) {
        if (!$bool) {
            throw new ValidationException($display, $type, $data);
        }
    }
}

?>