<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    public function create(Request $request)
    {
        $data = $request->json()->all();
        $sql = "insert into books(code, title, author, editorial, category, quantity)
                  values(?,?,?,?,?,?)";
        $parameters = 
        [$data['code'],
         $data['title'], 
         $data['author'], 
         $data['editorial'],
         $data['category'], 
         $data['quantity']];
        $response = DB::select($sql, $parameters);
        return $response;
    }

    public function update(Request $request)
    {

        $data = $request->json()->all();
        $sql = "update books set 
        code = ?,
        title=?,
        author=?,
        editorial=?,
        category=?,
        quantity=?,
        state=? 
        where 
        id =?";
                
        $parameters = 
        [$data['code'],
         $data['title'], 
         $data['author'], 
         $data['editorial'],
         $data['category'],
         $data['quantity'], 
         $data['state'],
         $data['id']];
        $response = DB::select($sql, $parameters);
        return $response;
    }

    public function delete(Request $request)
    {
        $data = $request->json()->all();
        $sql = "delete from books where id = ?";
                
        $parameters = [$request->id];
        $response = DB::select($sql, $parameters);
        return $response;
    }

    public function getAll(Request $request)
    {
        $data = $request->json()->all();
        $sql = "select * from books";
        $response = DB::select($sql);
        return $response;

    }
}