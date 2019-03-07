<?php

/**
 * Created by PhpStorm.
 * User: bradleyirving
 * Date: 2019-03-05
 * Time: 15:10
 */

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }//end function

    public function index(Request $request)
    {
        if (!empty($request->get('sort'))) {
            $sort = Book::addSorting($request);
            $books = Book::orderBy($sort['sort'], $sort['dir'])->get();
        } else {
            //default
            $books = Book::all();
        }//end if
        return response()->json($books);
    }//end function

    public function show(int $id)
    {
        try {
            $record = Book::findOrFail($id);
            return response()->json($record);
        } catch (ModelNotFoundException $exception) {
            return response()->json((array)$exception->getMessage(),404);
        }
    }//end function

    public function create(Request $request)
    {
        $this->validateBook($request);
        $record = new Book($request->all());
        $record->save();
        return response()->json($record);
    }//end function

    public function update(int $id, Request $request)
    {
        $this->validateBook($request);
        $record = Book::findOrFail($id);
        $record->update($request->all());
        return response()->json($record);
    }//end function

    public function destroy(int $id)
    {
        Book::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }//end function

    private function validateBook(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publication_date' => 'required|date',
        ]);
    }
}//end class
