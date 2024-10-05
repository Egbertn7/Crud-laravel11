<?php

namespace App\Http\Controllers\Todo;

use App\Http\Controllers\Controller;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Composer;

use function Laravel\Prompts\search;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $max_data = 5;
        if(request('search')){
            $data = Todo::where('task','like','%'.request('search').'%')->paginate($max_data);
        } else {
            $data = Todo::orderBy('task', 'asc')->paginate($max_data);

        }
        return view('todo.app', compact('data'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'task' => 'required|min:5|max:20'
        ],
    [
        'task.required' => 'Wajib Diisi!',
        'task.min' => 'Minimal harus 5 karakter diisi!',
        'task.max' => 'Maximal harus 20 karakter diisi!'
    ]);

    $data = [
        'task'=> $request->input('task')
    ];

    Todo::create($data);
    return redirect()->route('todo')->with('success', 'Berhasil simpan data!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'task' => 'required|min:5|max:20'
        ],
    [
        'task.required' => 'Wajib Diisi!',
        'task.min' => 'Minimal harus 5 karakter diisi!',
        'task.max' => 'Maximal harus 20 karakter diisi!'
    ]);

    $data = [
        'task'=> $request->input('task'),
    ];

    Todo::where('id',$id)->update($data);
    return redirect()->route('todo')->with('success', 'Berhasil Mengubah Data!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        Todo::where('id',$id)->delete();
        return redirect()->route('todo')->with('success', 'Berhasil Mehghapus Data!');
    }
}
