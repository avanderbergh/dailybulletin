<?php

namespace App\Http\Controllers;

use App\Announcement;
use App\Grade;
use Avanderbergh\Schoology\Facades\Schoology;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AnnouncementsController extends Controller
{
    public function __construct()
    {
        $this->middleware('checkrolepermission', ['only' => ['store','update','destroy']]);
        $this->middleware('checkowner' , ['only' => ['edit','update','destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($id=null)
    {
        Schoology::authorize();
        $grad_year = Schoology::apiResult('users/'.Auth::user()->id)->grad_year;
        if($grad_year){
            $grade = Grade::where('grad_year',$grad_year)->first();
            $announcements = $grade->announcements()->where('published_from', '<=', Carbon::now())->where('published_until','>=', Carbon::now())->get();
        } elseif($id){
            $grade = Grade::findOrFail($id);
            $announcements = $grade->announcements()->where('published_from', '<=', Carbon::now())->where('published_until','>=', Carbon::now())->get();
        } else {
            $announcements = Announcement::where('published_from', '<=', Carbon::now())->where('published_until', '>=', Carbon::now())->get();
        }
        $date = Carbon::now()->format('l, F j, Y');

        return view('announcements.list')->with('announcements',$announcements)->with('date',$date);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $grades = Grade::all();
        $dates = array();
        $days = [1,2,3,4,5,6,7];
        for ($i=0; $i<=180; $i++){
            $dates[$i] = Carbon::now()->addDay($i)->format('l jS \\of F');
        }
        $announcement = new Announcement();
        return view('announcements.create')->with('grades', $grades)->with('dates', $dates)->with('announcement',$announcement)->with('days', $days);
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body'  => 'required',
            'grades' => 'required'
        ]);
        $published_from = Carbon::now('Europe/Berlin')->addDays($request->postFrom);
        $published_until = Carbon::now('Europe/Berlin')->addDays($request->postFrom + $request->postFor);
        $announcement = Announcement::create([
            'title' => $request->title,
            'body'  => $request->body,
            'user_id' => session('schoology')['uid'],
            'published_from' => $published_from,
            'published_until' => $published_until
        ]);
        $announcement->grades()->attach($request->grades);
        return redirect(url('application'));

        /**

        $input['user_id']=session('schoology')['uid'];
        $input['published_until']=Carbon::now('Europe/Berlin')->addDays($input['postFor']);
        $announcement = Announcement::create($input);


        */
    }

    /**
     * Display the specified resource.
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
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $grades = Grade::all();
        $dates = array();
        for ($i=1; $i<=10; $i++){
            $dates[$i] = Carbon::now()->addDay($i)->format('l jS \\of F');
        }
        $announcement = Announcement::findOrFail($id);
        return view('announcements.edit')->with('grades', $grades)->with('dates', $dates)->with('announcement', $announcement);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update($id, Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body'  => 'required',
            'grades' => 'required'
        ]);
        $announcement = Announcement::findOrFail($id);
        $announcement->update($request->all());
        $announcement->grades()->sync($request->grades);
        return redirect(url('application'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Announcement::destroy($id);
        return redirect(url('application'));
    }
}
