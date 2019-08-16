<?php

namespace App\Http\Controllers;

use App\Search;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Log;

class SearchesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     ** @param  Search  $search
     * @return Response
     */
    public function find(Search $search)
    {
        request()->validate([
            'criteria' => 'required|min:2|max:255',
        ]);

        $data = array(
            'type' => 'adinterest',
            'q' => request('criteria'),
            'limit' => request('limit', 100),
            'locale' => request('locale', 'en_US'),
            'access_token' => config('app.token'),
        );

        $url = "https://graph.facebook.com/search" . '?' . http_build_query( $data );
        $interests = json_decode(file_get_contents($url));
        request('user_id', Auth::user()->id);
        $search->saveSearch(request()->all());

        return view('home', ['results' => $interests, 'request' => request()->all()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Search  $search
     * @return \Illuminate\Http\Response
     */
    public function show(Search $search)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Search  $search
     * @return \Illuminate\Http\Response
     */
    public function edit(Search $search)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Search  $search
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Search $search)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Search  $search
     * @return \Illuminate\Http\Response
     */
    public function destroy(Search $search)
    {
        //
    }
}
