<?php
require_once __DIR__ . '/config.php';
// 接続処理を行う関数
function connect_db()
{
    try {
        return new PDO(
            DSN,
            USER,
            PASSWORD,
            [PDO::ATTR_ERRMODE =>
            PDO::ERRMODE_EXCEPTION]
        );
    } catch (PDOException $e) {
        echo $e->getMessage();
        exit;
    }
}
// エスケープ処理を行う関数
function h($str)
{
    // ENT_QUOTES: シングルクオートとダブルクオートを共に変換する。
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

function signup_validate($email, $name, $password)
{
    $errors = [];

    if (empty($email)) {
        $errors[] = MSG_EMAIL_REQUIRED;
    }

    if (empty($name)) {
        $errors[] = MSG_NAME_REQUIRED;
    }

    if (empty($password)) {
        $errors[] = MSG_PASSWORD_REQUIRED;
    }

    if (empty($errors) &&
        check_exist_user($email)) {
        $errors[] = MSG_EMAIL_DUPLICATE;
    }

    return $errors;
}

function insert_user($email, $name, $password)
{
    try {
        $dbh = connect_db();

        $sql = <<<EOM
        INSERT INTO
            users
            (email, name, password)
        VALUES
            (:email, :name, :password);
        EOM;

        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $pw_hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bindValue(':password', $pw_hash, PDO::PARAM_STR);

        $stmt->execute();
        return true;
    } catch (PDOException $e) {
        echo $e->getMessage();
        return false;
    }
}

function check_exist_user($email) 
{
    $dbh = connect_db();
    
    $sql = <<<EOM
    SELECT 
        * 
    FROM 
        users 
    WHERE 
        email = :email;
    EOM;
    
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!empty($user)) {
        return true;
    } else {
        return false;
    }
}

function login_validate($email, $password)
{
    $errors = [];

    if (empty($email)) {
        $errors[] = MSG_EMAIL_REQUIRED;
    }

    if (empty($password)) {
        $errors[] = MSG_PASSWORD_REQUIRED;
    }

    return $errors;
}

function find_user_by_email($email)
{
    $dbh = connect_db();

    $sql = <<<EOM
    SELECT
        *
    FROM
        users
    WHERE
        email = :email;
    EOM;

    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function user_login($user)
{
    $_SESSION['current_user']['id'] = $user['id'];
    $_SESSION['current_user']['name'] = $user['name'];
    header('Location: /photo_app/photos/index.php');
    exit;
}

function insert_validate($description, $upload_file)
{
    $errors = [];

    if (empty($description)) {
        $errors[] = MSG_NO_DESCRIPTION;
    }

    if (empty($upload_file)) {
        $errors[] = MSG_NO_IMAGE;
    } else {
        if (check_file_ext($upload_file)) {
            $errors[] = MSG_NOT_ABLE_EXT;
        }
    }

    return $errors;
}

function check_file_ext($upload_file)
{
    $file_ext = pathinfo($upload_file, PATHINFO_EXTENSION);
    if (!in_array($file_ext, EXTENTION)) {
        return true;
    } else {
        return false;
    }
}

function insert_photo($user_id, $image_name, $description)
{
    try {
        $dbh = connect_db();

        $sql = <<<EOM
        INSERT INTO 
            photos
            (user_id ,image, description) 
        VALUES 
            (:user_id, :image, :description);
        EOM;
        $stmt = $dbh->prepare($sql);

        $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindValue(':description', $description, PDO::PARAM_STR);
        $stmt->bindValue(':image', $image_name, PDO::PARAM_STR);
        $stmt->execute();

        return true;
    } catch (PDOException $e) {
        echo $e->getMessage();
        return false;
    }

}

function find_photos_all()
{
    $dbh = connect_db();

    $sql = 'SELECT * FROM photos';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function find_photo_by_id($id)
{
    $dbh = connect_db();

    $sql = <<<EOM
    SELECT 
        * 
    FROM 
        photos 
    WHERE 
        id = :id;
    EOM;
    
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}
