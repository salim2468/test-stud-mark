<?php

namespace App\Http\Controllers;

use App\Models\Mark;
use App\Models\Student;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\UpdateMarkRequest;
use App\Models\Subject;

class MarkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        Log::debug('create');
        $class = $request->class;
        $term = $request->term;
        $studentId = $request->studentId;

        // check if marks of student of that class and of that term are already present
        $mark = Mark::where('student_id', $studentId)->where('term', $term)->where('class', $class)->first();
        if($mark) {
            return redirect()->route('mark.show',['studentId' => $studentId,'term' => $term,'class' => $class]);
        }

       $student = Student::find($studentId);
       $existingSubjects = Category::find($student['category_id'])->subjects()->wherePivot('class', $class)->get();

       return view('mark_create',compact('studentId', 'existingSubjects','class','term'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMarkRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        Log::debug('store');        
        Log::debug(json_encode($request->all()));
        $marks = $request->except(['_token', 'studentId', 'class','term']);

        foreach ($marks as $key => $value) {
            Log::debug($key . $value);
            Mark::create([
                'subject_id' => $key,
                'student_id' => $request->studentId,
                'marks' => $value,
                'class' => $request->class,
                'term' => $request->term,
            ]);
        }
        return redirect()->route('student.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mark  $mark
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $studentId, $term, $class)
    {
        Log::debug($studentId . $term . $class);
        $marks = Mark::where('student_id', $studentId)->where('term', $term)->where('class', $class)->get();
        Log::debug(json_encode($marks));
        return view('mark_show')->with(['marks'=> $marks]);
        // return response(['studentId'=>$studentId, 'term'=>$term, 'class'=>$class]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mark  $mark
     * @return \Illuminate\Http\Response
     */
    public function edit(Mark $mark)
    {
        Log::debug('edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMarkRequest  $request
     * @param  \App\Models\Mark  $mark
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMarkRequest $request, Mark $mark)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mark  $mark
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mark $mark)
    {
        //
    }

    // public function addMark($studentId) 
    // {
    //     $student = Student::findOrFail($studentId);
    //     $subects = Category::find($student['category_id'])->subjects;

    //     return view('mark_create')->with(['existingSubjects'=>$subects])->with(['studentId'=>$studentId]);
    // }

    public function test() {
        // $data = Student::where('id',1)->with('marks')->groupBy('class')->get();
        // $groupedMarks = $data->marks->groupBy(function($mark) {
        //     return $mark->student->class->name; // Assuming 'name' is a field in the ClassModel
        // });

        $c = Category::all();
        Log::debug($c);
        $c->each(function($item, $key) {
            $item->append('user');
            Log::debug($key . ' => ' .$item);
        });
        // Log::debug($c);
        // return response(['data' =>$c]);

        // $student = Student::find(1);
        // $subects = Category::find($student['category_id'])->subjects()->wherePivot('class',12)->get();
        // return response(['data' => $groupedMarks]);

    }
}
