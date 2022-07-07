<?php

namespace App\Repository\Company;

use App\Models\Company;

class CompanyRepository implements CompanyContract
{
    private Company $company;

    /**
     * @param  Company  $company
     */
    public function __construct(Company $company)
    {
        $this->company = $company;
    }

    public function update(int $id, array $data)
    {
        $company = $this->find($id);
        return tap($company)->update($data);
    }

    /**
     * @inheritDoc
     */
    public function find(int $id, array $relations = [])
    {
        return $this->company->with($relations)->find($id);
    }

    /**
     * @inheritDoc
     */
    public function first(array $relations = [])
    {
        return $this->company->with($relations)->first();
    }
}
