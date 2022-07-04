<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use App\Http\Validation\TeamValidation;
use Illuminate\Support\Facades\Validator;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teams = Team::all();

        return response()->json($teams);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, TeamValidation $validation)
    {
        $validator = Validator::make($request->all(), $validation->rules(), $validation->messages());
        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()],401);
        }
        
        $team = Team::create([
            'name' => $request->input('name'),
            'players' =>  $request->input('players'),
        ]);

        return response()->json($team);
    }

/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getStats()
    {
        $teams = Team::orderBy('timeSec',"asc")->get();

        return response()->json($teams);
    }
    
    public function setTime(Request $request,$id)
    {
        $team = Team::find($id);

        $time = $request->get('time');

        $team->time = $time;

        $timeSplitted = explode(':', $time);
        $timeSec = 0;

        if (sizeOf($timeSplitted) == 3){
            $timeSec = $timeSplitted[0]*3600 + $timeSplitted[1]*60 + $timeSplitted[2];
        } else {
            $timeSec = $timeSplitted[0]*60 + $timeSplitted[1];
        }

        $team->timeSec = $timeSec;

        $team->save();
    }
}
