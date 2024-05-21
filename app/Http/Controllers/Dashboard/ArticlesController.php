<?php

namespace App\Http\Controllers;
// require_once('ripcord.php');
use Illuminate\Http\Request;
use App\Models\HubRealstateProperty;
use App\Models\Location;
use App\Models\Compound;
use App\Models\Developer;
use App\Models\Test;
use App\Models\Property;
use App\Models\PropertyImage;
use Illuminate\Support\Facades\DB;
// use ;
use Ripcord\Providers\Laravel\Ripcord;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

     $url = "http://54.38.78.217:8069";
        // $db = "website_demo";
        // $username = "admin";
        // $password = "ABC_123";
        // config('ripcord.url'); 
    //    require_once('ripcord/ripcord.php');
       $client = Ripcord::client(config('ripcord.server_url'), config('ripcord.database'), config('ripcord.username'), config('ripcord.password'));

        $common = ripcord::client("$url/xmlrpc/2/common");
        $common->version();
        $uid = $common->authenticate($db, $username, $password, array());
        $models = ripcord::client("$url/xmlrpc/2/object");

        $image = $models->execute_kw($db, $uid, $password, 'hub.realstate.images', 'search_read', array(array(array('id', '=', 87))), array('fields'=>array('image')));




    return response()->json([
        'message' => 'success',
        'data' => $image,
    ], 200);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}