<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class CloudController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @get("cloud/index", as="cloud.index")
     */
    public function index()
    {
        $data['title'] = 'Cloud';
        $data['active'] = 2;

        // return view('', $data);
    }

    /**
     * @return mixed
     *
     * @Post("cloud/upload", as="cloud.upload")
     */
    public function uploadFile()
    {
        $files = Input::file('files');
        $fileCount = count($files);
        $uploadCount = 0;

        foreach ($files as $file) {
            $destinationPath = public_path('uploads');
            $filename = $file->getClientOrginalName();
            $uploadSuccess = $file->move($destinationPath, $filename);

            $uploadCount++;
        }

        if ($uploadCount == $fileCount) {
            Session::flash('success', 'Upload successfully');

            return Redirect::to('upload');
        }
    }

    /**
     * @param $id
     *
     * @get("cloud/delete/{id}", as="rental.delete")
     */
    public function deleteFile($id)
    {
    }

    /**
     * @param $id
     *
     * @Get("cloud/download/{id}", as="cloud.download")
     */
    public function downloadFile($id)
    {
        if (File::exists()) {

        }

        return Redirect::route('cloud.index');
    }
}
