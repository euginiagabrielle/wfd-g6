<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use App\Models\Item;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    //
 public function index()
    {
        $discounts = Discount::with('item')->get();

        return view('discount.index', compact('discounts'));
    }
    public function create()
    {
        return view('discount.create', ['items' => Item::all()]);
    }
    public function edit(Request $request, Discount $discount)
    {
        return view('discount.edit', ['discount' => $discount, 'items' => Item::all()]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'value' => 'required|integer|min:1|max:100',
            'item_id' => 'required|exists:items,id',
            'minimum' => 'required|numeric|min:0',
        ]);

        Discount::create([
            'name' => $request->name,
            'value' => $request->value,
            'item_id' => $request->item_id,
            'minimum' => $request->minimum,
        ]);

        return redirect()->route('discount.index')->with('success', 'Discount created successfully!');
    }

    public function destroy($id)
    {
        $discount = Discount::findOrFail($id);

        $discount->delete();

        return redirect()->route('discount.index')->with('success', 'Discount deleted successfully!');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'value' => 'required|integer|min:1|max:100',
            'item_id' => 'required|exists:items,id',
            'minimum' => 'required|numeric|min:0',
        ]);

        $discount = Discount::findOrFail($id);

        $discount->update([
            'name' => $request->name,
            'value' => $request->value,
            'item_id' => $request->item_id,
            'minimum' => $request->minimum,
        ]);

        return redirect()->route('discount.index')->with('success', 'Discount updated successfully!');
    }
}
