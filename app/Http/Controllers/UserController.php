<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Traits\ApiResponser;
use DB;

Class UserController extends Controller {
private $request;
public function __construct(Request $request){
$this->request = $request;
}
    public function UserGetAll(){
        $users = User::all();
        return response()->json(['data' => $users], 200);
    
    }
    public function userShowID($id)
    {
        //
        $users = User::findOrFail($id);
        return response()->json(['data' => $users], 200);
        
    }
    public function userAdd(Request $request ){
        $rules = [
        'studentFname' => 'required|max:50',
        'studentLname' => 'required|max:50',
        'studentMname' => 'required|max:50',
        'birthdate' => 'required|date_format:Y/m/d|max:50',
        ];
        $this->validate($request,$rules);
        $users = User::create($request->all());
        return response()->json(['data' => $users], 200);
       
}
    public function userUpdate(Request $request,$id)
    {
    $rules = [
    'studentFname' => 'required|max:50',
    'studentLname' => 'required|max:50',
    'studentMname' => 'required|max:50',
    'birthdate' => 'required|date_format:Y/m/d|max:50',
    ];
    $this->validate($request, $rules);
    $user = User::findOrFail($id);
    $user->fill($request->all());

    // if no changes happen
    if ($user->isClean()) {
    return $this->errorResponse('At least one value must
    change', Response::HTTP_UNPROCESSABLE_ENTITY);
    }
    $user->save();
    return $user;
}
public function userDelete($id)
{
 $user = User::where('studentID', $id)->first();
 $user->delete();




// old code
/*
$user = User::where('userid', $id)->first();
if($user){
$user->delete();
return $this->successResponse($user);   
}
{
return $this->errorResponse('User ID Does Not Exists',
Response::HTTP_NOT_FOUND);
}
*/
}
}

//website
//https://dev.to/tanzimibthesam/making-api-crud-create-read-update-delete-with-laravel-8-n-api-authentication-with-sanctum-19oh