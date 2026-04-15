<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWhatsappRequest;
use App\Http\Requests\UpdateWhatsappRequest;
use App\Http\Resources\WhatsappResource;
use App\Models\Whatsapp;
use Illuminate\Http\Request;
use Throwable;

class WhatsappController extends Controller
{
    public function index()
    {
        try {
            $whatsapps = new Whatsapp();
            return response()->success(WhatsappResource::collection($whatsapps->get()));
        } catch (Throwable $th) {
            return response()->error($th);
        }
    }

    public function store(StoreWhatsappRequest $request)
    {
        try {
            $whatsapp = Whatsapp::create($request->validated());
            return response()->success(new WhatsappResource($whatsapp));
        } catch (Throwable $th) {
            return response()->error($th);
        }
    }

    public function show(Whatsapp $whatsapp)
    {
        try {
            return response()->success(new WhatsappResource($whatsapp));
        } catch (Throwable $th) {
            return response()->error($th);
        }
    }

    public function update(UpdateWhatsappRequest $request, Whatsapp $whatsapp)
    {
        try {
            $whatsapp->update($request->validated());
            return response()->success(new WhatsappResource($whatsapp));
        } catch (Throwable $th) {
            return response()->error($th);
        }
    }
    public function destroy(Whatsapp $whatsapp)
    {
        try {
            $whatsapp->delete();
            return response()->success(new WhatsappResource($whatsapp));
        } catch (Throwable $th) {
            return response()->error($th);
        }
    }
}
