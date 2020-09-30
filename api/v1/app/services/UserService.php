<?php
class UserService extends Service implements ICrud
{
    private $model;
    public function __construct()
    {
        // $this->authentication();
        $this->model = new User;
    }
    public function index($request = null)
    {
        return httpResponse(
            $this->model->users($request, 5),
            User::infoPaginate("users")
        )->json();
    }

    public function store($request = null, $files =  null)
    {
        $user = User::create();
        $user->idrol = $request->idrol;
        $user->name = $request->name;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->nickname = $request->nickname;
        $user->password = encrypt($request->password);
        $user->status = 1;
        $user->create_date = dateTime();

        if ($user->save()) {
            return httpResponse(200, "success", "User created successfully.")->json();
        } else {
            return httpResponse(500, "error", "Error user not created")->json();
        }
    }

    public function edit($id = null)
    {
        return  httpResponse(User::find($id))->json();
    }
    public function update($request = null, $files = null)
    {
    }
    public function disable($id = null)
    {
        if (User::disable($id)) {
            return httpResponse(200, "success", "User disabled successfully.")->json();
        } else {
            return httpResponse(500, "error", "Error user not disabled")->json();
        }
    }
    public function enable($id = null)
    {
        if (User::enable($id)) {
            return httpResponse(200, "success", "User enabled successfully.")->json();
        } else {
            return httpResponse(500, "error", "Error user not enabled")->json();
        }
    }
}
