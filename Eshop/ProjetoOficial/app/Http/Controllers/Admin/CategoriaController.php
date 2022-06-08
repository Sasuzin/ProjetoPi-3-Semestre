<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index()
    {
        return view('admin.categorias.index');
    }

    public function add()
    {
        return view('admin.categorias.add');
    }

    public function insert (Request $request)
    {
        $categorias = new Categoria();
        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('assets/uploads/categorias'.$filename);
            $categorias->image = $filename;
        }

        $categorias->name = $request->input('name');
        $categorias->slug = $request->input('slug');
        $categorias->description = $request->input('description');
        $categorias->status = $request->input('status') == TRUE ? '1':'0';
        $categorias->popular = $request->input('popular') == TRUE ? '1':'0';
        $categorias->meta_title = $request->input('meta_title');
        $categorias->meta_keywords = $request->input('meta_keywords');
        $categorias->meta_descrip = $request->input('meta_description');
        $categorias->save();
        return redirect('/dashboard')-> with('status', 'Categoria adicionada com Sucesso!');

    }
}
