<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Session;

class SliderController extends Controller
{
    public function enregistrerSlider(Request $request) {
        
        $this->validate($request, [
            'sliderImage' =>'image|nullable|max:1999'
        ]);

        if($request->hasFile('sliderImage')) {

            // 1 : Get file with name extension
            $fileNameWithExt = $request->file('sliderImage')->getClientOriginalName();

            // 2 : Get file name only
            $fileName=pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            //3 : Get the extension only
            $extension = $request->file('sliderImage')->getClientOriginalExtension();

            //4 : file name to store
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;

            //5 path
            $path = $request->file('sliderImage')->storeAs('public/slider_images', $fileNameToStore);
        }
        else {
            $fileNameToStore = 'noImage.jpg';
        }





        $data = array();
        $data['description1'] = $request->description1;
        $data['description2'] = $request->description2;
        $data['sliderImage'] = $fileNameToStore;
        $data['status'] = $request->status;
    
        DB::table("sliders")->insert($data);
    
        Session::put('message', 'Slider enregistré');
    
        return redirect::to('/ajoutSlider');
        # code...
        
    }

    public function activerSlider($id) {
        $data = array();
        $data['status'] = 1;


        DB::table('sliders')
            ->where('id', $id)
            ->update($data);

        Session::put('message', 'Slider activé');
    
        return redirect::to('/sliders');
    }

    public function desactiverSlider($id) {
        $data = array();
        $data['status'] = 0;

        DB::table('sliders')
            ->where('id', $id)
            ->update($data);

        Session::put('message', 'Slider desactivé');
    
        return redirect::to('/sliders');
    }

    public function supprimerSlider($id) {

        $slider = DB::table('sliders')
            ->where('id', $id)
            ->first();
            
        if($slider->sliderImage != 'noImage.jpg') {
            Storage::delete('public/slider_images/'.$slider->sliderImage);
        }

        DB::table('sliders')
            ->where('id', $id)
            ->delete();

        Session::put('message', 'Slider supprimé');
    
        return redirect::to('/sliders');
    }

    public function modifierSlider($id) {

        $sliders = DB::table('sliders')
                    ->where('id', $id)
                    ->first();

        $manageSliders = view('admin.modifierSlider')
                    ->with('sliders', $sliders);

        return view('layout.appadmin')
                    ->with('admin.modifierSlider',$manageSliders);

    }

    public function editSlider (Request $request) {


        $this->validate($request, [
            'sliderImage' =>'image|nullable|max:1999'
        ]);

        if($request->hasFile('sliderImage')) {

            // 1 : Get file with name extension
            $fileNameWithExt = $request->file('sliderImage')->getClientOriginalName();

            // 2 : Get file name only
            $fileName=pathinfo($fileNameWithExt, PATHINFO_FILENAME);

            //3 : Get the extension only
            $extension = $request->file('sliderImage')->getClientOriginalExtension();

            //4 : file name to store
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;

            //5 path
            $path = $request->file('sliderImage')->storeAs('public/slider_images', $fileNameToStore);
        }
        else {
            $fileNameToStore = 'noImage.jpg';
        }


            $data=array();
            $data['description1']=$request->description1;
            $data['description2']=$request->description2;
            
            if($request->hasFile('sliderImage')) {
                $sliders = DB::table('sliders') 
                            ->where('id', $request->id)
                            ->first();

                $data['sliderImage'] = $fileNameToStore;
                
                if($sliders->sliderImage != 'noImage.jpg') {
                    Storage::delete('/public/slider_images/'. $sliders->sliderImage);
                    /* Le prof est nul 
                    // Ligne du prof pour effacer l'image présente dans le dossier.. qui supprime le nom du produit du dossier.. qui n'existe pas.
                    Storage::delete('/public/cover_images/'. $sliders->name); ??????? 
                    // Mes tests
                    echo '/public/slider_images/'. $sliders->sliderImage;
                    return 0;
                    */
                }

            }

        DB::table('sliders')
                ->where('id', $request->id)
                ->update($data);

        Session::put('message', 'Slider modifié');

        return redirect::to('/sliders');

    }

}
