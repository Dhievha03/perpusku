<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BookCategory;
use Illuminate\Http\Request;

class BookCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.book_category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required'
        ]);

        BookCategory::create([
            'category_name' => $request->category_name
        ]);
        
        return redirect()->route('admin.bookCategories.index')->with('success', 'Data berhasil disimpan.');
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bookCategory = BookCategory::find($id);
        return view('admin.book_category.index', [
            'bookCategory' => $bookCategory
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'category_name' => 'required'
        ]);

        $bookCategory = BookCategory::find($id);

        $bookCategory->update([
            'category_name' => $request->category_name,
        ]);
    
        return redirect()->route('admin.bookCategories.index')->with('success', 'Data berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bookCategory = BookCategory::find($id);
        $bookCategory->delete();
        return redirect()->route('admin.bookCategories.index')->with('success', 'Data berhasil dihapus');
    }

    public function getBookCategories(Request $request)
    {
        if ($request->ajax()) {
            $data = BookCategory::get();
            return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $id = $row->id;
                    $edit = route('admin.bookCategories.edit', $id);
                    $delete = route('admin.bookCategories.delete', $id);
        
                    $actionBtn = '
                    <div class="d-flex gap-1">

                    <a href="' . $edit . '" class="btn btn-sm btn-icon btn-warning m-1"><i class="far fa-edit"></i></a>
        
                    <form method="POST" action="' . $delete . '">
                    ' . method_field('DELETE') . '
                    ' . csrf_field() . '
                    <button type="submit" class="btn btn-sm btn-icon btn-danger m-1" onclick="return confirm(\'Anda yakin?\')"><i class="fas fa-trash-alt"></i></button>
                    </form>
                    </div>
                    ';
        
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
