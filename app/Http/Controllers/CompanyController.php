<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends Controller
{
    public function getCompanies()
    {
        $companies = Company::with('category')->get();
        return response()->json($companies);
    }

    public function getCompanyById($id)
    {
        $company = Company::with('category')->find($id);

        if (!$company) {
            return response()->json(['error' => 'Company not found'], 404);
        }

        return response()->json($company);
    }

    public function getShiftsByCompany($id)
    {
        $shifts = Shift::where('company_id', $id)
            ->where('start_date', '>', Carbon::now()) // Turnos futuros
            ->get();

        return response()->json($shifts);
    }

}

