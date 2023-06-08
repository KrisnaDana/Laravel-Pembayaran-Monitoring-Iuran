<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tour;
use App\Models\TourCategory;
use App\Models\TourDestination;
use App\Models\Discount;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Carbon;
class TourController extends Controller
{
    public function viewTours(){
        $tours = Tour::orderBy('name')->get(['id', 'tour_category_id', 'name', 'status', 'discount_id']);
        $now = Carbon::now()->format('Y-m-d H:i:s');
        return view('admin.tour.tours', compact('tours', 'now'));
    }

    public function viewTour($id){
        $tour = Tour::find($id);
        $now = Carbon::now()->format('Y-m-d H:i:s');
        if($tour->discount_id == 0){
            $discount = "-";
        }else{
            if($tour->discount->start <= $now && $now <= $tour->discount->end){
                $discount = $tour->discount->percentage . '% (On)';
            }else{
                $discount = $tour->discount->percentage . '% (Past)';
            }
        }
        $prices = unserialize($tour->prices);
        if(!empty($tour->descriptions)){
            $descriptions = unserialize($tour->descriptions);
        }else{
            $descriptions = [];
        }
        if(!empty($tour->destinations)){
            $destinations = unserialize($tour->destinations);
            $tour_destination = TourDestination::all();
            $temp = [];
            for($i=0; $i<count($destinations); $i++){
                for($j=0; $j<count($tour_destination); $j++){
                    if($destinations[$i] == $tour_destination[$j]['id']){
                        $temp[$i] = $tour_destination[$j]['name'];
                        break;
                    }
                }
            }
            $destinations =  $temp;
        }else{
            $destinations = [];
        }
        if(!empty($tour->itineraries)){
            $itineraries = unserialize($tour->itineraries);
        }else{
            $itineraries = [];
        }
        if(!empty($tour->includes)){
            $includes = unserialize($tour->includes);
        }else{
            $includes = [];
        }
        if(!empty($tour->excludes)){
            $excludes = unserialize($tour->excludes);
        }else{
            $excludes = [];
        }
        if(!empty($tour->brings)){
            $brings = unserialize($tour->brings);
        }else{
            $brings = [];
        }
        if(!empty($tour->tips)){
            $tips = unserialize($tour->tips);
        }else{
            $tips = [];
        }
        if(!empty($tour->notes)){
            $notes = unserialize($tour->notes);
        }else{
            $notes = [];
        }
        if(!empty($tour->galleries)){
            $galleries = unserialize($tour->galleries);
        }else{
            $galleries = [];
        }
        return view('admin.tour.tour', compact('tour', 'discount', 'prices', 'descriptions', 'destinations', 'itineraries', 'includes', 'excludes', 'brings', 'tips', 'notes', 'galleries'));
    }

    public function viewCreateTour(){
        $tour_categories = TourCategory::orderBy('name')->get(['id', 'name']);
        $tour_destinations = TourDestination::orderBy('name')->get(['id', 'name']);
        $now = Carbon::now()->format('Y-m-d H:i:s');
        $discounts = Discount::where('id', '!=', 0)->where('start', '<=', $now)->where('end', '>=', $now)->get(['id', 'percentage', 'start', 'end']);
        $crud = 'create';
        return view('admin.tour.create-tour', compact('tour_categories', 'tour_destinations', 'discounts', 'crud'));
    }

    public function createTour(Request $request){
        $validated = $request->validate([
            'name' => 'string|required|regex:/^[a-zA-Z0-9\s]+$/|min:1|max:50|unique:App\Models\Tour,name',
            'tour_category' => 'required|exists:App\Models\TourCategory,id',
            'status' => 'required|string|in:Active,Inactive',
            'discount' => 'required|exists:App\Models\Discount,id',
            'price_category' => 'required|string|min:1|max:50',
            'price' => 'required|integer',
            'price_categories.*' => 'filled|required_with:prices.*|string|max:50',
            'prices.*' => 'filled|required_with:price_categories.*|integer',
            'descriptions.*' => 'filled|string|max:2000',
            'destinations.*' => 'filled|exists:App\Models\TourDestination,id',
            'galleries.*' => 'filled|file|image|max:4096',
            'itinerary_days.*' => 'filled|required_with:itinerary_times.*,itinerary_activities.*|integer|min:1',
            'itinerary_times.*' => 'filled|required_with:itinerary_days.*,itinerary_activities.*|date_format:H:i',
            'itinerary_activities.*' => 'filled|required_with:itinerary_days.*,itinerary_times.*|string|max:255',
            'includes.*' => 'filled|string|max:100',
            'excludes.*' => 'filled|string|max:100',
            'brings.*' => 'filled|string|max:100',
            'tips.*' => 'filled|string|max:100',
            'notes.*' => 'filled|string|max:100'
        ]);
        $tour = array(
            'name' => $validated['name'],
            'tour_category_id' => $validated['tour_category'],
            'status' => $validated['status'],
            'slug' => Str::slug($validated['name']),
            'discount_id' => $validated['discount']
        );

        if(!empty($validated['prices'])){
            $temp = [];
            array_push($temp, [$validated['price_category'], $validated['price']]);
            for($i=0; $i < count($validated['prices']); $i++){
                array_push($temp, [$validated['price_categories'][$i], $validated['prices'][$i]]);
            }
            $tour['prices'] = serialize($temp);
        }else{
            $temp = [];
            array_push($temp, [$validated['price_category'], $validated['price']]);
            $tour['prices'] = serialize($temp);
        }

        if(!empty($validated['descriptions'])){
            $temp = [];
            for($i=0; $i < count($validated['descriptions']); $i++){
                array_push($temp, $validated['descriptions'][$i]);
            }
            $tour['descriptions'] = serialize($temp);
        }

        if(!empty($validated['destinations'])){
            $temp = [];
            for($i=0; $i < count($validated['destinations']); $i++){
                array_push($temp, $validated['destinations'][$i]);
            }
            $tour['destinations'] = serialize($temp);
        }

        if(!empty($validated['galleries'])){
            $temp = [];
            for($i=0; $i < count($validated['galleries']); $i++){
                $image = $request->file('galleries')[$i];
                $image_name = $tour['slug'] . '-' . $i . '.' . $image->getClientOriginalExtension();
                $path = public_path('/image/tour-galleries');
                $image->move($path, $image_name);
                $tour_destination['image_path'] = $image_name;
                array_push($temp, $image_name);
            }
            $tour['galleries'] = serialize($temp);
        }

        if(!empty($validated['itinerary_days'])){
            $temp = [];
            for($i=0; $i < count($validated['itinerary_days']); $i++){
                array_push($temp, [$validated['itinerary_days'][$i], $validated['itinerary_times'][$i], $validated['itinerary_activities'][$i]]);
            }
            $tour['itineraries'] = serialize($temp);
        }

        if(!empty($validated['includes'])){
            $temp = [];
            for($i=0; $i < count($validated['includes']); $i++){
                array_push($temp, $validated['includes'][$i]);
            }
            $tour['includes'] = serialize($temp);
        }

        if(!empty($validated['excludes'])){
            $temp = [];
            for($i=0; $i < count($validated['excludes']); $i++){
                array_push($temp, $validated['excludes'][$i]);
            }
            $tour['excludes'] = serialize($temp);
        }

        if(!empty($validated['brings'])){
            $temp = [];
            for($i=0; $i < count($validated['brings']); $i++){
                array_push($temp, $validated['brings'][$i]);
            }
            $tour['brings'] = serialize($temp);
        }

        if(!empty($validated['tips'])){
            $temp = [];
            for($i=0; $i < count($validated['tips']); $i++){
                array_push($temp, $validated['tips'][$i]);
            }
            $tour['tips'] = serialize($temp);
        }

        if(!empty($validated['notes'])){
            $temp = [];
            for($i=0; $i < count($validated['notes']); $i++){
                array_push($temp, $validated['notes'][$i]);
            }
            $tour['notes'] = serialize($temp);
        }
        Tour::create($tour);
        return redirect()->route('admin-view-tours')->with(['ok' => 'Tour successfully created']);
    }
    
    public function viewEditTour($id){
        $tour = Tour::find($id);
        $tour_categories = TourCategory::orderBy('name')->get(['id', 'name']);
        $tour_destinations = TourDestination::orderBy('name')->get(['id', 'name']);
        $now = Carbon::now()->format('Y-m-d H:i:s');
        $discounts = Discount::where('id', '!=', 0)->where('start', '<=', $now)->where('end', '>=', $now)->get(['id', 'percentage', 'start', 'end']);
        $crud = 'edit';
        if($tour->discount_id == 0){
            $tour_discount = "-";
        }else{
            if($tour->discount->start <= $now && $now <= $tour->discount->end){
                $tour_discount = $tour->discount->percentage . '% (On)';
            }else{
                $tour_discount = $tour->discount->percentage . '% (Past)';
            }
        }
        $prices = unserialize($tour->prices);
        if(!empty($tour->descriptions)){
            $descriptions = unserialize($tour->descriptions);
        }else{
            $descriptions = [];
        }
        if(!empty($tour->destinations)){
            $destinations = unserialize($tour->destinations);
        }else{
            $destinations = [];
        }
        if(!empty($tour->itineraries)){
            $itineraries = unserialize($tour->itineraries);
        }else{
            $itineraries = [];
        }
        if(!empty($tour->includes)){
            $includes = unserialize($tour->includes);
        }else{
            $includes = [];
        }
        if(!empty($tour->excludes)){
            $excludes = unserialize($tour->excludes);
        }else{
            $excludes = [];
        }
        if(!empty($tour->brings)){
            $brings = unserialize($tour->brings);
        }else{
            $brings = [];
        }
        if(!empty($tour->tips)){
            $tips = unserialize($tour->tips);
        }else{
            $tips = [];
        }
        if(!empty($tour->notes)){
            $notes = unserialize($tour->notes);
        }else{
            $notes = [];
        }
        if(!empty($tour->galleries)){
            $galleries = unserialize($tour->galleries);
        }else{
            $galleries = [];
        }
        return view('admin.tour.edit-tour', compact('tour', 'tour_categories', 'tour_destinations', 'now', 'discounts', 'crud', 'tour_discount', 'prices', 'descriptions', 'destinations', 'itineraries', 'includes', 'excludes', 'brings', 'tips', 'notes', 'galleries'));
    }

    public function editTour($id, Request $request){
        $validated = $request->validate([
            'name' => 'string|required|regex:/^[a-zA-Z0-9\s]+$/|min:1|max:50|unique:App\Models\Tour,name,'.$id,
            'tour_category' => 'required|exists:App\Models\TourCategory,id',
            'status' => 'required|string|in:Active,Inactive',
            'discount' => 'required|exists:App\Models\Discount,id',
            'price_category' => 'required|string|min:1|max:50',
            'price' => 'required|integer',
            'price_categories.*' => 'filled|required_with:prices.*|string|max:50',
            'prices.*' => 'filled|required_with:price_categories.*|integer',
            'descriptions.*' => 'filled|string|max:2000',
            'destinations.*' => 'filled|exists:App\Models\TourDestination,id',
            'itinerary_days.*' => 'filled|required_with:itinerary_times.*,itinerary_activities.*|integer|min:1',
            'itinerary_times.*' => 'filled|required_with:itinerary_days.*,itinerary_activities.*|date_format:H:i',
            'itinerary_activities.*' => 'filled|required_with:itinerary_days.*,itinerary_times.*|string|max:255',
            'includes.*' => 'filled|string|max:100',
            'excludes.*' => 'filled|string|max:100',
            'brings.*' => 'filled|string|max:100',
            'tips.*' => 'filled|string|max:100',
            'notes.*' => 'filled|string|max:100',
            'galleries.*' => 'filled|file|image|max:4096',
        ]);

        $tour = Tour::find($id);
        $tour->name = $validated['name'];
        $tour->tour_category_id = $validated['tour_category'];
        $tour->status = $validated['status'];
        $tour->slug = Str::slug($validated['name']);
        $tour->discount_id = $validated['discount'];

        if(!empty($validated['prices'])){
            $temp = [];
            array_push($temp, [$validated['price_category'], $validated['price']]);
            for($i=0; $i < count($validated['prices']); $i++){
                array_push($temp, [$validated['price_categories'][$i], $validated['prices'][$i]]);
            }
            $tour->prices = serialize($temp);
        }else{
            $temp = [];
            array_push($temp, [$validated['price_category'], $validated['price']]);
            $tour->prices = serialize($temp);
        }

        if(!empty($validated['descriptions'])){
            $temp = [];
            for($i=0; $i < count($validated['descriptions']); $i++){
                array_push($temp, $validated['descriptions'][$i]);
            }
            $tour->descriptions = serialize($temp);
        }else{
            $tour->descriptions = null;
        }

        if(!empty($validated['destinations'])){
            $temp = [];
            for($i=0; $i < count($validated['destinations']); $i++){
                array_push($temp, $validated['destinations'][$i]);
            }
            $tour->destinations = serialize($temp);
        }else{
            $tour->destinations = null;
        }

        if(!empty($validated['itinerary_days'])){
            $temp = [];
            for($i=0; $i < count($validated['itinerary_days']); $i++){
                array_push($temp, [$validated['itinerary_days'][$i], $validated['itinerary_times'][$i], $validated['itinerary_activities'][$i]]);
            }
            $tour->itineraries = serialize($temp);
        }else{
            $tour->itineraries = null;
        }

        if(!empty($validated['includes'])){
            $temp = [];
            for($i=0; $i < count($validated['includes']); $i++){
                array_push($temp, $validated['includes'][$i]);
            }
            $tour->includes = serialize($temp);
        }else{
            $tour->includes = null;
        }

        if(!empty($validated['excludes'])){
            $temp = [];
            for($i=0; $i < count($validated['excludes']); $i++){
                array_push($temp, $validated['excludes'][$i]);
            }
            $tour->excludes = serialize($temp);
        }else{
            $tour->excludes = null;
        }

        if(!empty($validated['brings'])){
            $temp = [];
            for($i=0; $i < count($validated['brings']); $i++){
                array_push($temp, $validated['brings'][$i]);
            }
            $tour->brings = serialize($temp);
        }else{
            $tour->brings = null;
        }

        if(!empty($validated['tips'])){
            $temp = [];
            for($i=0; $i < count($validated['tips']); $i++){
                array_push($temp, $validated['tips'][$i]);
            }
            $tour->tips = serialize($temp);
        }else{
            $tour->tips = null;
        }

        if(!empty($validated['notes'])){
            $temp = [];
            for($i=0; $i < count($validated['notes']); $i++){
                array_push($temp, $validated['notes'][$i]);
            }
            $tour->notes = serialize($temp);
        }else{
            $tour->notes = null;
        }

        if($request->galleries_counter > 0){
            $temp = unserialize($tour->galleries);
            if(count($temp) > $request->galleries_counter){
                $path = public_path('/image/tour-galleries');
                for($i = count($temp)-1; $i>=$request->galleries_counter ; $i--){
                    File::delete($path.'/'.$temp[$i]);
                    array_splice($temp, $i, 1);
                }
            }
            if(!empty($validated['galleries'])){
                for($i=0; $i < count($validated['galleries']); $i++){
                    $image = $request->file('galleries')[$i];
                    $image_name = $tour['slug'] . '-' . $i+count($temp) . '.' . $image->getClientOriginalExtension();
                    $path = public_path('/image/tour-galleries');
                    $image->move($path, $image_name);
                    $tour_destination['image_path'] = $image_name;
                    array_push($temp, $image_name);
                }
            }
            $tour->galleries = serialize($temp);
        }else{
            if(!empty($validated['galleries'])){
                $temp = [];
                for($i=0; $i < count($validated['galleries']); $i++){
                    $image = $request->file('galleries')[$i];
                    $image_name = $tour['slug'] . '-' . $i . '.' . $image->getClientOriginalExtension();
                    $path = public_path('/image/tour-galleries');
                    $image->move($path, $image_name);
                    $tour_destination['image_path'] = $image_name;
                    array_push($temp, $image_name);
                }
                $tour->galleries = serialize($temp);
            }else{
                $tour->galleries = null;
            }
        }
        $tour->save();
        return redirect()->back()->with(['ok' => 'Tour successfully edited.']);
    }

    public function deleteTour($id){
        $tour = Tour::find($id);
        if(!empty($tour->galleries)){
            $galleries = unserialize($tour->galleries);
            $path = public_path('/image/tour-galleries');
            for($i=0; $i < count($galleries); $i++){
                File::delete($path.'/'.$galleries[$i]);
            }
        }
        $tour->delete();
        return redirect()->route('admin-view-tours')->with(['ok' => 'Tour successfully deleted']);
    }
}
