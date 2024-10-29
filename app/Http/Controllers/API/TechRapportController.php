<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\TechRapport;
use App\Models\TechRapportPhoto;
use App\Http\Requests\TechRapportRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class TechRapportController extends Controller
{

    public function addRapportImage(Request $request, $id)
    {
        // Vérifier si des fichiers 'image' ont été envoyés
        if (!$request->hasFile('image')) {
            return response()->json(['error' => 'No images provided'], 400);
        }
    
        $savedImages = [];
    
        // Récupérer tous les fichiers envoyés avec le champ 'image[]'
        $files = $request->file('image');
        
        // Vérifier si plusieurs fichiers ou un seul fichier
        if (!is_array($files)) {
            $files = [$files]; // Convertir en tableau si un seul fichier est envoyé
        }
 
        foreach ($files as $file) {

            $validator = Validator::make(['file' => $file], [
                'file' => [
                    'required',
                    'file', // Assure-toi que c'est bien un fichier
                    'mimes:jpeg,png,jpg,gif,pdf', // Spécifie les types MIME autorisés pour les images
                    'max:200000', // Taille maximale en kilooctets (200 Mo ici)
                ],
            ]);
    
            // Si la validation échoue, on ignore le fichier ou on retourne une erreur
            if ($validator->fails()) {
                return response()->json(['error' => 'Invalid image file'], 400);
            }
            // Générer un nom unique pour chaque fichier
            $name = time() . '_' . $file->getClientOriginalName();
            $folder = "Image/$id"; // Chemin relatif dans le storage
            // $path = Storage::put($folder, $file); // $file est l'instance du fichier à sauvegarder
            
            
            // Sauvegarder l'image dans le stockage
            Storage::putFileAs($folder, $file, $name);
    
            // Enregistrer l'image dans la base de données
            $data = TechRapportPhoto::create([
                'name' => $name,
                'boitier_id' => $id,
            ]);
    
            $savedImages[] = $data;
        }
    
        return response()->json(['images' => $savedImages]);
    }    

    public function showRapportImage($id)
    {
        $nameList = TechRapportPhoto::where('boitier_id', $id)->get();
    
        $urls = [];
        foreach ($nameList as $name) {
            $url = url("/api/image/{$id}/{$name->name}");
            $urls[] = $url;
        }
    
        return response()->json(['urls' => $urls]);
    }
    
    
    public function serveImage($id, $filename)
    {
        $path = "Image/{$id}/{$filename}";
    
        if (Storage::exists($path)) {
            $file = Storage::get($path);
            $mimeType = Storage::mimeType($path);
    
            return response($file, 200)->header('Content-Type', $mimeType);
        }
    
        abort(404);
    }
    
    public function deleteRapportImage($id, $filename)
    {
        $path = "Image/{$id}/{$filename}";
        if (Storage::exists($path)) {
            Storage::delete($path);
            TechRapportPhoto::where('name', $filename)->delete();
            return response()->json(['message' => 'Image deleted successfully.']);
        }
        abort(404);
    }
    


    public function showRapportList($id){
        return TechRapport::where('user_id', $id)->get();
    }

    public function showRapportPhoto($id){
        return TechRapportPhoto::where('tech_id', $id)->get('name');
        // return path ? or write specific path on react
    }
}