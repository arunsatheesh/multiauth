<?php
  
namespace App\Http\Controllers\Auth;
  
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use Hash;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
  
class AuthController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index(): View
    {
        return view('login');
    }  
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function registration(): View
    {
        return view('registration');
    }
    public function AdminRegistration(): View
    {
        return view('admin_registration');
    }
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postLogin(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');
        //dd($credentials);
        if (Auth::attempt($credentials)) {
            if(Auth::user()->role == 'Admin')
            return redirect()->intended('dashboard')
                        ->withSuccess('You have Successfully loggedin');
                        else
                            return redirect()->intended('userdashboard')
                        ->withSuccess('You are user Successfully loggedin');
        }
  
        return redirect("login")->withError('Oppes! You have entered invalid credentials');
    }
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postRegistration(Request $request): RedirectResponse
    {  
       // dd($request);
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required',
        ]);
           
        $data = $request->all();
        //dd($data);
        $user = $this->create($data);
            
        Auth::login($user); 

        return redirect("dashboard")->withSuccess('Great! You have Successfully loggedin');
    }
     public function postAdminRegistration(Request $request): RedirectResponse
    {  
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required',
        ]);
           
        $data = $request->all();
        $user = $this->create($data);
            
        Auth::login($user);
       // dd($user); 

        return redirect("dashboard")->withSuccess('Great! You have Successfully loggedin hi Admin');
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function dashboard()
    {
        if(Auth::check()){
            return view('dashboard');
        }
  
        return redirect("login")->withSuccess('Opps! You do not have access');
    }
     public function userdashboard()
    {
        if(Auth::check()){
            return view('userdashboard');
        }
  
        return redirect("login")->withSuccess('Opps! You do not have access');
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'role' => $data['role'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function logout(): RedirectResponse
    {
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }
}