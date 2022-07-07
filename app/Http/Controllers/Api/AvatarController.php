<?php

namespace App\Http\Controllers\Api;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository\User\UserContract;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Avatar\AvatarRequest;

class AvatarController extends Controller
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

    public function update(int $id, AvatarRequest $request)
    {
        try {
            $path = Storage::disk('public')->putFileAs(
                'profiles',
                $request->file('avatar'),
                $request->file('avatar')->getClientOriginalName()
            );
            $this->userContract->update($id, ['avatar' => $path]);

            return $this->successResponse([
                'message' => 'Profile picture updated successfully',
                'data' => $this->userContract->update($id, ['avatar' => $path])
            ]);
        } catch (Exception $e) {
            return $this->errorMessage($e);
        }
    }
}
