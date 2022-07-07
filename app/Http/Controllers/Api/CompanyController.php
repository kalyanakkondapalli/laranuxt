<?php

namespace App\Http\Controllers\Api;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Repository\Company\CompanyContract;
use App\Http\Requests\Company\CompanyRequest;

class CompanyController extends Controller
{
    private CompanyContract $companyContract;

    /**
     * @param  Request  $request
     * @param  CompanyContract  $companyContract
     */
    public function __construct(Request $request, CompanyContract $companyContract)
    {
        parent::__construct($request);
        $this->companyContract = $companyContract;
    }

    /**
     * @return JsonResponse|mixed
     */
    public function show(): mixed
    {
        try {
            return $this->successResponse([
                'message' => 'Company details fetched successfully',
                'data'    => $this->companyContract->first(),
            ]);
        } catch (Exception $e) {
            return $this->errorMessage($e);
        }
    }

    /**
     * @param  int  $id
     * @param  CompanyRequest  $request
     * @return JsonResponse|mixed
     */
    public function update(int $id, CompanyRequest $request): mixed
    {
        try {
            return $this->successResponse([
                'message' => 'Company updated successfully',
                'data'    => $this->companyContract->update($id, $request->only([
                    'company_name', 'role', 'job_nature', 'start_date', 'end_date', 'is_current_working', 'user_id'
                ])),
            ]);
        } catch (Exception $e) {
            return $this->errorMessage($e);
        }
    }
}
