<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TopicController extends Controller
{
    public function index(Request $req){
        return Topic::all();
    }

    public function get($id){
        $result = Topic::find($id);
        //$result = DB::table('topics')->where('user', '=', $user)->get();
        if($result)
            return $result;
        else
            return response()->json(['status'=>'failed'], 404);
    }

    public function create(Request $req){
        $this->validate($req, [
            'id'=>'required', 
            'tema'=>'required']);

        $datos = new Topic;
        // $datos->user = $req->user;
       // $datos->pass = Hash::make( $req->pass );
        // $datos->nombre = $req->nombre;
        // $datos->rol = $req->rol;
        // $datos->save();
        $result = $datos->fill($req->all())->save();
        if($result)
            return response()->json(['status'=>'success'], 200);
        else
            return response()->json(['status'=>'failed'], 404);
    }

    public function update(Request $req, $id){
        $this->validate($req, [
            'id'=>'filled', 
            'tema'=>'filled']);

        $datos = Topic::find($id);
        //$datos->pass = $req->pass;
        $result = $datos->fill($req->all())->save();
        if($result)
            return response()->json(['status'=>'success'], 200);
        else
            return response()->json(['status'=>'failed'], 404);
    }

    public function destroy($id){
        
        $datos = Topic::find($id);
        if(!$datos) return response()->json(['status'=>'failed'], 404);
        $result = $datos->delete();
        if($result)
            return response()->json(['status'=>'success'], 200);
        else
            return response()->json(['status'=>'failed'], 404);
    }

}