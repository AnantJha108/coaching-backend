<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['courses'] = Course::all();
        return response()->json($data,200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = Validator::make($request->all(),[
            'title' => 'required',
            'duration' => 'required',
            // 'image' => 'required|image',
            'fees' => 'required',
            'discount_fees' => 'required',
            'description' => 'required',
        ]);
        // $filename = $request->image->getClientOriginalName();
        // $request->image->move(public_path('images'), $filename);
        // $data['image'] = $filename;
        if($data->fails()){
            return response()->json(["msg" => $data->errors()], 200);
        }
        else{
            $course =  Course::create($data->validated());
            return response()->json([
                "msg" => "Course Added", 
                "insertedData"  => $course
            ], 200);
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $c)
    {
        $data = Validator::make($request->all(),[
            'title' => 'required',
            'duration' => 'required',
            // 'image' => 'required|image',
            'fees' => 'required',
            'discount_fees' => 'required',
            'description' => 'required',
        ]);
        if($data->fails()){
            return response()->json(["msg" => $data->errors()], 200);
        }
        else{
            $c->title = $request->title;
            $c->duration = $request->duration;
            $c->fees = $request->fees;
            $c->discount_fees = $request->discount_fees;
            $c->description = $request->description;
            $c->save();
            return response()->json([$c,"msg" => "Course Updated"
            ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $c)
    {
        $c->delete();
        $course['data'] = $c;
        return response()->json([$course,'msg'=>'Data deleted successfull']);
    }
}
