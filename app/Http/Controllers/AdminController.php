<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\JenisTraining;
use App\Models\ProfilKaryawan;
use App\Models\TrainingKaryawan;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{
    function index()
    {
        return view('admin.index');
    }

    function profilKaryawan(Request $request)
    {
        if ($request->ajax()) {
            $data = ProfilKaryawan::select('*');

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $editUrl = url('edit_profil_karyawan/' . $row->id_karyawan);
                    $deleteUrl = url('delete_profil_karyawan/' . $row->id_karyawan);

                    $actionBtn = '<a href="' . $editUrl . '" class="edit btn btn-success btn-sm">Edit</a> 
                                <a href="' . $deleteUrl . '" class="delete btn btn-danger btn-sm">Delete</a>';

                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.profilkaryawan.profilKaryawan');
    }

    function input_profil_karyawan()
    {
        return view('admin.profilkaryawan.inputProfilKaryawan');
    }

    function post_profil_karyawan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nip' => 'required',
            'nama' => 'required',
            'jabatan' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->with('errorForm', $validator->errors()->getMessages())
                ->withInput();
        }

        try {
            $kpr = new ProfilKaryawan();
            $kpr->nip = $request->nip;
            $kpr->nama = $request->nama;
            $kpr->jabatan = $request->jabatan;
            $kpr->created_by = Auth::user()->username;
            $kpr->save();

            return redirect('profilKaryawan')
                ->with('success', 'Created successfully!');
        } catch (\Exception $e) {

            return redirect()->back()
                ->with('error', 'Error during the creation!');
        }
    }

    function edit_profil_karyawan($id)
    {
        $data = ProfilKaryawan::find($id);

        return view('admin.profilkaryawan.editProfilKaryawan', compact('data'));
    }

    function update_profil_karyawan(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nip' => 'required',
            'nama' => 'required',
            'jabatan' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->with('errorForm', $validator->errors()->getMessages())
                ->withInput();
        }

        try {
            $kpr = ProfilKaryawan::find($id);
            $kpr->nip = $request->nip;
            $kpr->nama = $request->nama;
            $kpr->jabatan = $request->jabatan;
            $kpr->created_by = Auth::user()->username;
            $kpr->save();

            return redirect('profilKaryawan')
                ->with('success', 'Created successfully!');
        } catch (\Exception $e) {

            return redirect()->back()
                ->with('error', 'Error during the creation!');
        }
    }

    function delete_profil_karyawan($id)
    {
        try {
            ProfilKaryawan::where('id_karyawan', $id)->forceDelete();

            return redirect('profilKaryawan')
                ->with('success', 'Deleted successfully!');
        } catch (\Exception $e) {

            return redirect()->back()
                ->with('error', 'Error during the creation!');
        }
    }

    function jenisTraining(Request $request)
    {
        if ($request->ajax()) {
            $data = JenisTraining::select('*');

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $editUrl = url('edit_jenis_training/' . $row->id_jenis);
                    $deleteUrl = url('delete_jenis_training/' . $row->id_jenis);

                    $actionBtn = '<a href="' . $editUrl . '" class="edit btn btn-success btn-sm">Edit</a> 
                                <a href="' . $deleteUrl . '" class="delete btn btn-danger btn-sm">Delete</a>';

                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.jenistraining.jenisTraining');
    }

    function input_jenis_training()
    {
        return view('admin.jenistraining.inputJenisTraining');
    }

    function post_jenis_training(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jenis' => 'required',
            'keterangan' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->with('errorForm', $validator->errors()->getMessages())
                ->withInput();
        }

        try {
            $kpr = new JenisTraining();
            $kpr->jenis = $request->jenis;
            $kpr->keterangan = $request->keterangan;
            $kpr->created_by = Auth::user()->username;
            $kpr->save();

            return redirect('jenisTraining')
                ->with('success', 'Created successfully!');
        } catch (\Exception $e) {

            return redirect()->back()
                ->with('error', 'Error during the creation!');
        }
    }

    function edit_jenis_training($id)
    {
        $data = JenisTraining::find($id);

        return view('admin.jenistraining.editJenisTraining', compact('data'));
    }

    function update_jenis_training(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'jenis' => 'required',
            'keterangan' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->with('errorForm', $validator->errors()->getMessages())
                ->withInput();
        }

        try {
            $kpr = JenisTraining::find($id);
            $kpr->jenis = $request->jenis;
            $kpr->keterangan = $request->keterangan;
            $kpr->created_by = Auth::user()->username;
            $kpr->save();

            return redirect('jenisTraining')
                ->with('success', 'Created successfully!');
        } catch (\Exception $e) {

            return redirect()->back()
                ->with('error', 'Error during the creation!');
        }
    }

    function delete_jenis_training($id)
    {
        try {
            JenisTraining::where('id_jenis', $id)->forceDelete();

            return redirect('jenisTraining')
                ->with('success', 'Deleted successfully!');
        } catch (\Exception $e) {

            return redirect()->back()
                ->with('error', 'Error during the creation!');
        }
    }

    function trainingKaryawan(Request $request)
    {
        if ($request->ajax()) {
            $data = TrainingKaryawan::join('profil_karyawan', 'training_karyawan.id_karyawan', '=', 'profil_karyawan.id_karyawan')
                ->join('jenis_training', 'training_karyawan.id_jenis', '=', 'jenis_training.id_jenis')
                ->select(
                    'jenis_training.jenis',
                    'training_karyawan.tgl_sertifikat',
                    'profil_karyawan.nip',
                    'training_karyawan.id_training',
                    'profil_karyawan.nama',
                    'jenis_training.id_jenis',
                    'profil_karyawan.id_karyawan'
                )
                ->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $editUrl = url('edit_training_karyawan/' . $row->id_training);
                    $deleteUrl = url('delete_training_karyawan/' . $row->id_training);

                    $actionBtn = '<a href="' . $editUrl . '" class="edit btn btn-success btn-sm">Edit</a> 
                                <a href="' . $deleteUrl . '" class="delete btn btn-danger btn-sm">Delete</a>';

                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.trainingkaryawan.trainingKaryawan');
    }

    function input_training_karyawan()
    {
        $jenis = JenisTraining::all();
        $karyawan = ProfilKaryawan::all();

        return view('admin.trainingkaryawan.inputTrainingKaryawan', compact('jenis', 'karyawan'));
    }

    function post_training_karyawan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_karyawan' => 'required',
            'id_jenis' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->with('errorForm', $validator->errors()->getMessages())
                ->withInput();
        }

        try {
            $kpr = new TrainingKaryawan();
            $kpr->id_karyawan = $request->id_karyawan;
            $kpr->id_jenis = $request->id_jenis;
            $kpr->tgl_sertifikat = $request->tgl_sertifikat;
            $kpr->created_by = Auth::user()->username;
            $kpr->save();

            return redirect('trainingKaryawan')
                ->with('success', 'Created successfully!');
        } catch (\Exception $e) {

            return redirect()->back()
                ->with('error', 'Error during the creation!');
        }
    }

    function edit_training_karyawan($id)
    {
        $data = TrainingKaryawan::join('profil_karyawan', 'training_karyawan.id_karyawan', '=', 'profil_karyawan.id_karyawan')
            ->join('jenis_training', 'training_karyawan.id_jenis', '=', 'jenis_training.id_jenis')
            ->where('training_karyawan.id_training', $id)
            ->select(
                'jenis_training.jenis',
                'training_karyawan.tgl_sertifikat',
                'profil_karyawan.nip',
                'training_karyawan.id_training',
                'profil_karyawan.nama',
                'jenis_training.id_jenis',
                'profil_karyawan.id_karyawan'
            )
            ->first();

        $jenis = JenisTraining::all();
        $karyawan = ProfilKaryawan::all();

        return view('admin.trainingkaryawan.editTrainingKaryawan', compact('data', 'jenis', 'karyawan'));
    }

    function update_training_karyawan(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'id_karyawan' => 'required',
            'id_jenis' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->with('errorForm', $validator->errors()->getMessages())
                ->withInput();
        }

        try {
            $kpr = TrainingKaryawan::find($id);
            $kpr->id_karyawan = $request->id_karyawan;
            $kpr->id_jenis = $request->id_jenis;
            $kpr->tgl_sertifikat = $request->tgl_sertifikat;
            $kpr->created_by = Auth::user()->username;
            $kpr->save();

            return redirect('trainingKaryawan')
                ->with('success', 'Created successfully!');
        } catch (\Exception $e) {

            return redirect()->back()
                ->with('error', 'Error during the creation!');
        }
    }

    function delete_training_karyawan($id)
    {
        try {
            TrainingKaryawan::where('id_training', $id)->forceDelete();

            return redirect('trainingKaryawan')
                ->with('success', 'Deleted successfully!');
        } catch (\Exception $e) {

            return redirect()->back()
                ->with('error', 'Error during the creation!');
        }
    }

    function dataKaryawan(Request $request)
    {
        if ($request->ajax()) {
            $data = ProfilKaryawan::leftjoin('training_karyawan', 'profil_karyawan.id_karyawan', '=', 'training_karyawan.id_karyawan')
                ->join('jenis_training', 'training_karyawan.id_jenis', '=', 'jenis_training.id_jenis')
                ->select(
                    'jenis_training.jenis',
                    'training_karyawan.tgl_sertifikat',
                    'profil_karyawan.nip',
                    'training_karyawan.id_training',
                    'profil_karyawan.nama',
                    'jenis_training.id_jenis',
                    'profil_karyawan.id_karyawan'
                )
                ->get();

            return Datatables::of($data)

                ->make(true);
        }

        $jenis = JenisTraining::all();
        $karyawan = ProfilKaryawan::all();
        $tgl = TrainingKaryawan::groupBy('tgl_sertifikat')->select('tgl_sertifikat')->get();

        return view('admin.datakaryawan.dataKaryawan', compact('jenis', 'karyawan', 'tgl'));
    }

    function cari_data_karyawan(Request $request)
    {
        $idKaryawan = $request->id_karyawan;
        $idJenis = $request->id_jenis;
        $tgl = $request->tgl_sertifikat;

        $data = ProfilKaryawan::leftjoin('training_karyawan', 'profil_karyawan.id_karyawan', '=', 'training_karyawan.id_karyawan')
            ->join('jenis_training', 'training_karyawan.id_jenis', '=', 'jenis_training.id_jenis')
            ->where('profil_karyawan.id_karyawan', $idKaryawan)
            ->where('training_karyawan.id_jenis', $idJenis)
            ->where('training_karyawan.tgl_sertifikat', $tgl)
            ->select(
                'jenis_training.jenis',
                'training_karyawan.tgl_sertifikat',
                'profil_karyawan.nip',
                'training_karyawan.id_training',
                'profil_karyawan.nama',
                'jenis_training.id_jenis',
                'profil_karyawan.id_karyawan'
            )
            ->get();

        $jenis = JenisTraining::all();
        $karyawan = ProfilKaryawan::all();
        $tgl = TrainingKaryawan::groupBy('tgl_sertifikat')->select('tgl_sertifikat')->get();

        return view('admin.datakaryawan.cariDataKaryawan', compact('jenis', 'karyawan', 'tgl', 'data'));
    }
}
