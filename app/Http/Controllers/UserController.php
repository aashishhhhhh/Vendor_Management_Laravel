<?php

namespace App\Http\Controllers;

use App\Models\RoleUser;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;

class UserController extends Controller
{
    public function loginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $data= $request->validate(
            [
                'email'=>'required',
                'password'=>'required'
            ]   
            );

        if(Auth::attempt($data))
        {
            $data= User::where('email',$data['email'])->first();
            session()->put('name',$data->name);
            session()->put('user_id',$data->id);
            $roleData= User::find($data->id)->roles->first();
            $role=$roleData->role_name;
            session()->put('user_role',$role);
             $this->showList();
             return redirect('showList');
        }
        else{
            echo "Credentials didn't matched";
        }
          

    }

    public function showAddUser()
    {
        $id= session()->get('user_id');
       
         return view('user-add');

    }

    public function addUser(Request $request)
    {
        $data = $request->validate(
            [
                'name'=>'required',
                'email'=>'required|unique:users|max:255',
                'password'=>'required',
            ]
            );

        $latest=User::create(
            [
                'name'=>$data['name'],
                'email'=>$data['email'],
                'password'=>Hash::make( $data['password'])
            ]
            );
        $rid=2;
        $user=User::find($latest->id);
        $user->roles()->attach($rid);
        return redirect('showList');

    }

    public function logout()
    {
        session()->flush();
        return redirect('/');
    }

    public function showList()
    {
       $role= session()->get('user_role');
       if($role=='admin')
       {
           $data= User::whereHas('roles', function($query){
               $query->where('role_users.role_id','2');
           })->get();
        //    dd('ok');
           return view('user-list',['datas'=>$data]);
       }
       else{
           $id=session()->get('user_id');
           $transactions=Transaction::query()->with('products','users')->whereHas('users',function(Builder $query) use($id){
            $query->where('users.id',$id);
            })
            ->get();
           return view('vendor-product-list',['transactions'=>$transactions]);
       }
    }

    public function showedit($id)
    {
         $data = User::where('id',$id)->first();
         return view('user-edit',['datas'=>$data]);
    }

    public function editUser(Request $request)
    {
        $data= $request->validate([
            'name'=>'required',
            'email'=>'required',
            'password'=>'required'
        ]);
        $id=$request->id;

        User::where('id',$id)->update([
            'name'=>$data['name'],
            'email'=>  $data['email'],
            'password'=> Hash::make( $data['password'])
        ]);

        return redirect('showList');
    }

    public function deleteUser($id)
    {
        RoleUser::where('user_id',$id)->delete();
        User::where('id',$id)->delete();
        return redirect('showList');
    }

  
    

}
