<?php

namespace App\Http\Controllers;

use App\Category;
use App\Music;
use Illuminate\Http\Request;

class MusicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $musics = Music::all();
        
        return response()->json([
            'musics' => $musics
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $music = new Music();
        $music->category_id = $request['category_id'];
        $music->artist = $request['artist'];
        $category = Category::find($request['category_id']);
        if ($request->hasFile('music')) {
            $newName = time() . $request['music']->getClientOriginalName();
            $nameMusic = 'music/'.$category->name.'/'.str_replace(' ', '', $newName);
            $music->url = $nameMusic;
            $music->slug = str_replace(' ', '', $request['music']->getClientOriginalName());
            
            $request['music']->move(public_path().'/music/'.$category->name.'/', str_replace(' ', '', $newName));
        }
        $music->save();

        return response()->json([
            'music' => $music
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $musics = Category::find($id);
        $musics->musics;

        return response()->json([
            'musics'=>$musics
        ], 200);
    }
}
