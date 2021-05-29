<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CompanyController extends Controller
{
    /**
     * Retourne une entreprise en fonction de son ID
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse  {
        return response()->json(Company::with('results')->find($id));
    }

    /**
     * Recherche d'entreprise en fonction des critères donnés
     * @param Request $request
     * @return JsonResponse
     */
    public function search(Request $request): JsonResponse {
        $request->validate([
            'page' => 'integer',
            'column' => 'nullable|string',
            'direction' => ['nullable', 'string', Rule::in(['asc', 'desc'])],
            'name' => 'nullable|string',
            'sector' => 'nullable|string',
            'siren' => 'nullable|string',
        ]);
        $searchQuery = Company::where('name', 'like', $request->get('name').'%');
        if($request->get('sector')){
            $searchQuery->where('sector', $request->get('sector'));
        }
        if($request->get('siren')){
            $searchQuery->where('siren', $request->get('siren'));
        }
        $column = $request->get('column') ?? 'name';
        $direction = $request->get('direction') ?? 'asc';
        return response()->json($searchQuery->orderby($column, $direction)->paginate(15));
    }

    /**
     * Recupération de la liste de tous les secteurs existant sans doublon
     * @return JsonResponse
     */
    public function getSectorList(): JsonResponse {
        return response()->json(Company::select('sector')->distinct()->get());
    }
}
