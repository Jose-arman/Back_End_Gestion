<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\solicitudes;

class SolicitudesController extends Controller
{
    public function updateSolicitud(Request $request, $id)
    
        {
            $solicitud = solicitudes::find($id);
    
            if (!$solicitud) {
                return response()->json(['message' => 'solicitud no encontrado'], 404);
            }
    
            $solicitud->update($request->all());
    
            return response()->json(['message' => 'solicitud actualizado con éxito']);
        }
    

    public function getSolicitud()
    {
       $solicitud = solicitudes::all();
        return response()->json(solicitudes::all(), 200);
    }

    public function deleteSolicitudById($id)
    {
        $solicitud = solicitudes::find($id);
        if (is_null ( $solicitud)) {
            return response()->json(['message' => 'Solicitud no encontrada'], 404);
        }
        $solicitud->delete();
        return response()->json(['message' => 'Solicitud eliminada exitosamente'], 200);
    }

    public function nuevasolicitud(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'NUE' => 'required', // Asegura que NUE sea único en la tabla
            'ruta_archivo' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $solicitud = solicitudes::create($request->all());
        return response()->json(['message' => 'solicitud agregado exitosamente'], 200);
    }

    

}
