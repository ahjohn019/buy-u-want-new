<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserDetails;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    protected $user;
    protected $userDetails;

    public function __construct(User $user, UserDetails $userDetails){
        $this->user = $user;
        $this->userDetails = $userDetails;
    }

    public function index(){
        $getUser = $this->user::all();
        return $getUser;
    }


    public function show($id){
        $findUser = $this->user::find($id);
        $findUserDetails = $findUser->userDetails;

        return response()->json(['User' => $findUser,'User Details' => $findUserDetails]);
    }
    
    public function update(User $id, Request $request){
        $validatedData = $request->validate([
            'name' => 'required|string|max:255'
        ]);

        try{
            $id->update($validatedData);
            return response()->json(['data' => 'Updated Successfully','status' => 1]);
        } catch (\Throwable $e){
            return back()->with('error',$e->getMessage());
        }
    }

    public function storeDetails(Request $request){
        $request->validate([
            'gender' => 'required|string',
            'birth_date' => 'required|date_format:d-m-Y',
            'role' => 'required|string',
        ]);

        try{
            $getUserDetails =  $this->userDetails->where('user_id', auth()->user()->id)->first();

            if(!is_null($getUserDetails)){
                return response()->json(['data' => 'User Details Already Exist','status' => 0]);
            }

            DB::beginTransaction();
            $userDetails = $this->userDetails->create([
                'gender' => $request->gender,
                'birth_date' => $request->birth_date,
                'role' => $request->role,
                'user_id' => auth()->user()->id
            ]);
            DB::commit();

            return response()->json(['data' => 'Created Successfully','status' => 1]);
        } catch(\Throwable $e){
            DB::rollback();
            return back()->with('error',$e->getMessage());
        }
        
    }
}
