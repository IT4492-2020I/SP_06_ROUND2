<?php

namespace Dung\User\Http\Controller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Dung\User\Models\User;
use Dung\User\Http\Requests\UsersStoreRequest;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    protected $user;
    /**
     * CustomerController constructor.
     *
     * @param \App\Models\Product $product
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }
    public function get_user($id){
        $user=User::find($id);
        //$status = Order::$status;
        // $orders=$this->cart->get_cart_userid($id);
        return view("user::User.user",compact("user"));
    }

    public function index(Request $request)
    {
        if (Gate::allows('admin')) {
            $users = $this->user->getList($request->all());
            $role = User::$role;
            return view('user::Admin.users.index', compact(['users', 'role']));
        } else {
            return redirect(route('home'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::allows('admin')) {
            $role = User::$role;
            return view('user::Admin.users.create', compact('role'));
        } else {
            return redirect(route('home'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersStoreRequest $request)
    {
        if (Gate::allows('admin')) {
            $this->user->storeData($request);
            return redirect($request->url_back ?? route('user::Admin.users.index'));
        } else {
            return redirect(route('home'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Gate::allows('admin')) {
            $user = $this->user->find($id);
            $role = User::$role;
            return view('user::Admin.users.show', compact(['user', 'role']));
        } else {
            return redirect(route('home'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Gate::allows('admin')) {
            $user = $this->user->find($id);
            return view('user::Admin.users.edit', compact('user'));
        } else {
            return redirect(route('home'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UsersStoreRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsersStoreRequest $request, $id)
    {
        if (Gate::allows('admin')) {
            $this->user->updateData($request, $id);
            return redirect($request->url_back ?? route('users.index'));
        } else {
            return redirect(route('home'));
        }
    }

    public function change_info(Request $request)
    {
        $this->user->update_info($request);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Gate::allows('admin')) {
            $user = $this->user->find($id);
            if ($user->role == User::ADMIN_ROLE) {
                if(File::exists(public_path($user->avata_url))){
                    unlink(public_path($user->avata_url));
                }
                $user->delete();
            } elseif ($user->status == 1) {
                $user->update(['status' => 0]);
            } else {
                $user->update(['status' => 1]);
            }
            return back();
        } else {
            return redirect(route('home'));
        }
    }
}
