<?php

class UserController extends BaseController
{

    private $rootId = 25;

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }


    /**
     * Ukaze stranku s registraci uzivatele.
     *
     * @return Response
     */
    public function create()
    {
        return View::Make('user/create');
    }


    /**
     * Ulozi uzivatele do databaze, vypise zpravu o uspechu a presmeruje pryc.
     *
     * @return Response
     */
    public function store()
    {

//	  $users = DB::table('Users')->get();
//	  echo Input::get('den').Input::get('mesic');

        $caught = false;


        $user = new User();
        $user->Jmeno = Input::get('jmeno') . " " . Input::get('prijmeni');
        $user->Ulice = Input::get('ulice');
        $user->Mesto = Input::get('mesto');
        $user->Psc = Input::get('psc');
        $user->datumnarozeni = date("Ymd", strtotime(Input::get('den') . "." . Input::get('mesic') . "." . Input::get('rok')));
        $user->Email = Input::get('email');
        $user->Telefon = Input::get('telefon');
        $user->password = Hash::make(Input::get('password'));

        try {
            $user->save();
        } catch (Exception $e) {
            $caught = true;
            echo '<meta charset="utf-8">';
            echo "Uživatel již existuje";
            echo '<script> alert("Uživatel již existuje"); window.history.back();</script>';
        }


        if (!$caught) {
            $s = "Děkujeme Vám za registraci na webu www.zenysobe.eu";
            Mail::send('emails.auth.welcome', array('psw' => Input::get('password'), 'email' => Input::get('email')), function ($message) {
                $message->to(Input::get('email'), 'registrace')->subject('Registrace Ženy Sobě');
            });


            echo '<meta charset="utf-8">';
            echo '<script> alert("Uživatel vytvořen"); window.location.href="session/create"</script>';
        }
//          return Redirect::to('/calendar');
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        if (Auth::User()->id == $id || Auth::User()->id == $this->rootId) {

            DB::table('Attending')->where('idUser', '=', $id)->delete();

            $user = User::find($id);
            $user->delete();
            return Redirect::to("root/userList");
        }
    }

    public function printUsers()
    {
        $users = DB::table('Users')->get();
        $events = DB::table('Events')->get();

        dd($events);
    }


    /**
     * Ukaze stranku administratora.
     */
    public function rootpage()
    {
        return View::make('user/root');
    }

    /**
     * Vrati instanci User podle zadaneho emailu
     */
    private function getUserByEmail($email)
    {
        return (DB::table('Users')->where('Email', $email)->first());
    }

    /**
     * Vrati instanci tridy User podle zadaneho tokenu. Pouzito pri zapomenutem heslu
     */
    private function getUserByToken($token)
    {
        dd(DB::table('Users')->where('id', $token)->first()->Jmeno);
    }

    /**
     * Vygeneruje nahodny string velkych pismen delky $lendth
     */
    public function genRandomString($length)
    {
        $s = '';
        $this->getUserByToken(4);

        for ($ii = 0; $ii < $length; $ii++) {
            $s = $s . chr(rand(65, 90));
        }
        return ($s);
    }


    /**
     * Zmeni heslo uzivateli $user.
     */
    private function changeUserPass($password, $user)
    {
        $user = User::where('id', '=', Auth::User()->id)->first();
        $user->password = Hash::make($password);
        $user->save();
    }

    /**
     * Zmeni heslo aktualnimu uzivateli
     */
    private function changeCurrentPass($password)
    {
        if (Auth::User()) {
            $this->changeUserPass($password, Auth::User());
        }

        dd('Heslo zmeneno');
    }

    /**
     * Zobrazi stranku s formularem pro zmenu hesla
     */
    public function changePswView()
    {
        return View::make('user/changepsw');
    }

    /**
     * Funkce volana z View(user/changepsw)
     */
    public function callChangePsw()
    {
        if (Input::get('newpass') != Input::get('newpass2')) {
            echo "Hesla se neshodují\n";
            die;
        }

        $this->changeCurrentPass(Input::get('newpass'));
    }

    /**
     * Ajax na validaci emailu pri vytvareni uzivatele
     */
    public function emailValidate(){
        $email = Input::get("email");


        if(DB::table('Users')->where('email', '=', $email)->count() == 0){
            $arr = array('msg' => "OK");
            echo json_encode($arr);
        }
        else {
            $arr = array('msg' => "Zvote jiný email.");
            echo json_encode($arr);
        }

    }


}
