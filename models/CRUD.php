<?php

class CRUD
{
    public function create($user)
    {
        $jsonArray = $this->read();
        $jsonArray[] = $user;
        $create = file_put_contents('../db/users.json', json_encode($jsonArray, JSON_FORCE_OBJECT));
        return $create ? true : false;
    }

    public function read()
    {
        if (file_exists('../db/users.json')){
            $jsonData = file_get_contents('../db/users.json');
            $jsonArray = json_decode($jsonData, true);
        }
        return $jsonArray;
    }

    public function update($upData, $login)
    {
        if(!empty($upData) && is_array($upData) && !empty($login)){
            $json = file_get_contents('../db/users.json');
            $jsonArray = json_decode($json, true);

            foreach ($jsonArray as $key => $value) {
                if ($value['login'] == $login) {
                    if(isset($upData['name'])){
                        $data[$key]['name'] = $upData['name'];
                    }
                    if(isset($upData['email'])){
                        $data[$key]['email'] = $upData['email'];
                    }
                    if(isset($upData['password'])){
                        $data[$key]['password'] = $upData['password'];
                    }
                }
            }
            $update = file_put_contents('../db/users.json', json_encode($data));
            return $update ? true : false;
        } else {
            return false;
        }
    }

    public function delete($login)
    {
        $jsonData = file_get_contents('../db/users.json');
        $jsonArray = json_decode($jsonData, true);

        $newData = array_filter($jsonArray, function ($var) use ($login) {
            return ($var['login'] != $login);
        });
        $delete = file_put_contents('../db/users.json', json_encode($newData));
        return $delete ? true : false;
    }
}