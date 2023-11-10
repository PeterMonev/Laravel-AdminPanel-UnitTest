<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a paginated list of users.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $users = User::orderBy('id', 'desc')->paginate(10);
        return view('users.dashboard', [
            'users' => $users
        ]);
    }

    /**
     * Display the form for creating a new user.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created user in the database.
     *
     * @param  Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone_number' => 'required|string|max:15',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = strtolower($request->email);
        $user->phone_number = $request->phone_number;
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->route('admin.index')->with('success', 'User was created successfully');
    }

    /**
     * Display the form for editing an existing user.
     *
     * @param  int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $user = User::find($id);

        return view('users.edit', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified user in the database.
     *
     * @param  Request $request
     * @param  int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone_number' => 'sometimes|required|string|max:15',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $user = User::find($id);

        $user->name = $request->name;

        if ($request->password) {
            $user->password = bcrypt($request->password);
        }

        if ($request->has('phone_number')) {
            $user->phone_number = $request->phone_number;
        }

        if (strtolower($request->email) !== strtolower($user->email)) {
            $user->email = strtolower($request->email);
        }

        $user->save();

        return redirect()->route('admin.index')->with('success', 'User was updated successfully');
    }

    /**
     * Remove the specified user from the database.
     *
     * @param  int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if ($user) {
            $user->delete();
            return redirect()->route('admin.index')->with('success', 'User was deleted successfully');
        }

        return redirect()->route('admin.index')->with('error', 'User not found or already deleted');
    }
}
