<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\listEntry;
use App\models\Image;

class TodoListController extends Controller
{
    //
    public function index(){
        // show all ListEntries
        // return view('welcome', ['listEntries' => listEntry::all()]);
        return view('login');
        // show all, which are not complete
        // return view('welcome', ['listEntries' => listEntry::where('is_complete', 1)->get()]);
    }

    public function userView(){
        return view('user');
    }

    public function showAll(){
        return view('welcome', ['listEntries' => listEntry::all()]);
    }
    
    public function showOpen(){
        return view('welcome', ['listEntries' => listEntry::where('is_complete', 0)->get()]);
    }

    public function showDone(){
        return view('welcome', ['listEntries' => listEntry::where('is_complete', 1)->get()]);
    }

    public function saveItem(Request $request){
        \Log::info(json_encode($request->all()));
        // neues Listen-Element erstellen
        $newListEntry = New listEntry;
        $newListEntry->name= $request->listEntry;
        $newListEntry->is_complete = 0;
        $newListEntry->isDone= false;
        $newListEntry->save();
        return redirect('/');
    }

    public function markComplete($id){
        // \Log::info($id);
        // ListElement updaten
        $ListEntry = listEntry::find($id);
        \Log::info($ListEntry);
        if($ListEntry->is_complete == 0){
            $ListEntry->is_complete = 1;
        } else{
            $ListEntry->is_complete = 0;
        }
        $ListEntry->save();
        return redirect('/');
    }

    // public function toggleComplete($id){
    //     $ListEntry = listEntry::find($id);
    //     $ListEntry->isDone = !$ListEntry->isDone;
    //     $ListEntry->save();
    //     \Log::info($ListEntry);
    //     return redirect('/');
    // }

    public function deleteEntry($id){
        $ListEntry = listEntry::find($id);
        \Log::info($ListEntry);
        $ListEntry->delete();
        return redirect('/');
    }

    // Vue
   public function indexTodo()
    {
        return listEntry::all();
         
    }

    public function saveWithVue(Request $request){
        // dd($request->all());
        $newListEntry = $request->all();
        $response = listEntry::create($newListEntry);
        return response()->json([
            'status' => 'success',
            'data' => $response
        ], 200);
    }

    public function updateWithVue(Request $request, $id){
        $updatedListEntry = listEntry::find($id);

        $updatedListEntry->name = $request->input('name');
        $updatedListEntry->is_complete = $request->input('is_complete');
        $updatedListEntry->isDone = $request->input('isDone');

        $updatedListEntry->update();

        return response()->json([
            'status' => 200,
            'message' => 'Todo is updated',
        ], 200);
        
    }

    public function deleteWithVue(Request $request, $id){
        $deletedListEntry = listEntry::find($id);
        $deletedListEntry->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Todo is deleted',
        ], 200);
    }
    
    public function loadImg(){
        return Image::all();
        // return listEntry::all();
        // return view('image', ['images' => Image::all()]);
    }

    // API
    public function todoRestApi (){
        $listEntries = ListEntry::all();

        if($listEntries->count() > 0){
            $data =[
                'status' => 200,
                'listEntries' => $listEntries
            ];
            return response()->json($data, 200);
        } else {
            $data =[
                'status' => 404,
                'listEntries' => 'No records found'
            ];
            return response()->json($data, 200);
        }
        
       
    }
}
