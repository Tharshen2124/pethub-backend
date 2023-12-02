<?php

namespace App\Http\Controllers\api\V1;

use App\Models\Pet;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePetRequest;
use App\Http\Requests\UpdatePetRequest;

class PetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pets = auth('sanctum')->user()->pets()->get();
        
        return response()->json([
            'pets' => $pets
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePetRequest $request)
    {
        $request->validated();

        Pet::create([
            'pet_name' => $request->pet_name,
            'species' => $request->species, 
            'breed' => $request->breed,
            'description' => $request->description,
            'age' => $request->age,
            'image' => $request->image,
        ]);

        return response()->json([
            'message' => "Success!",
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Pet $pet)
    {
       $Pet = Pet::findorFail($pet);

       return response()->json([
        'pet' => $Pet
       ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePetRequest $request, Pet $pet)
    {
        $request->validated();

        $pet->update([
            'pet_name' => $request->pet_name,
            'species' => $request->species, 
            'breed' => $request->breed,
            'description' => $request->description,
            'age' => $request->age,
            'image' => $request->image,
        ]);

        return response()->json([
            'message' => "Success!",
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pet $pet)
    {
        $pet->delete();

        return response()->json([
            'message' => 'Successfully deleted pet',
        ]);
    }
}
