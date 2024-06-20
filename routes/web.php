<?php

use App\Models\Mark;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Category;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MarkController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/student', [StudentController::class, 'index'])->name('student.index');
Route::get('/student/add', [StudentController::class, 'create'])->name('student.create');
Route::post('/student', [StudentController::class, 'store'])->name('student.store');
Route::get('/student/{student}', [StudentController::class, 'show'])->name('student.show');


Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
Route::post('/category', [CategoryController::class, 'store'])->name('category.store');
Route::post('/category/{categoryId}/add-subject', [CategoryController::class, 'addSubject'])->name('category.addSubject');
Route::get('/category/{categoryId}/get-unselected-subject', [CategoryController::class, 'getUnselectedSubject'])->name('category.getUnselectedSubject');
Route::delete('/category/{categoryId}', [CategoryController::class, 'destroy'])->name('category.destroy');


Route::get('/subject', [SubjectController::class, 'index'])->name('subject.index');
Route::post('/subject', [SubjectController::class, 'store'])->name('subject.store');
Route::delete('/subject/{id}', [SubjectController::class, 'destroy'])->name('subject.destroy');
Route::delete('/subject/{sId}/category/{cId}', [SubjectController::class, 'remove'])->name('subject.remove');


// Route::get('/mark-add/{studentId}', [MarkController::class, 'addMark'])->name('mark.addMark');
Route::get('/mark', [MarkController::class, 'create'])->name('mark.create');
Route::post('/mark', [MarkController::class, 'store'])->name('mark.store');
Route::get('/mark/{studentId}/{term}/{class}', [MarkController::class, 'show'])->name('mark.show');


Route::get('/test', [MarkController::class, 'test']);

/*
Route::get('/{id}', function ($id) {
    $students = Student::all();
    $subjects = Subject::all();
    $categories = Category::all();
    $marks = Mark::all();

    // Log::debug('Student');
    // Log::debug($students);
    
    Log::debug('Subject');
    Log::debug($subjects);

    Log::debug('Category');
    Log::debug($categories);

    // Log::debug('Mark');
    // Log::debug($marks);

    //  $r = Student::find(1)->with('category')->get();
    //  Log::debug(json_encode($r));
    //  [{"id":1,"name":"Jhon","category_id":1,"created_at":null,"updated_at":null,"category":{"id":1,"name":"Phy","created_at":null,"updated_at":null}}]  


    //  $r = Category::find(1)->with('students')->get();
    //  Log::debug(json_encode($r));
    //  [{"id":1,"name":"Phy","created_at":null,"updated_at":null,"students":[{"id":1,"name":"Jhon","category_id":1,"created_at":null,"updated_at":null}]}]  

    // $r = Category::find(1);
    // Log::debug(json_encode($r->subjects->pluck('name')));
    // ["Math","Physic"]  
    
    // $s = Student::find(1);
    // Log::debug(json_encode($s->marks));
    // [{"id":1,"name":"Phy","created_at":null,"updated_at":null},{"id":2,"name":"Bio","created_at":null,"updated_at":null}]  
    // Log::debug(json_encode($s->marks->makeHidden(['created_at','updated_at'])));
    // [{"id":4,"student_id":1,"subject_id":1,"marks":40,"term":1,"class":11},{"id":5,"student_id":1,"subject_id":2,"marks":30,"term":1,"class":11},{"id":6,"student_id":1,"subject_id":3,"marks":70,"term":1,"class":11}]  
    
    $s = Student::with(['marks:id,subject_id,marks'])->find(1);

    // $s = Student::select('id','subject_id', 'marks')->find(1);
    Log::debug(json_encode($s));
});
*/