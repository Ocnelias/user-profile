<?php

namespace User\Model;

use Application\Model\UserEntity;
use Core\Upload;

class User extends UserEntity
{


    /**
     * Get a user from database
     * @param integer $userId
     * @return object $db
     */
    public function getUser($userId)
    {
        $query = $this->db->prepare('SELECT * FROM user WHERE id = :id LIMIT 1');
        $query->execute(array(':id' => $userId));
        
        return ($query->rowcount() ? $query->fetch(\PDO::FETCH_ASSOC) : false);
    }

    /**
     * Add a user to database
     * @param array $data Data for add user
     */
    public function addUser(array $data)
    {
        extract($data);
        $sql = 'INSERT INTO user (username,password,firstname,lastname,email,description) VALUES (:username, :password, :firstname, :lastname, :email, :description)';
        $query = $this->db->prepare($sql);

        $query->execute(array(
            ':username' => $username,
            ':password' => $password,
            ':firstname' => $firstname,
            ':lastname' => $lastname,
            ':email' => $email,
            ':description' => $description
        ));

        $handle = new Upload($_FILES['image']['tmp_name']);
        if ($handle->uploaded) {
            $handle->file_new_name_body   = 'image_' . $this->db->lastInsertId();
            $handle->image_resize         = true;
            $handle->image_x              = 320;
            $handle->image_ratio_y        = true;
            $handle->allowed= [
                'image/jpeg',
                'image/jpg',
                'image/gif',
                'image/png'
            ];

            $handle->process($_SERVER['DOCUMENT_ROOT'] . '/img/');
            if ($handle->processed) {
                $handle->clean();

                $query = $this->db->prepare('UPDATE `user` SET image = :image WHERE id = :id');
                $query->execute(array(
                    ':id'     => $this->db->lastInsertId(),
                    ':image'  => $handle->file_dst_name
                ));
            }
        }
    }

    /**
     * Check user input data a user to database
     * @param array $data
     * @return array $errors_list
     */
    public function validate(array $data)
    {

        $check_user_sql= "SELECT id FROM user WHERE username = :username LIMIT 1";
        $query = $this->db->prepare($check_user_sql);
        $query->execute(array(
            ':username'    => $data['username'],
        ));


         $errors_list=[];

         if (strlen(trim($data['username']))<6)  $errors_list[]='username to short';
         if (strlen(trim($data['username']))>30) $errors_list[]='username to long';
         if ($query->rowcount()) $errors_list[]='user with this username already exists';
         if (strlen(trim($data['firstname']))<3) $errors_list[]='first name to short';
         if (strlen(trim($data['firstname']))>30) $errors_list[]='first name to long';
         if (strlen(trim($data['lastname']))<3) $errors_list[]='last name to short';
         if (strlen(trim($data['lastname']))>30) $errors_list[]='last name to long';
         if (strlen(trim($data['description']))>1000) $errors_list[]='description to long';
         if (strlen(trim($data['password']))<6) $errors_list[]='password to short';
         if (strlen(trim($data['password']))>30) $errors_list[]='password to long';
         if (!preg_match("#[0-9]+#", $data['password'])) $errors_list[]='password must include at least one number';
         if (!preg_match("#[a-zA-Z]+#", $data['password'])) $errors_list[]='password must include at least one letter';
         if (filter_var($data['email'], FILTER_VALIDATE_EMAIL)!=true) $errors_list[]='email is not valid';

         
         return $errors_list;


    }



    /**
     * Update a user in database
     */
    public function updateUser(array $data)
    {
       //to do if neccessary
    }
}