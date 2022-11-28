<?php

namespace App\Http\Controllers\Api\V1;

use App\Candidate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CandidateResource;
use App\Http\Requests\V1\StoreCandidateRequest;
use App\Http\Requests\V1\UpdateCandidateRequest;
use App\Services\V1\CandidateQuery;

class CandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter = new CandidateQuery();
        $queryItems = $filter->transform($request);

        if(count(array($queryItems)) == 0){
            return Candidate::all();
        } else {
            return Candidate::where($queryItems)->get();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCandidateRequest $request)
    {
        $candidate = Candidate::create($request->all());

        if($request->skills){
            $candidate->skills()->createMany($request->skills);
        }

        if($request->cv_file){
            $file = $request->file('cv_file');
            $fileName = time().'.'.$file->extension();
            $filePath = public_path().'/files';

            $file->move($filePath, $fileName);
            
            $candidate->cv_file = $fileName;
            $candidate->save();
        }
        
        return new CandidateResource($candidate);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function show(Candidate $candidate)
    {
        return new CandidateResource($candidate->loadMissing('statuses','skills'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function edit(Candidate $candidate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCandidateRequest $request, Candidate $candidate)
    {
        if($request->skills){
            $candidate->skills()->delete();
            $candidate->skills()->createMany($request->skills);
        }

        $candidate->update($request->all());

        return new CandidateResource($candidate);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Candidate  $candidate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Candidate $candidate)
    {
        //
    }
}
