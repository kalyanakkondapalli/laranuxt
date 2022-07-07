<?php

namespace App\Repository\Company;

interface CompanyContract
{
    /**
     * @param  int  $id
     * @param  array  $relations
     * @return mixed
     */
    public function find(int $id, array $relations = []);

    /**
     * @param  array  $relations
     * @return mixed
     */
    public function first(array $relations = []);

    /**
     * @param  int  $id
     * @param  array  $data
     * @return mixed
     */
    public function update(int $id, array $data);
}