<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Guru;
use App\Models\Staff;
use Illuminate\Support\Facades\Hash;;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve common columns from all three tables and combine them using union
        $adminAccounts = Admin::all();
        $guruAccounts = Guru::all();
        $staffAccounts = Staff::all();
    
        $admin = $adminAccounts;
        $guru = $guruAccounts;
        $staff = $staffAccounts;
    
        // Pass the accounts to the view
        return view('admin.accounts.index', compact('admin', 'guru', 'staff'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.accounts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins|unique:gurus|unique:staffs',
            'password' => 'required|string|min:8',
            'account_type' => 'required|in:admin,guru,staff', // Add a hidden field in your form for account type
        ]);
    
        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        // Based on the account_type, store data in the respective table
        $accountType = $request->input('account_type');
    
        switch ($accountType) {
            case 'admin':
                Admin::create([
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'password' => Hash::make($request->input('password')),
                ]);
                break;
    
            case 'guru':
                Guru::create([
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'password' => Hash::make($request->input('password')),
                ]);
                break;
    
            case 'staff':
                Staff::create([
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'password' => Hash::make($request->input('password')),
                ]);
                break;
    
            default:
                // Handle invalid account type if needed
                break;
        }
    
        // Redirect to the index page or any other page as needed
        return redirect()->route('accounts.index')->with('success', 'Account created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id, Request $request)
    {
        $type = $request->get('type');
        
        switch ($type) {
            case 'admin':
                $account = Admin::find($id);
                break;
            case 'guru':
                $account = Guru::find($id);
                break;
            case 'staff':
                $account = Staff::find($id);
                break;
            default:
                abort(404, "Invalid account type: $type");
        }
    
        if (!$account) {
            abort(404, "Account with ID $id and type $type not found.");
        }
    
        return view('admin.accounts.edit', compact('account', 'type'));
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validation logic
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            // Add more validation rules as needed
        ]);
    
        // Check the type of account
        $type = $request->get('type');
        
        switch ($type) {
            case 'admin':
                $account = Admin::find($id);
                break;
            case 'guru':
                $account = Guru::find($id);
                break;
            case 'staff':
                $account = Staff::find($id);
                break;
            default:
                abort(404, "Invalid account type: $type");
        }
    
        if (!$account) {
            abort(404, "Account with ID $id and type $type not found.");
        }
    
        // Update the account
        $account->update($request->only(['name', 'email']));
    
        // Redirect to the index or show page after successful update
        return redirect()->route('accounts.index')->with('success', 'Account updated successfully.');
    }
    

    public function destroy($id, Request $request)
    {
        $type = $request->get('type');
        
        switch ($type) {
            case 'admin':
                $account = Admin::find($id);
                break;
            case 'guru':
                $account = Guru::find($id);
                break;
            case 'staff':
                $account = Staff::find($id);
                break;
            default:
                abort(404, "Invalid account type: $type");
        }
    
        if (!$account) {
            abort(404, "Account with ID $id and type $type not found.");
        }
    
        // Delete the account
        $account->delete();
    
        // Redirect to the index or show page after successful delete
        return redirect()->route('accounts.index')->with('success', 'Account deleted successfully.');
    }
    
    
}
