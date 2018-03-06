<?php namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\User;
use Redirect;

class userController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::All();
        return view('admin.user.index', ['users' => $users]);
    }

    public function extraInfo() 
    { 
        return view('admin.user.extraInfo'); 
    } 
 
    public function storeExtraInfo(Request $request) 
    { 
        $id = $request->input('userid');


            $rules = [
            'streetAdress' => 'required|string|max:255|',
            'houseNumber' => 'required|integer|min:1|',
            'city' => 'required|string|max:255|',
            'postal_code' => 'required|string|max:255|',
            'user_phone_number' => 'required|numeric|digits:10|',
            'user_parent_name' => 'required|string|max:255|',
            'user_parent_email' => 'required|email|max:255|',
            'user_parent_phone' => 'required|numeric|digits:10|',
        ];

        $messages = [
            'name.required'   =>  'Your first name is required.'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails())
        {
            return Redirect::to('home/info')
                ->withErrors($validator)
                ->withInput();
        }else{

        $userFound = User::find($id); 
            $userFound->streetAdress = $request->input('streetAdress'); 
            $userFound->houseNumber = $request->input('houseNumber'); 
            $userFound->city = $request->input('city'); 
            $userFound->postal_code = $request->input('postal_code'); 
            $userFound->user_phone_number = $request->input('user_phone_number'); 
            $userFound->user_parent_name = $request->input('user_parent_name'); 
            $userFound->user_parent_email = $request->input('user_parent_email'); 
            $userFound->user_parent_phone = $request->input('user_parent_phone'); 
        $userFound->save(); 
 
        //Message about the store 
        $request->session()->flash('alert-success', 'Extra info is succesvol toegevoegd!'); 
        //redirecting 
        return Redirect::to('/'); 

        }   
    } 
    

    /**
     * Edit the user
     *
     * @param  int $id
     * @return response
     */
    public function edit($id)
    {
        $profile = User::find($id);

        return view('admin.user.edit', compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $data)
    {
        //Get the user id
        $id = Auth::user()->id;

        //
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|',
            'lastName' => 'required|string|max:55|',
            'streetAdress' => 'required|string|max:255|',
            'houseNumber' => 'required|integer|min:1|',
            'city' => 'required|string|max:255|',
            'postal_code' => 'required|string|max:255|',
            'user_phone_number' => 'required|numeric|digits:10|',
            'birth_day' => 'required|date|min:1|',
            'user_parent_name' => 'required|string|max:255|',
            'user_parent_email' => 'required|email|max:255|',
            'user_parent_phone' => 'required|numeric|digits:10|',
        ];

        $messages = [
            'name.required'   =>  'Your first name is required.'
        ];

        $validator = Validator::make($data->all(), $rules, $messages);

        if($validator->fails())
        {
            return Redirect::to('profile')
                ->withErrors($validator)
                ->withInput();
        }else{
            $birthday = explode('-', $data['birth_day']);
            $user = User::find($id);
            $user->name = $data->input('name');
            $user->email = $data->input('email');
            $user->lastName = $data->input('lastName');
            $user->streetAdress = $data->input('streetAdress');
            $user->houseNumber = $data->input('houseNumber');
            $user->city = $data->input('city');
            $user->postal_code = $data->input('postal_code');
            $user->user_phone_number = $data->input('user_phone_number');
            $user->birth_day_day = $birthday[2];
            $user->birth_day_month = $birthday[1];
            $user->birth_day_year = $birthday[0];
            $user->user_parent_name = $data->input('user_parent_name');
            $user->user_parent_email = $data->input('user_parent_email');
            $user->user_parent_phone = $data->input('user_parent_phone');
            
            $user->save();

            return Redirect::to('/profile');
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

    public function rankup(Request $request)
    {
        $id = $request->userid;
        $foundUser = User::find($id);
        if ($foundUser->accountRole == 1) {
            $foundUser->accountRole = $foundUser->accountRole + 1;
                $foundUser->save();
            return Redirect::to('admin/user');
        }elseif ($foundUser->accountRole <= 2) {
            return Redirect::to('/');
        }
    }
}
