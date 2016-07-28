<?php

namespace App\Http\Controllers;

use Gate;

use App\Http\Requests;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Repositories\UserRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Webpatser\Uuid\Uuid;
use App\Models\User;
use Yajra\Datatables\Datatables;

class UserController extends InfyOmBaseController
{
    /** @var  UserRepository */
    private $userRepository;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;
    }
    
    public function get() {
        $users = User::select(['id','username','email','is_admin']);
        return Datatables::of($users)
                ->addColumn('action',function($user){
                    return view('users.action')->with('user',$user);
                })
                ->make(true);
    }

    /**
     * Display a listing of the User.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        return view('users.index');
    }
    /**
     * Show the form for creating a new User.
     *
     * @return Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created User in storage.
     *
     * @param CreateUserRequest $request
     *
     * @return Response
     */
    public function store(CreateUserRequest $request)
    {
        //$input = $request->all();
        $inputs['username'] = $request->username;
        $inputs['email'] = $request->email;
        
        
        $file = $request->file('avatar');
        $destination_path = 'uploads';
        $name_file = 'user-'.  Uuid::generate(4).'.'.$file->getClientOriginalExtension();
        $file->move($destination_path, $name_file);
        
        $inputs['avatar'] = $name_file;
        $inputs['password'] = bcrypt($request->password);
        $inputs['is_admin'] = $request->is_admin;

        $user = $this->userRepository->create($inputs);

        Flash::success('User saved successfully.');

        return redirect(route('users.index'));
    }

    /**
     * Display the specified User.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $user = $this->userRepository->findWithoutFail($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        return view('users.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified User.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $user = $this->userRepository->findWithoutFail($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        return view('users.edit')->with('user', $user);
    }

    /**
     * Update the specified User in storage.
     *
     * @param  int              $id
     * @param UpdateUserRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserRequest $request)
    {
        $user = $this->userRepository->findWithoutFail($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }
        $inputs['username'] = $request->username;
        
        $file = $request->file('avatar');
        
        if ($file) {
            //Xoa file cu. Luu file moi
            if($user->avatar=="no-image.jpg"){
                //ko unlink
            }else{
                unlink('uploads/' . $user->avatar);
            }
            $destination_path = 'uploads';
            $name_file = 'user-' . Uuid::generate(4) . '.' . $file->getClientOriginalExtension();
            $file->move($destination_path, $name_file);
            $inputs['avatar'] = $name_file;
        } else {
            //Ko xoa file cu.
            $inputs['avatar'] = $user->avatar;
        }
        
        $inputs['password'] = bcrypt($request->password);
        $inputs['is_admin'] = $request->is_admin;
        
        $user = $this->userRepository->update($inputs, $id);

        Flash::success('User updated successfully.');

        return redirect(route('users.index'));
    }

    /**
     * Remove the specified User from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $user = $this->userRepository->findWithoutFail($id);
     
        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }
        unlink('uploads/'.$user->avatar);
        $this->userRepository->delete($id);

        Flash::success('User deleted successfully.');

        return redirect(route('users.index'));
    }
}
