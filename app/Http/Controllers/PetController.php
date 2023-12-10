<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use Illuminate\Http\Request;

class PetController extends Controller
{
    //
    public function saveAddPets(Request $request, $id){
        $pet = new Pet();

        $pet->pet_name = $request->pet_name;
        $pet->pet_type = $request->pet_type;
        $pet->pet_ras = $request->pet_ras;
        $pet->pet_color = $request->pet_color;
        $pet->date_of_birth = $request->date_of_birth;
        $pet->pet_gender = $pet->pet_gender;

        $pet->save();

        return redirect('/customer/list/edit/'.'/'.$id);
    }

    public function saveEditPets(Request $request, $id){
        $pet = Pet::find($id);

        $pet->pet_name = $request->pet_name;
        $pet->pet_type = $request->pet_type;
        $pet->pet_ras = $request->pet_ras;
        $pet->pet_color = $request->pet_color;
        $pet->date_of_birth = $request->date_of_birth;
        $pet->pet_gender = $pet->pet_gender;

        $pet->update();

        return redirect('/customer/list/edit'.'/'.$pet->customer_id);
    }

    public function deletePets(Request $request, $id){
        $pet = Pet::find($id);
        $petCustId = $pet->customer_id;
        $pet->delete();

        return redirect('/customer/list/edit'.'/'.$petCustId);
    }   
}
