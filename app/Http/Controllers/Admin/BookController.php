<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookCategory;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Rap2hpoutre\FastExcel\FastExcel;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookCategories = BookCategory::get();
        return view('admin.book.index', [
            'bookCategories' => $bookCategories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bookCategories = BookCategory::get();
        return view('admin.book.create',[
            'bookCategories' => $bookCategories
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
        $request->validate([
            'book_title' => 'required',
            'category_id' => 'required',
            'amount' => 'required',
            'cover_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'book_file' => 'required|mimes:pdf',
            'description' => 'required',
        ]);
    
        $pdfPath = null;
        $imagePath = null;

        if ($request->hasFile('book_file')) {
            $file = $request->file('book_file');
            $fileName = Str::random(16) . '.' . $file->getClientOriginalExtension();
            $pdfPath = $file->storeAs('public/book_file', $fileName);
        }

        if ($request->hasFile('cover_image')) {
            $image = $request->file('cover_image');
            $imageName = Str::random(16) . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('public/cover', $imageName);
        }
        
        if ($imagePath && $pdfPath) {
            Book::create([
                'user_id' => 1,
                'book_title' => $request->book_title,
                'category_id' => $request->category_id,
                'amount' => $request->amount,
                'cover_image' => $imageName,
                'book_file' => $fileName,
                'description' => $request->description,
            ]);
        
            return redirect()->route('admin.book.index')->with('success', 'Data berhasil disimpan.');
        }else{
            return back()->with('error', 'Ups sepertinya ada yang salah');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return view('admin.book.show', [
            'book' => $book
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        $bookCategories = BookCategory::get();
        return view('admin.book.edit', [
            'book' => $book,
            'bookCategories' => $bookCategories
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'book_title' => 'required',
            'category_id' => 'required',
            'amount' => 'required',
            'cover_image' => 'image|mimes:jpeg,png,jpg|max:2048',
            'book_file' => 'mimes:pdf',
            'description' => 'required',
        ]);
    
       
        $pdfPath = null;
        $imagePath = null;
        $fileName = $book->book_file;
        $imageName = $book->cover_image;

        if ($request->hasFile('book_file')) {
            $file = $request->file('book_file');
            $fileName = Str::random(16) . '.' . $file->getClientOriginalExtension();
            $pdfPath = $file->storeAs('public/book_file', $fileName);

            if(!$pdfPath){
                return back()->with('error', 'Ups sepertinya ada yang salah');
            }
        }

        if ($request->hasFile('cover_image')) {
            $image = $request->file('cover_image');
            $imageName = Str::random(16) . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('public/cover', $imageName);
            if(!$imagePath){
                return back()->with('error', 'Ups sepertinya ada yang salah');
            }
        }

        
        $book->update([
            'book_title' => $request->book_title,
            'category_id' => $request->category_id,
            'amount' => $request->amount,
            'cover_image' => $imageName,
            'book_file' => $fileName,
            'description' => $request->description,
        ]);
    
        return redirect()->route('admin.book.index')->with('success', 'Data berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return back()->with('success', 'Data berhasil dihapus');
    }

    public function getBooks(Request $request)
    {
        if ($request->ajax()) {
            $data = Book::with(['categories', 'user']);

            if ($request->has('category') && $request->category != 0) {
                $categoryId = $request->input('category');
                $data->where('category_id', $categoryId);
            }

            $data = $data->get();
            return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('cover', function($row){
                    return '<img src="'.asset("storage/cover/".$row->cover_image).'" alt="Cover Image" style="width:100px;">';
                })
                ->addColumn('kategori', function($row){
                    return $row->categories->category_name ?? 'n/a';
                })
                ->addColumn('penulis', function($row){
                    return $row->user->name ?? 'n/a';
                })
                ->addColumn('action', function ($row) {
                    $id = $row->id;
                    $show = route('admin.book.show', [$id, Str::slug($row->book_title)]);
                    $edit = route('admin.book.edit', $id);
                    $delete = route('admin.book.delete', $id);
        
                    $actionBtn = '
                    <div class="d-flex gap-1">
                    <a href="' . $show . '" class="btn btn-sm btn-icon btn-primary m-1"><i class="far fa-eye"></i></a>

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
                ->rawColumns(['cover', 'action'])
                ->make(true);
        }
    }

    public function exportExcel()
    {
        $data = Book::all();
        return (new FastExcel($data))->download('books.xlsx');
    }

    public function exportPdf()
    {
        $book = Book::with(['user', 'categories'])->get();
 
    	$pdf = Pdf::loadview('pdf.book_pdf',['book' => $book]);
    	return $pdf->download('data-buku.pdf');
    }
}
