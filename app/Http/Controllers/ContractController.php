<?php

namespace App\Http\Controllers;

use App\Models\Accommodation_allocation;
use App\Models\Contract;
use App\Http\Requests\StoreContractRequest;
use App\Http\Requests\UpdateContractRequest;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contracts = Contract::with('travelAgent.user')->with('status')->get();
        return response($contracts, Response::HTTP_OK);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreContractRequest $request)
    {
        DB::beginTransaction();
        try {

            $contract = Contract::create($request->validated()+[
                    'end_date' => $request->end_date,
                    'added_by' => auth()->user()->id,
                    'status_id' => 1,
                ]);

            DB::commit();
            return response($contract->load('travelAgent.user'), Response::HTTP_CREATED);

        } catch (\Exception $e) {
            return \response(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Contract $contract)
    {
        return response($contract->load('travelAgent.user')->load('status'),Response::HTTP_OK);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContractRequest $request, Contract $contract)
    {
        DB::beginTransaction();
        try {

            $contract->update($request->validated()+[
                    'end_date' => $request->end_date,
                    'updated_by' => auth()->user()->id,
                    'status_id' => 1,
                ]);

            DB::commit();
            return response($contract->load('travelAgent.user'), Response::HTTP_CREATED);

        } catch (\Exception $e) {
            return \response(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contract $contract)
    {
        Accommodation_allocation::where('contract_id',$contract->id)->delete();
        $contract->travelAgent->user()->delete();
        $contract->travelAgent()->delete();
        $contract->delete();
        return response(Response::HTTP_NO_CONTENT);
    }
}
