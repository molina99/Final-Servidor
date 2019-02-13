<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function create(Request $request)
    {
        try{
        $data = $request->json()->all();
        $sql = "insert into users(first_name, last_name, ci, email, address, phone, code_book)
                  values(?,?,?,?,?,?,?)";
        $parameters = 
        [$data['first_name'],
         $data['last_name'],
         $data['ci'],
         $data['email'],
         $data['address'],
         $data['phone'],
         $data['code_book']];
        $response = DB::select($sql, $parameters);
        if ($response){
            return response()->json($parameters,201);
        }else {
            return response()->json(false);
        }

       

        }catch(QueryException $e){
            return response()->json($e,500);
        }catch(\PDOException $e){
            return response()->json($e,500);
        }
    
    }

    public function update(Request $request)
    {

        $data = $request->json()->all();
        $sql = "update users set 
        first_name = ?,
        last_name=?,
        ci=?,
        email=?,
        address=?,
        phone=?,
        code_book=?,
        state=? 
        where 
        id =?";
                
        $parameters = 
        [$data['first_name'],
         $data['last_name'],
         $data['ci'], 
         $data['email'],
         $data['address'],
         $data['phone'],
         $data['code_book'],
         $data['state'],
         $data['id']];
        $response = DB::select($sql, $parameters);
        return $response;
    }

    public function delete(Request $request)
    {
        $data = $request->json()->all();
        $sql = "delete from users where id = ?";
                
        $parameters = [$request->id];
        $response = DB::select($sql, $parameters);
        return $response;
    }

    public function getAll(Request $request)
    {
        $data = $request->json()->all();
        $sql = "select * from users";
        $response = DB::select($sql);
        return $response;

    }
}
