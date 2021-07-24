<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreMultipicRequest;
use App\Models\Multipic;
use Image;

class MultipicController extends Controller
{
        //show multiple pictures
        public function showPics()
        {
            $pics = Multipic::all();
            return view('admin.pics.index', compact('pics'));
        }

        //store multiple pictures
        public function storePics(StoreMultipicRequest $request)
        {
            $images = $request->file('image');

            foreach ($images as $image) {
                //  $request->validate([
                //     'image' => 'file|image',
                // ]);
                $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                Image::make($image)->resize(300, 200)->save('image/brand/' . $name_gen);
                $last_img = 'image/brand/' . $name_gen;

                Multipic::create([
                    'image' => $last_img,
                ]);
            }
            // end of foreach

            return redirect()->back()->with('message', 'Images Added Successfully');
        }
}
