<?php

namespace App\Http\Controllers;

use App\Search;
use Illuminate\Http\Request;
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
     * @return \Illuminate\Http\Response
     */
    public function find(Request $request)
    {
        if( empty($r = $request->all()) ) {
            return view('home');
        }
        $criteria = $r['criteria'];
        $limit = $r['limit'];
        $locale = $r['locale'];
        $token = config('app.token');

        $url = "https://graph.facebook.com/search?type=adinterest&q=[{$criteria}]&limit={$limit}&locale={$locale}&access_token={$token}";
        $interests = json_decode(file_get_contents($url));

        return view('home', ['results' => $interests, 'request' => $r]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
