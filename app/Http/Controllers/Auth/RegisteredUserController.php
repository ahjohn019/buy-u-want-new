<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Inertia\Inertia;
use App\Models\UserDetails;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;

class RegisteredUserController extends Controller
{
    public function index(){
        $getUser = User::all();
        return $getUser;
    }


    public function show($id){
        $findUser = User::find($id);
        $findUserDetails = $findUser->userDetails;

        return response()->json(['User' => $findUser,'User Details' => $findUserDetails]);
    }

    /**
     * Display the registration view.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
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
            $getUserDetails = UserDetails::where('user_id', auth()->user()->id)->first();

            if(!is_null($getUserDetails)){
                return response()->json(['data' => 'User Details Already Exist','status' => 0]);
            }

            DB::beginTransaction();
            $userDetails = UserDetails::create([
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
