<?php

namespace App\Http\Controllers\Api;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Repository\User\UserContract;
use App\Http\Requests\profile\ProfileRequest;

class ProfileController extends Controller
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
     * @return JsonResponse|mixed
     */
    public function show(): mixed
    {
        try {
            return $this->successResponse([
                'message' => 'Profile details fetched successfully',
                'data'    => $this->userContract->first(),
            ]);
        } catch (Exception $e) {
            return $this->errorMessage($e);
        }
    }

    /**
     * @param  int  $id
     * @param  ProfileRequest  $request
     * @return JsonResponse|mixed
     */
    public function update(int $id, ProfileRequest $request): mixed
    {
        try {
            return $this->successResponse([
                'message' => 'Profile updated successfully',
                'data'    => $this->userContract->update($id, $request->only([
                    'name', 'designation', 'years_of_experience', 'contact', 'email',
                ])),
            ]);
        } catch (Exception $e) {
            return $this->errorMessage($e);
        }
    }
}
