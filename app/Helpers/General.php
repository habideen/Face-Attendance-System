<?php

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Validator;

function totalRecord()
{
  Session::flash(
    'total_record',
    (Session::has('total_record') ? Session::get('total_record') + 1 : 1)
  );
} //totalRecord

function successSession()
{
  Session::flash(
    'success_count',
    (Session::has('success_count') ? Session::get('success_count') + 1 : 1)
  );
} //successSession


function failedSession($msg)
{
  Session::flash(
    'report_failed',
    (Session::get('report_failed')
      ? Session::get('report_failed') . '<br>' . $msg
      : $msg
    )
  );

  failedCount();
} //failedSession


function failedCount()
{
  Session::flash(
    'failed_count',
    (Session::has('failed_count') ? Session::get('failed_count') + 1 : 1)
  );
} //failedCount


function implodeErrors($validator)
{
  $errors = $validator->errors()->messages();
  $firstErrors = array_map(function ($messages) {
    return $messages[0];
  }, $errors);

  return implode(' ::: ', $firstErrors);
}


function validateErrorResponseInput($validator, Request $request, $msg = 'Invalid input submitted!')
{
  abort(
    redirect()->back()->with([
      'status' => 'failed',
      'message' => $msg,
    ], Response::HTTP_EXPECTATION_FAILED)
      ->withErrors($validator->errors())
      ->withInput()
  );
}


function vaidateErrorResponse($validator)
{
  abort(
    redirect()->back()->with([
      'status' => 'failed',
      'message' => 'Invalid input submitted!',
    ], Response::HTTP_EXPECTATION_FAILED)
      ->withErrors($validator->errors())
  );
}


function responseSystemError($msg = 'System error! Please try again.')
{
  abort(
    redirect()->back()->with([
      'status' => 'failed',
      'message' => $msg,
    ], Response::HTTP_SERVICE_UNAVAILABLE)
  );
}


function responseError($msg)
{
  abort(
    redirect()->back()->with([
      'status' => 'failed',
      'message' => $msg,
    ], Response::HTTP_EXPECTATION_FAILED)
  );
}


function responseSuccess($msg = 'Record was saved successful.', $path = null)
{
  $data = [
    'status' => 'successful',
    'message' => $msg,
  ];

  if (!$path) {
    abort(
      redirect()->back()->with($data, Response::HTTP_OK)
    );
  }

  abort(
    redirect()->to($path)->with($data, Response::HTTP_OK)
  );
}


function uploadResponse()
{
  $messages = 'Total Records = ' . Session::get('total_record');
  $messages .= '<br>Successful = ' . Session::get('success_count');
  $messages .= '<br>Failed = ' . Session::get('failed_count');
  $messages .= Session::get('failed_count') > 0 ?
    '<br>Errors:<br>' . Session::get('report_failed') :
    '';

  abort(
    redirect()->back()->with([
      'status' => Session::get('failed_count') > 0 ? 'failed' : 'successful',
      'message' => $messages
    ])
  );
}

