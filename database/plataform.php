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
    return isset($result[0]["user_id"])? $result[0]["user_id"] : false;
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
        $sql = "UPDATE users "
             . "SET active = 'true' "
             . "WHERE id = ?";
        query($sql, array($userID));
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
    $sql = "SELECT stores.id, stores.name, files.path as file, files.name as filename, stores.domain "
         . "FROM stores, files "
         . "WHERE stores.logo_id = files.id "
         . "ORDER BY stores.creation_date DESC ";
    return query($sql);
}
/*
 * Gets all the stores profits
*/
function getStoresProfits($beginDate, $endDate){
    $sql = "SELECT stores.id, stores.name, stores.domain,  SUM(invoice.total) as profit "
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
function getStores($merchantId=null){
    if($merchantId){
        $sql = "SELECT * "
             . "FROM stores, stores_users "
             . "WHERE stores.id = stores_users.store_id AND stores_users.user_id = ?";
        return query($sql, array($merchantId));
    }
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
 * Get merchant
 */

function getMerchantByEmail($userEmail){
    $sql = "SELECT users.id as id, users.name, users.email, privileges.name as privilege "
         . "FROM users, privileges WHERE email = ? AND users.privilege_id=privileges.id AND privileges.name='merchant'";
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
         . "VALUES(?, ?, ?, ?, CURRENT_TIMESTAMP,?)
         	RETURNING id ";
    $ret = query($sql, array($name, $slogan, $domain, $vat,$logoId));
    return $ret[0]['id'];
}

/*
	add no category to store
*/
function addNoCategory($store_id)
{
	$name="no category";
	$image="null";
	$sql="INSERT INTO categories(name,store_id,image_id) 
			VALUES(?,?,?)";
	return query($sql,array($name,$store_id,$image));
}

/*
 * Save link image (store logo)
 */
function addLogoImage($url)
{
	$sql = "INSERT INTO files(name, path) 
			VALUES('imageurl',?) 
			RETURNING id ";
	$ret = query($sql, array($url));
	return $ret[0]['id'];
}

/*
 * Add merchant owner to store
 */

function addStoreOwner($storeId, $userId){
    $sql = "INSERT INTO stores_users(store_id, user_id) "
         . "VALUES(?, ? ) ";
    query($sql, array($storeId, $userId));
}

/*
 * Check name and domain of new store
*/
function checkNameDomainStore($name,$domain)
{
	$sql = "SELECT name, domain FROM stores WHERE name=? OR domain=?";
	
	return query($sql, array($name,$domain));
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
    return query($sql, array($name, $slogan, $domain, $vat, $logoId, $storeId));
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

function getMerchants($status=""){
    $sql = "SELECT users.name, users.email, users.registration_date, users.active "
         . "FROM users, privileges "
         . "WHERE users.privilege_id = privileges.id AND privileges.name = 'merchant' ";
    if($status){
        $active = "false";
        if($status == "active")
            $active = "true";
        $sql .= " AND users.active = ".$active." ";
    }
    $sql .= "ORDER BY users.registration_date DESC";
    $merchants = query($sql);
    foreach ($merchants as &$merchant){
        if($merchant["active"]){
            $merchant["status"] = "active";
        }else{
            $merchant["status"] = "pending";
        }
    }
    return $merchants;
}

/* 
 * Search Merchants
 */

function searchMerchants($term){
    $sql = "SELECT users.name, users.email, users.registration_date, users.active "
         . "FROM users, privileges "
         . "WHERE users.privilege_id = privileges.id AND privileges.name = 'merchant' AND ( users.name ~* ? OR users.email ~* ?) "
         . "ORDER BY users.registration_date DESC";
    $merchants = query($sql, array($term, $term));
    foreach ($merchants as &$merchant){
        if($merchant["active"]){
            $merchant["status"] = "active";
        }else{
            $merchant["status"] = "pending";
        }
    }
    return $merchants;
}

/* 
 * Search Stores
 */

function searchStores($term, $merchantId = null){
    if($merchantId){      
        $sql = "SELECT * "
             . "FROM stores, stores_users "
             . "WHERE ( name ~* ? OR domain ~* ? OR slogan ~* ?) AND stores_users.user_id = ? AND  stores_users.store_id = stores.id "
             . "ORDER BY creation_date DESC";
        return query($sql, array($term, $term, $term, $merchantId));
    }
    $sql = "SELECT * "
         . "FROM stores "
         . "WHERE ( name ~* ? OR domain ~* ? OR slogan ~* ?) "
         . "ORDER BY creation_date DESC";
    return query($sql, array($term, $term, $term));  
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
function updateMerchantName($merchantId, $name){
    $sql = "UPDATE users "
         . "SET name = ? "
         . "WHERE id = ?";
    query($sql, array($name, $merchantId));
}

function updateMerchantEmail($merchantId, $email){
    $sql = "UPDATE users "
         . "SET email = ? "
         . "WHERE id = ?";
    query($sql, array($email, $merchantId));
}

function updateMerchantPassword($merchantId, $password){
    $sql = "UPDATE users "
          . "SET password = ? "
          . "WHERE id = ?";
    query($sql, array($password, $merchantId));
}


function updateMerchantStatus($merchantId, $status){
    $active = "false";
    if($status == "active")
        $active = "true";
    $sql = "UPDATE users "
         . "SET active = ? "
         . "WHERE id = ?";
    query($sql, array($active, $merchantId));
}


/*
 * Delete Merchant
*/
function delete_merchant($merchantId){
    $sql = "DELETE FROM users "
         . "WHERE id = ?";
    query($sql, array($merchantId));
}

/* 
 * Get new stores by months
 */
function getNewStoresByMonths($year){
    $sql = "SELECT  EXTRACT (MONTH FROM creation_date) as month, count(*) as total "
         . "FROM stores "
         . "WHERE  EXTRACT (YEAR FROM creation_date) = ? "
         . "GROUP BY month";
    return query($sql, array($year));
}

/** Update Account (Admins or Merchants)**/
function updateAccountEmail($oldEmail, $newEmail){
    $sql = "UPDATE users "
         . "SET email = ? "
         . "WHERE email = ? AND (users.privilege_id = 1 OR users.privilege_id = 2) ";
    query($sql, array($newEmail, $oldEmail));
}

function updateAccountName($email, $name){
    $sql = "UPDATE users "
         . "SET name = ? "
         . "WHERE email = ? AND (users.privilege_id = 1 OR users.privilege_id = 2) ";
    query($sql, array($name, $email));
}

function updateAccountPassword($email, $password){
    $password = hash("sha256", $password);
    $sql = "UPDATE users "
         . "SET password = ? "
         . "WHERE email = ? AND (users.privilege_id = 1 OR users.privilege_id = 2) ";
    query($sql, array($password, $email));
}



?>
