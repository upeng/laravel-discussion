<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\PostDiscussionRequest;
use App\Discussion;
use Auth;
use Carbon\Carbon;
use DB;
use Session;
use EndaEditor;
use Cache;
class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',['except' => ['index','show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Cache::put('project_cache_text_01', time() . '-change', 0);
        // Cache::decrement('project_cache_text_01', $value = 1);
        // Cache::increment('project_cache_text_01', $value = 1);
        // var_dump(Cache::get('project_cache_text_01'));
        // Cache::forget('project_cache_text_01');

        $discussions = Discussion::orderBy('created_at','desc')->get();//paginate(5);
        return view('forum.index', compact('discussions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('forum.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostDiscussionRequest $request)
    {
        $request = $request->all();
        $request['user_id'] = Auth::user()->id;
        $request['last_user_id'] = Auth::user()->id;
        $request['created_at'] = Carbon::now();
        $status = Discussion::create($request);
        if ($status)
        {   
            return redirect()->action('PostController@index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $discussion = Discussion::findOrFail($id);
        $discussion['body'] = EndaEditor::MarkDecode($discussion['body']);
        $discussion['title'] = EndaEditor::MarkDecode($discussion['title']);
        return view('forum.show', compact('discussion'));
    }


    public function avatar()
    {
        
        return view('user.avatar');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $discussion = Discussion::findOrFail($id);

        if ($discussion->user->id != Auth::user()->id)
        {
            return redirect()->action('PostController@show',$id);
        }
        return view('forum.edit', compact('discussion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostDiscussionRequest $request, $id)
    {
        $request = $request->all();
        $data = array(
            'title' => $request['title'],
            'body' => $request['body'],
        );
        
        $res = DB::table('discussions')->where('id', $id)->update($data);
        if ($res)
        {
            return redirect()->action('PostController@show',$id)->with([
                'flash_message' => '更新成功',
                'flash_message_important' => true
            ]);;
        }
    }

    public function upload()
    {
        $data = EndaEditor::uploadImgFile('uploads');

        return json_encode($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
