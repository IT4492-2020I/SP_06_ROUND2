<?php

namespace Dung\User\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Dung\Order\Models\Order;

class User extends Model implements Authenticatable
{
    use AuthenticableTrait;
    protected $table = 'users';

    public $timestamps = false;
    protected $fillable = [
        'email',
        'name',
        'avata_url',
        'password',
        'address',
        'phone',
        'role',
        'remember_token',
        'status',
        'created_at'
    ];

    const ADMIN_ROLE = 1;
    const CUSTOMER_ROLE = 2;

    public static $role = [
        self::ADMIN_ROLE => 'Admin',
        self::CUSTOMER_ROLE => 'Customer'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * get list of user
     *
     * @param array
     * @return User
     */
    public function getList($input)
    {
        $builder = $this->orderBy('created_at', 'desc');
        if (isset($input['name'])) {
            $builder->where('name', 'LIKE', '%' . $input['name'] . '%');
        }
        if (isset($input['email'])) {
            $builder->where('email', 'LIKE', '%' . $input['email'] . '%');
        }
        if (isset($input['phone'])) {
            $builder->where('phone', '=', $input['phone']);
        }
        if (isset($input['address'])) {
            $builder->where('address', 'LIKE', '%' . $input['address'] . '%');
        }
        if (isset($input['role'])) {
            $builder->where('role', '=', $input['role']);
        }
        if (isset($input['start'])) {
            $builder->where('name', '>=', $input['start']);
        }
        if (isset($request['end']) ) {
            $builder->where('name', '>', $input['end']);
        }
        return $builder->paginate();
    }

    public function storeData($request)
    {
        $input = $request->all();

        $filePart = 'upload/admin';
        if ($request->hasFile('avata_url')) {

            $file = $request->avata_url;
            $file->move($filePart, $file->getClientOriginalName());
        }
        $input['avata_url'] = $filePart . '/' . $file->getClientOriginalName();
        $input['role'] = 1;
        $input['password'] = \Hash::make($input['password']);
        $input['created_at'] = Carbon::now();
        return $this->create($input);
    }

    /**
     * update user data
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return mixed
     */
    public function updateData($request, $id)
    {
        $input = $request->all();
        $filePart = 'upload/admin';
        if ($request->hasFile('avata_url')) {
            if(File::exists(public_path($this->find($id)->avata_url))){
                unlink(public_path($this->find($id)->avata_url));
            }
            $file = $request->avata_url;
            $file->move($filePart, $file->getClientOriginalName());
            $input['avata_url'] = $filePart . '/' . $file->getClientOriginalName();
        } else {
            unset($input['avata_url']);
        }
        $input['role'] = 1;

        // check input have password
        if (isset($input['password'])) {
            $input['password'] = \Hash::make($input['password']);
        } else {
            unset($input['password']);
        }
        return $this->find($id)->update($input);
    }
    public function update_info($request)
    {
        $id=$request->id;
        $input = $request->all();
        $filePart = 'images/users/';
        if ($request->hasFile('avata_url')) {

            if(File::exists(public_path(self::find($id)->avata_url))){
                unlink(public_path(self::find($id)->avata_url));
            }
            $file = $request->avata_url;
            $file->move($filePart, $file->getClientOriginalName());
            $input['avata_url'] = $filePart . $file->getClientOriginalName();
            $result=DB::table('users')->where("id","=",$id)->update(["name"=>"$request->name","phone"=>"$request->phone","address"=>"$request->address","avata_url"=>"$input[avata_url]"]);
        } else {
            unset($input['avata_url']);
            $input['role'] = 1;
            $result=DB::table('users')->where("id","=",$id)->update(["name"=>"$request->name","phone"=>"$request->phone","address"=>"$request->address"]);
        }
        return $result;
    }
    /**
     * relationship to feedback
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

    /**
     * relationship to order
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
