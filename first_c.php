<?php
require("bootstrap.php");

$id = intval($_POST["id"]);
$type = intval($_POST["type"]);
$name = $_POST["name"];
$sname = $_POST["sname"];
$round = intval($_POST["round"]);

$smarty = get_smarty();

try {
    $user = User::fromId($id, 'type, name, sname, round, idstatus');
    $smarty->assign("user", $user);

    if ($user->getNamePrefix() == $type && $user->getThaiFirstName() == $name && $user->getThaiLastName() == $sname && $user->getRound() == $round) {
        if ($user->getIdStatus() > 0) {
            $smarty->assign("status", "already_registered");
        }
        else {
            $smarty->assign("status", "success");
            $_SESSION['reg_id']=$id;
        }
    }
    else {
        throw new InvalidUserIdException();
    }
}
catch (InvalidUserIdException $e) {
    $smarty->assign("status", "invalid_info");
    echo "ข้อมูลที่กรอกมาไม่ถูกต้อง  หากกรอกถูกต้องแล้ว โปรดติดต่อผู้ดูแลระบบผ่านทาง<a href='index.php'>หน้าแรก</a> <a href='javascript: history.go(-1)'>กลับไปแก้ไข</a> ";
}

$smarty->display("first_c.tpl");