<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class CloudController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        $data['title']  = '';
        $data['active'] = 2;
    }

    public function uploadFile()
    {
        $files = Input::file('files');
        $fileCount = count($files);
        $uploadCount = 0;

        foreach($files as $file) {
            $destinationPath = 'uploads';
            $filename = $file->getClientOrginalName();
            $uploadSuccess = $file->move($destinationPath, $filename);

            $uploadCount ++;
        }

        if ($uploadCount == $fileCount){
            Session::flash('success', 'Upload successfully');

            return Redirect::to('upload');
        }
    }

    public function deleteFile($id)
    {

    }

    public function downloadFile()
    {

    }
}

