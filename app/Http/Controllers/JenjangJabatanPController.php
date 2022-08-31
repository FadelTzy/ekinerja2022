<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JabatanP;
use App\Models\JenjangJabatanP;
use Illuminate\Support\Facades\Validator;


class JenjangJabatanPController extends Controller
{
    public function index()
    {
        $jabatan = JabatanP::all();
        if (request()->ajax()) {
            return datatables()->of(JenjangJabatanP::with('jabatan')->get())->addIndexColumn()->addColumn('aksi', function ($data) {
                $dataj = json_encode($data);
                $btn = "       <ul class='list-inline table-action m-0'>";
                $btn .= "<li class='list-inline-item'>
                    <a href='javascript:void(0);' onclick='updatej(" . $dataj . ")' class='action-icon'> <i class='mdi mdi-square-edit-outline'></i></a>
                </li>";
                $btn .= '
                <li class="list-inline-item">
                    <a href="javascript:void(0);" onclick="deletej(' . $data->id . ')" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                </li>
            </ul>';
                return $btn;
            })->addColumn('nama', function ($data) {
                $btn = $data->jabatan->jabatan;
                return $btn;
            })->addColumn('range', function ($data) {
                if ($data->level_min) {
                    # code...
                    $btn = $data->level_min . ' - ' . $data->level_max;
                } else {
                    $btn =  $data->level_max;
                }
                return $btn;
            })->rawColumns(['aksi', 'nama', 'range'])->make(true);
        }
        return view('admin.jenjangj.index', compact('jabatan'));
    }
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'jabatan' => 'required|min:1|max:100',
                'jenjang' => 'required|min:1|max:100',

            ]);
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()]);
            } else {
                $saved = JenjangJabatanP::create([
                    'id_jabatan' => $request->jabatan,
                    'jenjang' => $request->jenjang,
                    'level_max' => $request->max ?? null,
                    'level_min' => $request->min ?? null,

                ]);

                if ($saved) {
                    return response()->json(['success' => 'Data Berhasil Terupload']);
                }
            }
        } catch (\Throwable $th) {
            return $th;
        }
    }
    public function destroy($id)
    {
        $data = JabatanP::findorfail($id);

        if ($data) {
            $data->delete();
            JenjangJabatanP::where('id_jabatan', $id)->delete();
            return 'success';
        }
        return 'error';
    }
    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'jabatan' => 'required|min:1|max:100',
            ]);
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()]);
            } else {
                $saved = JabatanP::where('id', $id)->update([
                    'jabatan' => $request->jabatan,
                ]);

                if ($saved) {
                    return response()->json(['success' => 'Data Berhasil Terupload']);
                }
            }
        } catch (\Throwable $th) {
            return $th;
        }
    }
}
