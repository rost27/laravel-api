<?php

namespace App\Services\V1;

use Illuminate\Http\Request;

class CandidateQuery {

    public function transform(Request $request) {
        $query = [];

        if($request->query("status")){
            $query[] = ['status', '=', $request->query('status')];
        }

        return $query;
    }
    
}