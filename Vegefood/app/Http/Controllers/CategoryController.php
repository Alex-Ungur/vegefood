<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Session;

class CategoryController extends Controller
{
    //
    public function enregistrerCategorie(Request $request) {

        $data = array();
        $data['name'] = $request->name;

        $insertData = DB::table('categories') ->insert($data);

        Session::put('message', 'Catégorie ajoutée');

        return redirect::to('/ajoutCategorie');

    }

    public function modifierCategorie($id) {
        $categories = DB::table('categories')
                    ->where('id', $id)
                    ->first();

        $manageCategory = view('admin.modifierCategorie')
                    ->with('categories', $categories);

        return view('layout.appadmin')
                    ->with('admin.modifierCategorie',$manageCategory);

    }

    public function editCategorie (Request $request) {

        $data=array();
        $data['name']=$request->name;

        $data1=array();
        $data1['category']=$request->name;

        $oldCategory = DB::table('categories')
                ->where('id', $request->id)
                ->first();
        
        DB::table('products')
                ->where('category', $oldCategory->name)
                ->update($data1);
        
        DB::table('categories')
                ->where('id', $request->id)
                ->update($data);

        Session::put('message', 'Catégorie modifiée');

        return redirect::to('/categories');

    }

    public function supprimerCategorie($id) {

        DB::table('categories')
            ->where('id', $id)
            ->delete();

        Session::put('message', 'Categorie supprimée');
    
        return redirect::to('/categories');
    }
}
