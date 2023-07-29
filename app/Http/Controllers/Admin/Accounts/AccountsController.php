<?php

namespace App\Http\Controllers\Admin\Accounts;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Accounts\StoreRequest;
use App\Http\Requests\Admin\Accounts\UpdateRequest;
use App\Models\Premium;
use App\Models\User;
use App\Models\UserInfo;
use DateTime;
use Yajra\DataTables\Facades\DataTables;
use Yoeunes\Toastr\Facades\Toastr;

class AccountsController extends Controller
{
    public function getData()
    {
        $accountLogin = auth()->user();
        $users = User::join('users_info', 'users.id', '=', 'users_info.user_id')
            ->select(
                'users.id',
                'users.email',
                'users.role',
                'users.is_premium',
                'users.is_active',
                'users_info.name',
                'users_info.address',
                'users_info.phone',
                'users_info.gender',
                'users_info.avatar',
            );
        return DataTables::of($users)
            ->addIndexColumn()
            ->addColumn('email', function ($user) {
                return '<a class="" href="' . route('admin.accounts.profile', $user->id) . '">' . $user->email . '</a>';
            })
            ->addColumn('edit', function ($user) use ($accountLogin) {
                $boss = $accountLogin->id == '1';
                $member = $user->role == 'Member';
                $isLogin = $accountLogin->id == $user->id;
                if ($boss) {
                    return '<a class="btn edit-btn button" href="' . route('admin.accounts.edit', $user->id) . '">
                        <span class="button_lg">
                            <span class="edit-btn button_sl"></span>
                            <span class="button_text"> Edit</span>
                        </span>
                    </a>';
                } elseif ($member || $isLogin) {
                    return '<a class="btn edit-btn button" href="' . route('admin.accounts.edit', $user->id) . '">
                        <span class="button_lg">
                            <span class="edit-btn button_sl"></span>
                            <span class="button_text"> Edit</span>
                        </span>
                    </a>';
                }

                return '';
            })
            ->addColumn('role', function ($user) use ($accountLogin) {
                $id = $user->id;
                $labelRole = $user->role;
                $btnClass = $user->role === 'Admin' ? 'btn-success' : 'btn-secondary';
                $disabled = $id == 1 ? 'disabled' : '';
                $boss = $accountLogin->id == '1';
                if ($boss) {
                    return '<button ' . $disabled . ' class="btn btn-role ' . $btnClass . '" data-id="' . $id . '" data-role="' . $user->role . '">' . $labelRole . '</button>';
                }

                return '<button disabled class="btn btn-role ' . $btnClass . '" data-id="' . $id . '" data-role="' . $user->role . '">' . $labelRole . '</button>';
            })

            ->addColumn('is_active', function ($user) use ($accountLogin) {
                $id = $user->id;
                $boss = $accountLogin->id == '1';
                $checked = $user->is_active ? 'checked' : '';
                $member = $user->role == 'Member';
                $isLogin = $accountLogin->id == $user->id;
                $disabled = $id == 1 ? 'disabled' : '';
                if ($boss) {
                    return '<label class="my-toggle" for="toggle[' . $id .
                        ']"><input ' . $disabled . ' ' . $checked .
                        '  class="input-toggle" id = "toggle[' . $id .
                        ']" type = "checkbox" ><span class="slider" ></span></label>';
                } elseif ($member && !$isLogin) {
                    return '<label class="my-toggle" for="toggle[' . $id .
                        ']"><input ' . $checked .
                        '  class="input-toggle" id = "toggle[' . $id .
                        ']" type = "checkbox" ><span class="slider" ></span></label>';
                }
                return '';
            })
            ->rawColumns(['email', 'edit', 'role', 'is_active'])
            ->make(true);
    }


    public function getAll()
    {
        return view('modules.admin.accounts.index');
    }

    public function profile($id)
    {
        $acc = User::join('users_info', 'users.id', '=', 'users_info.user_id')
            ->select(
                'users.is_active',
                'users.is_premium',
                'users.role',
                'users.id',
                'users.email',
                'users_info.name',
                'users_info.address',
                'users_info.phone',
                'users_info.gender',
                'users_info.avatar'
            )
            ->where('users_info.user_id', $id)
            ->first();
        return view('modules.admin.accounts.profile', ['acc' => $acc]);
    }

    public function dataTransactions($id)
    {
        $transactions = Premium::where('user_id', $id)->get();
        return DataTables::of($transactions)->make(true);
    }

    public function add()
    {
        return view('modules.admin.accounts.add');
    }

    public function store(StoreRequest $request)
    {
        $account = $request->except(
            '_token',
            'password_confirmation',
        );
        $account['password'] = bcrypt($request->password);
        $account['created_at'] = new DateTime();


        $info = $request->except('_token', 'password_confirmation', 'email', 'password', 'role');
        $user = User::create($account);
        $info['user_id'] = $user->id;
        $info['created_at'] = new DateTime();
        UserInfo::create($info);

        Toastr::success('The account has been created successfully.', 'Success!');
        return redirect()->route('send-massage', ['data' => $user, 'type' => 'create-account']);
    }


    public function edit($id)
    {

        $acc = User::join('users_info', 'users.id', '=', 'users_info.user_id')
            ->select(
                'users.is_active',
                'users.is_premium',
                'users.role',
                'users.id',
                'users.email',
                'users_info.name',
                'users_info.address',
                'users_info.phone',
                'users_info.gender',
                'users_info.avatar'
            )
            ->where('users.id', $id)
            ->first();
        return view('modules.admin.accounts.edit', ['acc' => $acc]);
    }


    public function update($id, UpdateRequest $request)
    {
        $mainData = $request->except(
            '_token',
            'password_confirmation',
            'password',
            'name',
            'gender',
            'phone',
            'address',
            'avatar'
        );
        if (empty($request->email)) {
            $mainData['email'] = User::where('id', $id)->first()->email;
        } else {
            $request->validate([
                'email' => 'required|email|min:14|max:30'
            ], [
                'email.min' => 'Must be at least 14 characters before @gmail.com',
                'email.max' => 'Email cannot exceed 30 characters before @gmail.com',
            ]);
        }

        if (!empty($request->password)) {
            $request->validate([
                'password' => 'min:8|confirmed',
            ]);
            $mainData['password'] = bcrypt($request->password);
        };

        $mainData['created_at'] = new DateTime();
        User::where('id', $id)->update($mainData);

        $info = $request->except('_token', 'password_confirmation', 'email', 'password', 'role');
        if (!empty($request->avatar)) {
            $request->validate([
                'avatar' => 'mimes:jpeg,png,gif|max:500000',
            ]);
            $file = $request->avatar;
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('img/account'), $filename);
            $info['avatar'] = $filename;
        };
        if (empty($request->name)) {
            $info['name'] = UserInfo::where('user_id', $id)->first()->name;
        } else {
            $request->validate([
                'name' => 'min:2|max:20',
            ]);
        };
        if (!empty($request->phone)) {
            $request->validate([
                'phone' => 'min:10',
            ]);
        } else {
            $info['phone'] = UserInfo::where('user_id', $id)->first()->phone;
        }
        if (empty($request->address)) {
            $info['address'] = UserInfo::where('user_id', $id)->first()->address;
        }
        $info['user_id'] = $id;
        $info['created_at'] = new DateTime();

        UserInfo::where('user_id', $id)->update($info);
        Toastr::success('The account has been updated successfully.', 'Success!');
        return redirect()->route('admin.accounts.all');
    }

    public function changeStatus($id)
    {
        $user = User::findOrFail($id);
        $user->is_active = !$user->is_active;
        $user->save();
        return response()->json(['message' => 'success']);
    }

    public function changeRole($id)
    {
        $user = User::findOrFail($id);
        if ($user->role === 'Member') {
            $user->role = 'Admin';
        } else {
            $user->role = 'Member';
        }
        $user->save();
        return response()->json(['message' => 'success']);
    }
}
