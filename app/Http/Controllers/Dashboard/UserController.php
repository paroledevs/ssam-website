<?php

namespace App\Http\Controllers\Dashboard;

use App\Asteroide\Facades\Monitor;
use App\Asteroide\Traits\ControllerHelpers;
use App\Asteroide\Traits\DealWithFiles;
use App\Asteroide\Traits\Notifications;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\MessageBag;

class UserController extends Controller
{
    use Notifications,
        ControllerHelpers,
        DealWithFiles;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['is:admin']);
    }

    private function getUsersByRole()
    {
        $authUser = auth('admin')->user();

        switch ($authUser->role) {
            case 'regular':
                return User::where('id', $authUser->id)->paginate($this->itemsPerPage);
                break;
            case 'admin':
                return User::withoutSuperAdmins()->paginate($this->itemsPerPage);
                break;
            case 'super_admin':
                return User::paginate($this->itemsPerPage);
                break;
        }
    }

    private function checkRole($exception = null)
    {
        $authUser = auth('admin')->user();

        abort_unless($authUser->hasAdminRoleLevel() || $authUser->id == $exception, 401);
    }

    /**
     * Show the application users view.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->getUsersByRole();

        return view('admin.users.items', compact('users'));
    }

    public function create()
    {
        $this->checkRole();

        $users = $this->getUsersByRole();

        return view('admin.users.create', compact('users'));
    }

    public function edit(User $user)
    {
        $this->checkRole($user->id);

        $users = $this->getUsersByRole();

        return view('admin.users.edit', compact('users', 'user'));
    }

    /**
     * Store a new user.
     *
     * @param  \Illuminate\Http\Requests\UserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $this->checkRole();

        $user = new User($request->only('name', 'email') + [
            'password' => bcrypt($request->password),
            'receive_notifications' => $request->boolean('receive_notifications'),
            'avatar_path' => $request->hasFile('avatar') ? $this->saveFile('avatars', $request->avatar) : null,
        ]);

        Monitor::audit(fn () => $user->save())
            ->addDescription('New admin user created');

        $this->prepareNotification(request());

        return redirect()->route('users.edit', compact('user'));
    }

    /**
     * Update an existend user
     *
     * @param  \App\Http\Requests\UpdateAdminUser  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $this->checkRole($user->id);

        $user->fill($request->only('name', 'email', 'role') + [
            'receive_notifications' => $request->boolean('receive_notifications'),
        ]);

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        if ($request->hasFile('avatar')) {
            $this->deleteFile($user->avatar_path);
            $user->avatar_path = $this->saveFile('avatars', $request->avatar);
        }

        try {
            Monitor::model($user)
                ->audit(fn () => $user->save())
                ->addDescription('Admin user updated');
        } catch (QueryException $e) {
            $errors = new MessageBag();

            if ((int) $e->errorInfo[0] === 23000) {
                $errors->add('Email', 'This email is in use');

                return back()->withErrors($errors);
            }
        }

        $this->prepareNotification(request());

        return redirect()->route('users.edit', compact('user'));
    }

    /**
     * Delete an user
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->checkRole();
        $this->deleteFile($user->avatar_path);

        Monitor::model($user)
            ->audit(fn () => $user->delete())
            ->addDescription('Admin user deleted');

        $this->prepareNotification(request());

        return redirect()->route('users.index');
    }
}
