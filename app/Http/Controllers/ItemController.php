<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    //
    public function index()
    {
        return view('item.index', ['items' => Item::all()]);
    }
    public function menu(Request $request)
    {
        $category = $request->query('category');
        $tableNumber = $request->query('table');
        $showModal = !$request->has('table');
        $items = Item::when($category, function ($query) use ($category) {
            $query->where('category', $category);
        })->get();

        $categories = ['Snack', 'Rice', 'Noodle', 'Coffee', 'Non-Coffee'];

        return view('welcome', compact('tableNumber', 'items', 'categories', 'category', 'showModal'));
    }
    public function create()
    {
        return view('item.create');
    }
    public function edit(Request $request, Item $item)
    {
        return view('item.edit', [
            'item'=> $item,
        ]);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'availability' => 'boolean',
        ]);
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }

        Item::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'category' => $validated['category'],
            'image' => $imagePath ?? null,
            'availability' => $validated['availability'] ?? true,
        ]);
        return redirect()->route('item.index')->with('success', 'Item created successfully');
    }
    public function destroy($id)
    {
        $item = Item::find($id);

        if (!$item) {
            return redirect()->route('item.index')->with('error', 'Item not found');
        }

        if ($item->image && Storage::disk('public')->exists($item->image)) {
            Storage::disk('public')->delete($item->image);
        }
        $item->delete();

        return redirect()->route('item.index')->with('success', 'Item deleted successfully');
    }
    public function update(Request $request, $id)
    {
        $item = Item::find($id);
        if (!$item) {
            return response()->json(['message' => 'Item not found'], 404);
        }
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Image is optional during update
            'availability' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            if ($item->image && Storage::disk('public')->exists($item->image)) {
                Storage::disk('public')->delete($item->image);
            }

            $imagePath = $request->file('image')->store('images', 'public');
        }

        $item->name = $validated['name'];
        $item->description = $validated['description'];
        $item->price = $validated['price'];
        $item->category = $validated['category'];
        $item->availability = $validated['availability'] ?? true;
        $item->image = isset($imagePath) ? $imagePath : $item->image;

        $item->save();

        return redirect()->route('item.index')->with('success', 'Item updated successfully');
    }
}
