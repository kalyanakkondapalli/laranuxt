<?php

namespace App\Http\Controllers;

use Exception;
use Faker\Factory;
use acidjazz\metapi\MetApi;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, MetApi;

    /**
     * Display our routes
     *
     * @return string
     */
    public function routes(): string
    {
        Artisan::call('route:list');
        $routes = explode("\n", Artisan::output());
        foreach ($routes as $index => $route) {
            if (str_contains($route, 'debugbar')) {
                unset($routes[$index]);
            }
        }
        return '<pre>' . implode("\n", $routes) . '</pre>';
    }

    /**
     * Example endpoint returning random users
     *
     * @param  Request  $request
     * @return mixed
     */
    public function example(Request $request): Response|JsonResponse
    {
        $this
            ->option('count', 'required|integer')
            ->verify();

        $faker = Factory::create();
        $users = [];

        for ($i = 0; $i !== (int) $request->get('count'); $i++) {
            $email = $faker->unique()->safeEmail;
            $users[] = [
                'name'   => $faker->name(),
                'job'    => $faker->jobTitle,
                'email'  => $email,
                'avatar' => 'https://avatars.dicebear.com/api/human/' . $email . '.svg',
            ];
        }

        return $this->render($users);
    }

    public function error(): Response|JsonResponse
    {
        return $this->render(['forced_error' => $forced_error]);
    }

    /**
     * Success Response
     *
     * @param  array  $data
     * @param  int  $status  default 200
     * @param  array  $headers
     * @return JsonResponse
     */
    public function successResponse(array $data, int $status = 200, array $headers = []): JsonResponse
    {
        $data = array_merge(['success' => true], $data);
        return response()->json($data, $status, $headers);
    }

    /**
     * @param  Exception  $e
     * @param  string|null  $message
     * @param  int  $status
     * @return mixed
     */
    public function errorMessage(Exception $e, string $message = null, int $status = 500): mixed
    {
        logger()->error($e->getMessage(), [
            'from' => get_called_class() . ' -> ' . $e->getFile() . ' -> ' . $e->getLine(),
        ]);

        if (null === $message || env('APP_ENV') === 'production') {
            $message = config('messages.SOMETHING_WENT_WRONG');
        }
        if (env('APP_ENV') !== 'production') {
            $message = $e->getMessage();
        }

        return $this->errorResponse($message, $status);
    }

    /**
     * Error Response
     *
     * @param  string  $message
     * @param  int  $status  default 200
     * @param  array  $headers
     * @return JsonResponse
     */
    public function errorResponse(string $message, int $status = 500, array $headers = []): JsonResponse
    {
        $data = [
            'success' => false,
            'data'    => [
                'message' => $message,
            ],
        ];
        return response()->json($data, $status, $headers);
    }
}
