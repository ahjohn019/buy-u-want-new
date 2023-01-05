<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Address;
use App\Models\Biography;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UserCompleteFormRequest;

class UserController extends Controller
{
    private $user;

    public function __construct(User $user, Biography $biography, Address $address){
        $this->user = $user;
        $this->biography = $biography;
        $this->address = $address;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $getUser = $this->user::displayAdminInfo()->get();
        return Inertia::render("Admin/User/Index",["users" => $getUser]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return Inertia::render("Admin/User/Create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserCompleteFormRequest $request)
    {
        //
        try {
            $userInput = $request->validated();
            $userInput['password'] = bcrypt($userInput['password']);
            $createdUser = $this->user->create($userInput);
            $bioUser = $this->biography->create(['user_id' => $createdUser->id] + $userInput);
            $this->address->create(['user_id' => $createdUser->id] + $userInput);
            $createdUser->assignRole($bioUser->role);

            return redirect()->route("users.index")->with('createUserMessage', sessionMessage()['createUserMessage']);
        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $findUser = $this->user::select('id','email','name','created_at')->with('address','biography')->find($id);
        return response()->json(['user' => $findUser]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $findUser = $this->user->with(['biography', 'address'])->find($id);
        return Inertia::render("Admin/User/Edit",['user'=>$findUser]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|email',
                'biography.home_number' => 'required',
                'biography.gender' => 'required|string',
                'biography.birth_date' => 'required|date_format:Y-m-d',
                'biography.role' => 'required|string',
                'biography.mobile_number' => 'required',
            ]);

            if($validator->fails()){
                return redirect()->route('users.edit', $id)->withErrors($validator);
            }

            $bioUser = $this->biography::find($id);
            $findUser = $this->user::find($id);

            $bioUser->update($validator->validated()['biography']);
            $findUser->update($validator->validated());

            return redirect()->back();
            
        } catch (\Throwable $e) {
            dd($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
