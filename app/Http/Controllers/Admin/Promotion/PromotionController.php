<?php

namespace App\Http\Controllers\Admin\Promotion;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Promotion\StoreRequest;
use App\Http\Requests\Admin\Promotion\UpdateRequest;
use App\Http\Resources\Promotion\PromotionResource;
use App\Mail\Promotion\PromotionMail;
use App\Models\Promotion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $promotions = Promotion::all();
        return PromotionResource::collection($promotions);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $users = User::all();
        $data = $request->validated();
        $data['image'] = Storage::disk('public')->put('/promotions', $data['image']);
        Promotion::firstOrCreate($data);
        foreach ($users as $user) {
            Mail::to($user->email)->send(new PromotionMail($data['title'], $user->name));
        }
        return response(['message' => 'Promotion created successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Promotion $promotion)
    {
        return new PromotionResource($promotion);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Promotion $promotion)
    {
        $data = $request->validated();
        if (isset($data['image'])) {
            Storage::disk('public')->delete($promotion->image);
            $data['image'] = Storage::disk('public')->put('/promotions', $data['image']);
        }
        $promotion->update($data);
        return response(['message' => 'Promotion updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Promotion $promotion)
    {
        $promotion->delete();
        return response(['message' => 'Promotion deleted successfully.']);
    }
}
