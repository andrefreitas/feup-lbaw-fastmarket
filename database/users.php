<?php

    // Get user level
    function getUserLevelByLogin($username, $password) {
        global $db;
        $result = $db->prepare("SELECT level FROM users WHERE username = ? AND password = ?");
        $result->execute(array($username, $password));
        $user = $result->fetch();
	return $user?$user['level']:false;
    }

    function getUserByLogin($username) {
        global $db;
        $result = $db->prepare("SELECT * FROM users WHERE username = ?");
        $result->execute(array($username));
        return $result->fetch();
    }

    function getAllUsers() {
        global $db;
        $result = $db->prepare("SELECT * FROM users");
        $result->execute();
        return $result->fetchAll();
    }

?>
