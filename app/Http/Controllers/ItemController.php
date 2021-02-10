<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Carbon;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $all_items = Item::orderBy('created_at', 'DESC')->get();

      if($all_items->count() > 0){
          return $all_items;
      } else {
        return "no items to show";
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
    public function store(Request $request)
    {
        $newItem = new Item;
        $newItem->name = $request->item['name'];
        $newItem->save();

        return $newItem;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $existingItem = Item::find($id);
      if($existingItem) {
        return $existingItem;
      } else {
        return "no item referring to id ".$id;
      }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $existingItem = Item::find($id);
        if($existingItem){
          $existingItem->name = $request->item['name'];
          $existingItem->save();
          return $existingItem;
        } else {
          return "no item referring to id ".$id;
        }

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
        $existingItem = Item::find($id);
        if($existingItem) {
          $existingItem->completed = $request->item['completed'] ?  true : false;
          $existingItem->completed_at = $request->item['completed'] ?  Carbon::now() : null;
          $existingItem->save();
          return $existingItem;
        } else {
          return "Item not found";
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $existingItem = Item::find($id);
        if($existingItem){
          $existingItem->delete();
          return "Item deleted";
        } else {
          return "Item not found";
        }

    }
}
