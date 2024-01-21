<?php

namespace App\Http\Controllers;

use App\Models\TravelAgent;
use App\Http\Requests\StoreTravelAgentRequest;
use App\Http\Requests\UpdateTravelAgentRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class TravelAgentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $travel_agents = TravelAgent::with('user')->get();
        return response($travel_agents, Response::HTTP_OK);

    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTravelAgentRequest $request)
    {

        DB::beginTransaction();
        try {

            $travelAgent = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => $request->password,
            ])->travelAgent()->create([
                'experience' => $request->experience,
                'about_me' => $request->about_me,
                'profile_photo' => $request->profile_photo,
                'status_id' => 1,
            ]);

            DB::commit();
            return response($travelAgent->load('user'), Response::HTTP_CREATED);

        } catch (\Exception $e) {
            return \response(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(TravelAgent $travelAgent)
    {
       return response($travelAgent->load('user'),Response::HTTP_OK);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTravelAgentRequest $request, TravelAgent $travelAgent)
    {
        DB::beginTransaction();
        try {

            $travelAgent->user()->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
            ]);

            $travelAgent->update([
                'experience' => $request->experience,
                'about_me' => $request->about_me,
                'profile_photo' => $request->profile_photo,
            ]);

            DB::commit();
            return response($travelAgent->load('user'), Response::HTTP_CREATED);

        } catch (\Exception $e) {
            return \response(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TravelAgent $travelAgent)
    {
        $travelAgent->user()->delete();
        $travelAgent->delete();
        return response(Response::HTTP_NO_CONTENT);
    }
}
