<?php

/**
 * @param string $message
 * @param string $type
 * @param null $path
 * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
 */
function toastr($toastr = [])
{
    isset($toastr['message']) ? Session::flash('toastr_message', $toastr['message']) : Session::flash('toastr_message', '操作成功执行');
    isset($toastr['type']) ? Session::flash('toastr_type', $toastr['type']) : Session::flash('toastr_type', 'success');
    return isset($toastr['path']) ? redirect($toastr['path']) : back();
}

function lang($text, $parameters = [])
{
    return str_replace('Laradmin.', '', trans('Laradmin.' . $text, $parameters));
}

function uploadImage($file, $path)
{
    try {
        $fileExtension = $file->getClientOriginalExtension();
        $fileName = time() . time() . rand(0000, 9999) . '.' . $fileExtension;
        $filePath = 'upload/' . $path;
        $result = $file->move('upload/' . $path, $fileName);
        if ($result) {
            return '/' . $filePath . '/' . $fileName;
        }
        return false;
    } catch (\Exception $exception) {
        return false;
    }
}