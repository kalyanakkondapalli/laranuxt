<?php

namespace App\Http\Controllers\Api;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Repository\User\UserContract;
use App\Http\Requests\Skill\SkillRequest;

class SkillController extends Controller
{
    private UserContract $userContract;

    /**
     * @param  Request  $request
     * @param  UserContract  $userContract
     */
    public function __construct(Request $request, UserContract $userContract)
    {
        parent::__construct($request);
        $this->userContract = $userContract;
    }

    /**
     * @param  int  $id
     * @param  SkillRequest  $request
     * @return JsonResponse|mixed
     */
    public function update(int $id, SkillRequest $request): mixed
    {
        try {
            return $this->successResponse([
                'message' => 'Skills Added Successfully',
                'data'    => $this->userContract->update($id, $request->only(['skills'])),
            ]);
        } catch (Exception $e) {
            return $this->errorMessage($e);
        }
    }
}
