<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Roles;
class RolesController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
      $this->middleware('auth');
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {

      return view('settings.roles');
  }

  public function store(Request $request)
  {
      if($request->get('button_action') == 'add'){
          $role = new Roles;
          $role->validation('create', $request->all());
          $role->role = $request->role;
          $role->rate = $request->rate;
          $role->save();
      }

      if($request->get('button_action') == 'update'){
          $role = new Roles;
          $role = $role->validation('update', $request->all());
          $role->role = $request->role;
          $role->rate = $request->rate;
          $role->save();
      }

      return response()->json('success');
  }

  public function refresh()
  {
      $roles = Roles::all();
      return \DataTables::of(Roles::query())
      ->addColumn('action', function($roles){
            if(isAdmin()){
                return '<button class="btn btn-xs btn-warning update_role waves-effect" id="'.$roles->id.'"><i class="material-icons">mode_edit</i></button>
                <button class="btn btn-xs btn-danger delete_role waves-effect" id="'.$roles->id.'"><i class="material-icons">delete</i></button>';
            }
            else{
                return 'Admin';
            }
        })
        ->editColumn('rate', function ($data) {
            return '₱'.number_format($data->rate, 2, '.', ',');
        })
      ->make(true);
  }
  function updatedata(Request $request){
      $id = $request->input('id');
      $role = Roles::find($id);
      $output = array(
          'role' => $role->role,
          'rate' => $role->rate,
      );
      echo json_encode($output);
  }

  function deletedata(Request $request){
      $role = Roles::find($request->input('id'));
      $role->delete();
  }

}
