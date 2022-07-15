<?php

if (!function_exists('successResponse')) {
  /**
   * Greeting a person
   *
   * @param  string $person Name
   * @return string
   */
  function successResponse($data = '', $message = "Successfully process the request", $code = 200)
  {
    $res = [
      'data' => $data,
      'message' => $message
    ];

    return response()->json($res, $code);
  }
}

if (!function_exists('errorResponse')) {
  /**
   * Greeting a person
   *
   * @param  string $person Name
   * @return string
   */
  function errorResponse($data = '', $message = "Unable to process the request", $error = '', $code = 400)
  {
    $res = [
      'type' => $data,
      'message' => $message,
      'error' => $error,
    ];

    return response()->json($res, $code);
  }
}
