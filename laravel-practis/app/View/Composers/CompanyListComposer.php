<?php

namespace App\View\Composers;

use App\Models\Company;
use Illuminate\View\View;

class CompanyListComposer
{
    private Company $company;

    public function __construct(Company $company)
    {
        $this->company = $company;
    }

    /**
     * Bind data to the view.
     */
    public function compose(View $view)
    {
        $view->with('companies', $this->company::pluck('name', 'id'));
    }
}
