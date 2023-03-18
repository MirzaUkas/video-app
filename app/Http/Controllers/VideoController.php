<?php

namespace App\Http\Controllers;

use Response;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    public function getVideoUploadForm()
    {
        $videos = Video::orderBy('created_at','ASC')->paginate(5);
        return view('video-upload', compact('videos'));
    }

    public function playVideo($path)
    {
        $fileContents = Storage::disk('public')->get($path);
        $response = Response::make($fileContents, 200);
        $response->header('Content-Type', "video/mp4");
        return $response;
    }


    public function update(Request $request, $id)
    {
        $this->validate($request,['title'=>'required','video'=>'required']);
        Video::find($id)->update($request->all());
        return redirect()->route('videos.get')->with('success','Video Updated Successfully');
    }


    public function edit($id)
    {
        //
        $video=Video::find($id);
        return view('video-edit',compact('video'));
    }

    public function destroy($id)
    {
        //
        Video::find($id)->delete();
        return redirect()->route('videos.get')->with('success','Video deleted Successfully');
    }


    public function uploadVideo(Request $request)
    {
         $this->validate($request, [
             'title' => 'required|string|max:255',
             'video' => 'required|file|mimetypes:video/mp4',
         ]);
  
         $fileName = $request->video->getClientOriginalName();
         $filePath = 'videos/' . $fileName;
  
         $isFileUploaded = Storage::disk('public')->put($filePath, file_get_contents($request->video));
  
         // File URL to access the video in frontend
         $url = Storage::disk('public')->url($filePath);
  
         if ($isFileUploaded) {
             $video = new Video();
             $video->title = $request->title;
             $video->path = $filePath;
             $video->save();
  
             return back()
             ->with('success','Video has been successfully uploaded.');
         }
  
         return back()
             ->with('error','Unexpected error occured');
     }
}
