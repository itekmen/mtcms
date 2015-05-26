<?php namespace App\Http\Controllers\Admin\Settings;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\Config;
use Illuminate\Http\Request;
use Bllim\Datatables\Datatables;


class ConfigController extends Controller {


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view("mtcms.settings.config.index");
	}

    public function getIndex(){
        $config = Config::select(['id','name','value'])->live()->orderBy('id','DESC');
        return Datatables::of($config)
        ->add_column('actions',function($row){
            return '<a href="'.url('settings/config/'.$row->id.'/edit').'" class="btn btn-xs btn-default">Düzenle</a>   <a href="'.url('settings/config/'.$row->id).'" data-token="'.csrf_token().'" class="del-item btn btn-xs btn-danger">Sil</a>';
        })
        ->removeColumn('id')
        ->make();
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view("mtcms.settings.config.create");
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
        $this->validate($request,[
            'name' => "required|min:2",
            'value' => "required|min:2",
        ]);
        $request->offsetSet('status',1);

        if(Config::create($request->only(['name','value','status']))){
            return redirect('settings/config')->with('custom_success', "Tanım başarıyla eklendi");
        }else{
            return redirect('settings/config/create')->withErrors(['name' => 'Hata Oluştu!'])->withInput($request->input());
        }
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $config = Config::where('id','=',$id)->live()->firstOrFail();
        return view("mtcms.settings.config.edit")->withConfig($config);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id,Request $request)
	{
        $this->validate($request,[
            'name' => "required|min:2",
            'value' => "required|min:2",
        ]);
        $config = Config::where('id','=',$id)->live()->firstOrFail();
        $config->name    = $request->input('name');
        $config->value   = $request->input('value');
        if($config->save()) {
            return redirect('settings/config/' . $config->id . '/edit')->with('custom_success', "Tanım başarıyla güncellendi");
        }else
            return redirect('settings/config/'.$config->id.'/edit')->withErrors(['name' => 'Hata Oluştu!'])->withInput($request->input());
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id, Request $request)
	{
        if($request->ajax()){
            $config = Config::where('id','=',$id)->live()->firstOrFail();
            $config->status = -1;
            $config->save();
            echo "ok";
        }
	}

}
