<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $employees = Employee::select(['id', 'nama', 'tanggal_lahir', 'alamat', 'foto', 'status_perkawinan']);
            return DataTables::of($employees)
                ->addColumn('action', function ($employee) {
                    return view('employees._action', compact('employee'));
                })
                ->editColumn('foto', function ($employee) {
                    return '<img src="'.asset('storage/' . $employee->foto).'" width="50" height="50">';
                })
                ->editColumn('status_perkawinan', function ($employee) {
                    return $employee->status_perkawinan ? 'Married' : 'Single';
                })
                ->rawColumns(['action', 'foto'])
                ->make(true);
        }
        return view('employees.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('employees.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status_perkawinan' => 'required|boolean',
        ]);

        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('photos', 'public');
        } else {
            $fotoPath = null;
        }

        Employee::create([
            'nama' => $request->nama,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'foto' => $fotoPath,
            'status_perkawinan' => $request->status_perkawinan,
        ]);

        return response()->json(['success' => 'Employee created successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $employee = Employee::findOrFail($id);
        return response()->json($employee);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama'              => 'required|string|max:255',
            'tanggal_lahir'     => 'required|date',
            'alamat'            => 'required|string|max:255',
            'foto'              => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status_perkawinan' => 'required|boolean',
        ]);

        $employee = Employee::findOrFail($id);

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($employee->foto) {
                Storage::disk('public')->delete($employee->foto);
            }
            $fotoPath = $request->file('foto')->store('photos', 'public');
        } else {
            $fotoPath = $employee->foto;
        }

        $employee->update([
            'nama'              => $request->nama,
            'tanggal_lahir'     => $request->tanggal_lahir,
            'alamat'            => $request->alamat,
            'foto'              => $fotoPath,
            'status_perkawinan' => $request->status_perkawinan,
        ]);

        return response()->json(['success' => 'Employee updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        try {
            // $employee = Employee::findOrFail($id);
            $employee->delete();
            return response()->json(['success' => 'Data telah dihapus.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Tidak dapat menghapus data.'], 500);
        }
    }
}
