<?php
namespace App\Controllers;

use View,Auth,Input,Redirect;

class UserController extends \BaseController{

    public function __construct()
    {
        $this->beforeFilter('csrf',array('on'=>'post'));
    }

    public function getSignin()
    {
        return View::make('user.signin');
    }

    public function postSignin()
    {
        if(Auth::attempt(array('email'=>Input::get('email'),'password'=>Input::get('mypwd')))){
            return Redirect::to('home')->with('message','恭喜你，登陆成功');
        }

        return Redirect::to('user/signin')->with('message','对不起，登录失败')->withInput();
    }

    public function getSignout()
    {
        Auth::logout();
        return Redirect::to('home')->with('message','恭喜你，成功退出本网站');
    }

}