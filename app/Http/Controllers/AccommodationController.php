<?php

namespace App\Http\Controllers;

use App\Models\Accommodation;
use App\Http\Requests\StoreaccommodationRequest;
use App\Http\Requests\UpdateAccommodationRequest;
use App\Models\Accommodation_allocation;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class AccommodationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $accommodations = Accommodation::all();
        return response($accommodations, Response::HTTP_OK);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreaccommodationRequest $request)
    {
        DB::beginTransaction();
        try {
            $accommodation = Accommodation::create($request->validated() + [
                    'status_id' => 1,
                ]);

            DB::commit();
            return response($accommodation, Response::HTTP_CREATED);

        } catch (\Exception $e) {

            DB::rollBack();
            return response(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Accommodation $accommodation)
    {
        return response($accommodation, Response::HTTP_OK);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAccommodationRequest $request, Accommodation $accommodation)
    {
        DB::beginTransaction();
        try {
            $accommodation->update($request->validated());

            DB::commit();
            return response($accommodation, Response::HTTP_ACCEPTED);

        } catch (\Exception $e) {

            DB::rollBack();
            return response(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Accommodation $accommodation)
    {
        Accommodation_allocation::where('accommodation_id',$accommodation->id)->delete();
        $accommodation->delete();
        return response(Response::HTTP_NO_CONTENT);
    }
}
