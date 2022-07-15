<?php

namespace App\Http\Controllers\Api\Teacher\Account;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            // Default configs
            $page = (int) $request->page ?? 1;
            $perpage = (int) $request->perpage ?? 10;
            $direction = 'asc'; // Order direction

            // Base query
            // Select only columns from main table
            $query = Teacher::select(['*']);

            // Search
            if (!empty($request->search)) {
                $search = $request->search;
                $query->where('name', 'LIKE', "%{$search}%")->orWhere('email', 'LIKE', "%{$search}%");
            }

            // Order filter
            if (!empty($request->direction)) {
                $direction = $request->direction;
            }

            if (!empty($request->order)) {
                $order = $request->order;
                switch ($order) {
                    case 'name':
                        $query->orderBy($order, $direction);
                        break;
                    case 'email':
                        $query->orderBy($order, $direction);
                        break;
                    case 'created':
                        $query->orderBy('created_at', $direction);
                        break;
                    default:
                        $query->orderBy('id', $direction);
                        break;
                }
            }

            // Paginated result
            $result = $query->paginate($perpage, ['*'], 'page', $page);
            return response()->json($result);
        } catch (\Throwable $th) {
            return errorResponse($th->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [];
        return successResponse($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $data = Teacher::find($id);
            return successResponse($data);
        } catch (\Throwable $th) {
            return errorResponse($th->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $data = Teacher::find($id);
            return successResponse($data);
        } catch (\Throwable $th) {
            return errorResponse($th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $response = new \stdClass;

            $user = Teacher::find($id);

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8'
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors();
                $response->errors = $errors->all();
                $response->message = "Can't create mew account";
                return response()->json($response, 422);
            }

            $user->fill([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ])->save();

            $response->token = $user->createToken('auth_token')->plainTextToken;
            $response->user = $user;
            $response->role = 'user';
            $response->authenticated = true;
            $response->message = "Register successful";
            return successResponse($response);
        } catch (\Throwable $th) {
            return errorResponse($th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Teacher::find($id)->delete();
            return successResponse();
        } catch (\Throwable $th) {
            return errorResponse($th->getMessage());
        }
    }
}
