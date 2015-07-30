<?php
namespace App\Controllers;
use App\Models\lib\RensikeService;
use Carbon\Carbon;
use View,Input,Image,Crypt,Rensike,Response,Good;
class RensikeController extends \BaseController {

    public function __construct(){
         $this->beforeFilter('csrf',array('on'=>'post'));
    }

    public function getTest()
    {
       return Carbon::now('Asia/Shanghai')->addMinutes(15);
    }

    public function getIndex()
    {
        abort(404, '对不起，你要编辑的用户没有找到');
    }

    public function getAddgood(){
        $arr = ['name'=>'good'.mt_rand(1,100),'desc'=>'this is a good '.mt_rand(1,100),'gid'=>mt_rand(1,999),'price'=>mt_rand(1,2000),'num'=>mt_rand(10,60)];
        $good = Good::insertGood($arr);
        print_r($arr);
        return  "已经添加了".Session::get('hello')."条商品了";
    }

    public function getList()
    {
        $data = Rensike::getAllData();
        print_r($data);
    }

	/**
	 * Display a listing of the resource.
	 * GET /rensike
	 *
	 * @return Response
	 */
//	public function index()
//	{
//		return "你好，我是任思可";
//	}

    public function getUpload()
{

    return View::make('rensike.upload');

}

    public function postUpload()
    {
        $file = Input::file('mypic');
        if(is_null($file)){
            echo "文件上传失败";
            exit;
        }
        $filename = date('Y_m_d_H_i_s')."-".$file->getClientOriginalName();
        Image::make($file->getRealPath())->resize(100,100)->save(public_path('upload/'.$filename));

    }

    public function getCrypt()
    {
        echo Crypt::encrypt('任思可呵呵呵');
    }

	/**
	 * Show the form for creating a new resource.
	 * GET /rensike/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /rensike
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /rensike/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /rensike/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /rensike/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /rensike/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}