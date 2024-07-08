<?php

namespace App\Controllers;
use CodeIgniter\API\ResponseTrait;

class LoginController extends BaseController
{
    use ResponseTrait;
    
    public function __construct() 
    {
        // header('Access-Control-Allow-Origin: *');
        // header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        // header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        // $method = $_SERVER['REQUEST_METHOD'];
        // if($method == "OPTIONS") {
        // die();
        // }
    }


    public function login()
    {
        $email = $password = '';
        $data = array();

        $request = \Config\Services::request();
        $db = \Config\Database::connect();

        // $email = service('request')->getPost('email');
        $email = $request->getPost('email');
        $password = $request->getPost('password');
        $password = md5($password);
        
        if(isset($email) && isset($password))
        {
            $builder = $db->table('users');
            $builder->where('email', $email);
            $builder->where('password', $password);
            $result_data = $builder->get()->getResultArray();
            if(count($result_data) > 0)
            {
                $data['status_code'] = "0";
                $data['msg'] = "Success";
            } else {
                {
                    $data['status_code'] = "1";
                    $data['msg'] = "User does not exist.";
                }
            }
        } else {
            $data['status_code'] = "2";
            $data['msg'] = "User Name or Email is missing.";
        }

        // echo json_encode($data);

        return $this->respond($data, 200);
    }

    public function fetchAllProducts()
    {

        $request = \Config\Services::request();
        $db = \Config\Database::connect();  

        $builder = $db->table('products');
        $builder->select('id, name, code, price, stock_status');
        // $builder->from('products');
        $result_data = $builder->get()->getResultArray();

        if(count($result_data) > 0)
        {
            $data['data'] = $result_data;
        } else {
            $data['status_code'] = "1";
            $data['msg'] = "User does not exist.";
        }
        

        // echo json_encode($data);

        return $this->respond($result_data, 200);
    }

    public function fetchProduct()
    {
        $request = \Config\Services::request();
        $db = \Config\Database::connect();   
        
        $id = $request->getPost('id');
       
        $builder = $db->table('products');
        $builder->select('id, name, code, price, stock_status');
        $builder->where('id', $id);
        $result_data = $builder->get()->getResultArray();

        // print_r($result_data[0]);
        // exit;

        if(count($result_data) > 0)
        {
            $data['data'] = $result_data[0];
        } else {
            $data['status_code'] = "1";
            $data['msg'] = "User does not exist.";
        }
        

        // echo json_encode($data);

        return $this->respond($result_data, 200);
    }
}
