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

/**
 * @param $text
 * @param array $parameters
 * @return mixed
 */
function lang($text, $parameters = [])
{
    return str_replace('Laradmin.', '', trans('Laradmin.' . $text, $parameters));
}

/**
 * @param $file
 * @param $path
 * @param array $size
 * @return bool|string
 */
function uploadImage($file, $path, $size = [])
{
    try {
        $fileExtension = $file->getClientOriginalExtension();
        $fileName = time() . time() . rand(0000, 9999) . '.' . $fileExtension;
        $filePath = 'upload/' . $path;
        $result = $file->move('upload/' . $path, $fileName);
        if ($result) {
            if (count($size)) {
                if (!isset($size['height'])) {
                    $image = Image::make($filePath . '/' . $fileName)->fit($size['width']);
                } else {
                    $image = Image::make($filePath . '/' . $fileName)->resize($size['width'], $size['height']);
                }
                $image->save($filePath . '/' . $fileName);
            }
            return '/' . $filePath . '/' . $fileName;
        }
        return false;
    } catch (\Exception $exception) {
        return false;
    }
}