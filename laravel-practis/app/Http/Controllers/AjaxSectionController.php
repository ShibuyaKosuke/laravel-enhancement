<?php

namespace App\Http\Controllers;

use App\Models\Company;

class AjaxSectionController extends Controller
{
    public function __invoke(Company $company)
    {
        return $company->sections;
    }
}
