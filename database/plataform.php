<?php
chdir('../common');
require_once('database.php');
chdir('../database');

/*
 * Creates a new user
*/
function createUser($name,$email,$password,$privilege_id){
    $sql = "INSERT INTO users(name, email, password, registration_date, privilege_id) "
            . "VALUES(?, ?, ?, CURRENT_TIMESTAMP, ?)";
    query($sql, array($name, $email, $password, $privilege_id));
}

/*
 * Activate user
*/

function activateUser($email){
    $sql = "UPDATE FROM users "
            . "SET active = 'true' "
                    . "WHERE email = ?";
    query($sql, array($email));
}

/*
 * Generate user activation hash
*/

function generateActivationHash($userId){
    $sql = "INSERT INTO users_confirmations(user_id, hash) "
            . "VALUES ( ? , ? ) ";
    $hash = substr(str_shuffle(md5(time())),0,10);
    query($sql, array($userId, $hash));
    return $hash;
}


/*
 * Get user_id from an activation
*/

function getActivationUserId($hash){
    $sql = "SELECT user_id "
            . "FROM users_confirmations "
                    . "WHERE hash = ?";
    $result = query($sql, array($hash));
    return isset($result["user_id"])? $result["user_id"] : false;
}

/* Get user activation
 *
*/

function getUserActivation($userID){
    $sql = "SELECT hash "
         . "FROM users_confirmations "
         . "WHERE user_id = ?";
    $result = query($sql, array($userID));
    return isset($result[0]["hash"])? $result[0]["hash"] : false;
}

/*
 * Activate user by hash
*/

function activateUserByHash($hash){
    $userID = getActivationUserId($hash);
    if($userID){
        $sql = "UPDATE FROM users "
                . "SET active = 'true' "
                        . "WHERE id = ?";
        query($sql, array($sql));
        return true;
    }
    return false;
}

/*
 * Login user
*/
function login($email,$password){
    $sql = "SELECT privilege_id "
            . "FROM users "
                    . "WHERE email = ? AND password = ? AND active = 'true'";
    $user = query($sql, array($email, $password));
    return $user ? true : false;
}

/*
 * Get the last stores
*/
function getLastStores(){
    $sql = "SELECT stores.creation_date as date, stores.id, stores.name as store, users.name as owner "
            . "FROM stores, users, stores_users, privileges "
                    . "WHERE stores.id = stores_users.store_id AND stores_users.user_id = users.id "
                            . "AND users.privilege_id = privileges.id AND privileges.name = 'merchant' "
                                    . "ORDER BY stores.creation_date DESC";
    return query($sql);
}

/*
 * Get logos from the stores
*/
function getStoresLogos(){
    $sql = "SELECT stores.id, stores.name, files.path "
            . "FROM stores, files "
                    . "WHERE stores.logo_id = files.id";
    return query($sql);
}
/*
 * Gets all the stores profits
*/
function getStoresProfits($beginDate, $endDate){
    $sql = "SELECT stores.id, stores.name, SUM(invoice.total) as profit "
            . "FROM invoice, orders, stores_users, transactions, stores "
                    . "WHERE invoice.order_id = orders.id AND stores.id = stores_users.store_id "
                            . "AND orders.costumer_id = stores_users.user_id AND orders.paid = 'true' "
                                    . "AND orders.transaction_id = transactions.id AND transactions.transaction_date >= ?"
                                            . "AND transactions.transaction_date < ? "
                                                    . "GROUP BY stores.id "
                                                            . "LIMIT 10";
    return query($sql, array($beginDate, $endDate));
}

/*
 * Get about file path
*/
function getAboutPath(){
    $sql = "SELECT path "
            . "FROM files "
                    . "WHERE path ~* 'about' AND path ~* 'plataform'";
    return query($sql);
}

/*
 * Get all stores
*/
function getStores(){
    $sql = "SELECT * FROM stores";
    return query($sql);
}

/*
 * Get a user by the id
*/
function getUserById($userId){
    $sql = "SELECT * FROM users WHERE id = ?";
    $result = query($sql, array($userId));
    return $result ? $result[0] : false;
}

/*
 * Get a user by the email
*/
function getUserByEmail($userEmail){
    $sql = "SELECT users.id as id, users.name, users.email, privileges.name as privilege "
            . "FROM users, privileges WHERE email = ? AND users.privilege_id=privileges.id ";
    $result = query($sql, array($userEmail));
    return $result ? $result[0] : false;
}

/*
 * Update User
*/
function updateUser($userId, $name, $email, $password, $privilegeId){
    $sql = "UPDATE users "
            . "SET name = ?, email = ?, password = ?, privilege_id=? "
                    . "WHERE id = ?";
    $sqlVars = array($name, $email, $password, $privilegeId, $userId);
    return getUserById($userId)? query($sql,$sqlVars) : false;
}

/*
 * Create Store
*/
function createStore($name, $slogan, $domain, $vat,$logoId){
    $sql = "INSERT INTO stores(name, slogan, domain, vat, creation_date,logo_id) "
            . "VALUES(?, ?, ?, ?, CURRENT_TIMESTAMP,?)";
    query($sql, array($name, $slogan, $domain, $vat,$logoId));
}

function linkStoreToMerchant($merchantId, $storeId)
{
	$sql = "INSERT INTO stores_users(user_id,store_id) VALUES($merchantId,$storeId)";
	return query($sql,array())
}

/*
 * Add a file ans returns its id
*/
function insertFile($name,$path){
    $sql = "INSERT INTO files(name, path) "
            . "VALUES(?, ?) "
                    . "RETURNING id";
    $result=query($sql, array($name, $path));
    return $result[0]['id'];
}
/*
 * Updates a store
*/
function updateStore($storeId,$name,$slogan,$domain,$vat,$logoId){
    $sql = "UPDATE stores "
            . "SET name = ?, slogan = ?, domain = ?, vat = ?, logo_id = ? "
                    . "WHERE id = ?";
    query($sql, array($name, $slogan, $domain, $vat, $logoId, $storeId));
}

/*
 * Delete store
*/
function deleteStore($storeId){
    $sql = "DELETE FROM stores "
            . "WHERE id = ?";
    query($sql, array($storeId));
}

/*
 * Get Merchants
*/

function getMerchants(){
    $sql = "SELECT users.name, users.email, users.registration_date "
            . "FROM users, privileges "
                    . "WHERE users.privilege_id = privileges.id AND privileges.name = 'merchant'";
    return query($sql);
}

/*
 * Create Merchant
*/
function createMerchant($name, $email, $password){
    $sql = "INSERT INTO users(name,email,password,registration_date,privilege_id) "
            . "VALUES(?, ?, ?, CURRENT_TIMESTAMP, (SELECT id FROM privileges WHERE name='merchant')) "
                    . "RETURNING id";
    $result=query($sql, array($name, $email, $password));
    return $result[0]['id'];
}

/*
 * Update Merchant
*/
function updateMerchant($merchantId,$name,$email,$password){
    $sql = "UPDATE users "
            . "SET name = ?,email = ?, password = ? "
                    . "WHERE id = ?";
    query($sql, array($name,$email,$password,$merchantId));
}
/*
 * Delete Merchant
*/
function delete_merchant($merchantId){
    $sql = "DELETE FROM users "
            . "WHERE id = ?";
    query($sql, array($merchantId));
}


?>

