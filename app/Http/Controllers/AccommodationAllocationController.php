<?php

namespace App\Http\Controllers;

use App\Models\Accommodation_allocation;
use App\Http\Requests\StoreAccommodation_allocationRequest;
use App\Http\Requests\UpdateAccommodation_allocationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use function Symfony\Component\Routing\Loader\load;

class AccommodationAllocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $accommodation_allocations = Accommodation_allocation::with('contract.travelAgent.user')->with('accommodation')->get();
        return response($accommodation_allocations, Response::HTTP_OK);

    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAccommodation_allocationRequest $request)
    {
        DB::beginTransaction();
        try {

            $accommodation_allocation = Accommodation_allocation::create($request->validated() + [
                    'added_by' => auth()->user()->id,
                    'status_id' => 1,
                ]);

            DB::commit();
            return response($accommodation_allocation->load('contract.travelAgent.user')->load('accommodation'), Response::HTTP_CREATED);

        } catch (\Exception $e) {
            return \response(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Accommodation_allocation $accommodation_allocation)
    {
        return response($accommodation_allocation->load('contract.travelAgent.user')->load('accommodation'), Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAccommodation_allocationRequest $request, Accommodation_allocation $accommodation_allocation)
    {
        DB::beginTransaction();
        try {

            $accommodation_allocation->update($request->validated() + [
                    'updated_by' => auth()->user()->id,
                    'status_id' => 1,
                ]);

            DB::commit();
            return response($accommodation_allocation->load('contract.travelAgent.user')->load('accommodation'), Response::HTTP_CREATED);

        } catch (\Exception $e) {
            return \response(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Accommodation_allocation $accommodation_allocation)
    {
        $accommodation_allocation->delete();
        return response(Response::HTTP_NO_CONTENT);
    }

    public function search(Request $request)
    {

        $accommodation_allocation = Accommodation_allocation::orderBy('created_at', 'desc');
        $query = $request->search;

        if ($request->filled('search')) {
            $accommodation_allocation->where(function ($p) use ($query) {
                $p->where("start_date", "like", "%" . $query . "%")
                    ->orWhere('end_date', 'like', "%$query%")
                    ->orWhereHas('accommodation', function ($q) use ($query) {
                        $q->where('country', 'like', "%$query%")
                            ->orWhere('city', 'like', "%$query%");
                    })->orWhereHas('contract', function ($q) use ($query) {
                        $q->where('contract_number', 'like', "%$query%")
                            ->orWhere('standard_rate', 'like', "%$query%")
                            ->orWhere('start_date', 'like', "%$query%")
                            ->orWhere('end_date', 'like', "%$query%");
                    });
            });
        }

        return response($accommodation_allocation->with('contract.travelAgent.user')->with('accommodation')->get(), Response::HTTP_OK);
    }
}
