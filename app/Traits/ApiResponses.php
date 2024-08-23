<?php

namespace App\Traits;

trait ApiResponses
{
    protected function ok($message, $data = [])
    {
        return $this->success($message, $data, 200);
    }
    protected function success($message, $data = [], $statusCode = 200)
    {
        return response()->json(['data' => $data, 'success' => true, 'message' => $message, 'statusCode' => $statusCode], $statusCode);
    }
    protected function error($errors = [], $statusCode = null)
    {
        if (is_string($errors)) {
            response()->json([
                'success' => false, 
                'message' => $errors, 
                'statusCode' => $statusCode], 
                $statusCode);
        }

        return response()->json([
            'errors' => $errors,
        ]);
    }
}
