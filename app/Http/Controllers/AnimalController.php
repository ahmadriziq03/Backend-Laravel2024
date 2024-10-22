<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AnimalController extends Controller
{
    private $animals = ['kucing', 'ayam', 'ikan'];

    public function index()
    {
        return response()->json([
            'status' => 'success',
            'data' => $this->animals
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'animal' => 'required|string'
        ]);

        $newAnimal = $request->input('animal');
        array_push($this->animals, $newAnimal);
        
        return response()->json([
            'status' => 'success',
            'message' => 'Hewan berhasil ditambahkan',
            'data' => $this->animals
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'animal' => 'required|string'
        ]);

        if (isset($this->animals[$id])) {
            $this->animals[$id] = $request->input('animal');

            return response()->json([
                'status' => 'success',
                'message' => 'Data hewan berhasil diupdate',
                'data' => $this->animals
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => "Data hewan dengan ID $id tidak ditemukan"
            ], 404);
        }
    }

    public function destroy($id)
    {
        if (isset($this->animals[$id])) {
            // Menghapus hewan dari array
            unset($this->animals[$id]);

            return response()->json([
                'status' => 'success',
                'message' => 'Data hewan berhasil dihapus',
                'data' => array_values($this->animals)
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => "Data hewan dengan ID $id tidak ditemukan"
            ], 404);
        }
    }
}