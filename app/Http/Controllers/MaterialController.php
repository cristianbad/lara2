<?php
// Common Resource Routes:
// index - Show all listings
// show - Show single listing
// create - Show form to create new listing
// store - Store new listing
// edit - Show form to edit listing
// update - Update listing
// destroy - Delete listing

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function index(Request $request)
    {
        // //dd($request->query());

        // $order = $request->query('order');
        // //echo $request->query('order');

        // $orderTypes = array('name', 'type', 'quantity', 'code', 'id', 'user_id');

        // if (in_array($order, $orderTypes)) {
        //     return view('index', ['materials' => Material::orderBy($order)->filter(request(['search']))->paginate(8)]);
        // }

        return view('index', ['materials' => Material::latest()->filter(request(['search']))->paginate(8)]);
    }

    public function order($orderby)
    {
        return view('index', ['materials' => Material::orderBy($orderby)->filter(request(['search']))->paginate(8)]);
    }

    public function show()
    {
    }

    public function create()
    {
    }

    public function store(Request $request)
    {


        $formFields = $request->validate([
            'name' => 'required',
            'quantity' => 'required|integer',
            'code' => 'required|integer',
            'type' => 'required'
        ]);

        $formFields['user_id'] = auth()->id();

        Material::create($formFields);

        return redirect('/')->with('message', 'Material added succesfully');
    }


    public function edit(Material $material, Request $request)

    {
        // function str_after($subject, $search)
        // {
        //     if ($search == '') {
        //         return $subject;
        //     }
        //     $pos = strpos($subject, $search);
        //     if ($pos === false) {
        //         return $subject;
        //     }
        //     return substr($subject, $pos + strlen($search));
        // }

        // $orderby = str_after(url()->previous(), 'orderby/');

        // if ($orderby) {

        //     return view('index', ['materials' => Material::orderBy($orderby)->filter(request(['search']))->paginate(8), 'editMaterial' => $material]);
        // }

        return view('index', ['materials' => Material::latest()->filter(request(['search']))->paginate(8), 'editMaterial' => $material]);
    }



    public function update(Request $request, Material $material)
    {

        //Make sure logged in user is owner

        if ($material->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }

        $formFields = $request->validate([
            'name' => 'required',
            'quantity' => 'required|integer',
            'code' => 'required|integer',
            'type' => 'required'
        ]);



        $material->update($formFields);

        return redirect('/')->with('message', 'Listing updated successfully');
    }

    public function destroy(Material $material)
    {
        if ($material->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }

        $material->delete();
        return redirect('/')->with('message', 'Material deleted succesfully');
    }
}
