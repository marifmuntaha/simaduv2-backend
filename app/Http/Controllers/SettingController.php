<?php

namespace App\Http\Controllers;

use App\Http\Resources\SettingResource;
use App\Models\Setting;
use Exception;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index(Request $request)
    {
        try {
            $setting = new Setting();
            if ($request->has('institutionId')) {
                $setting = $setting->whereInstitutionid($request->institutionId);
            }
            return response([
                'status' => 'success',
                'statusMessage' => '',
                'statusCode' => 200,
                'result' => SettingResource::collection($setting->get())
            ]);
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode()
            ]);
        }
    }

    public function store(Request $request)
    {
        try {
            return ($setting = Setting::create($request->all()))
                ? response([
                    'status' => 'success',
                    'statusMessage' => 'Pengaturan berhasil ditambahkan',
                    'statusCode' => 200,
                    'result' => $setting
                ]) : throw new Exception("Pengaturan gagal ditambahkan");
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode()
            ]);
        }
    }

    public function update(Request $request, Setting $setting)
    {
        try {
            return ($setting->updateOrCreate(array_filter($request->all())))
                ? response([
                    'status' => 'success',
                    'statusMessage' => 'Pengaturan berhasil disimpan',
                    'statusCode' => 200,
                    'result' => $setting
                ]) : throw new Exception("Pengaturan gagal disimpan");
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode()
            ]);
        }
    }
}
