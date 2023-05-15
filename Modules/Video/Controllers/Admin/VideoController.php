<?php

namespace Modules\Video\Controllers\Admin;

use App\Constants\Statuses;
use App\Http\Controllers\Controller;
use Illuminate\Database\Query\JoinClause;
use App\Http\Services\UploaderService;
use Modules\Page\Models\Page;
use Modules\Video\Models\Video;
use Illuminate\Http\Request;
use PhpParser\Comment\Doc;
use Modules\Doctor\Models\Doctor;
use Modules\Video\Http\Requests\VideoStoreRequest;
use Modules\Video\Http\Requests\VideoUpdateRequest;
class VideoController extends Controller
{
    /**
     * @var UploaderService
     */
    private $uploaderService;

    public function __construct(UploaderService $uploaderService)
    {
        $this->uploaderService = $uploaderService;
    }

    private $viewsPath = 'Video.Resources.views.';

    public function index()
    {

        return view($this->viewsPath.'index');
    }


    public function create()
    {


         $doctors = Doctor::where('status', Statuses::ACTIVE)->listsTranslations('name')->get();

        return view($this->viewsPath.'create', compact('doctors'));
    }

    public function store(VideoStoreRequest $request) {

        $video = new Video();
        $video->fill($request->request->all());

        if ($request->hasFile('image') ) {
            $video->image = $this->uploaderService->upload($request->file("image"), "videos");
        }

        if ($request->hasFile('video') ) {
            $video->video = $this->uploaderService->upload($request->file("video"), "videos");
        }

        $video->save();

        return redirect()->route('admin.videos.index')->with(['success' => 'Updated Successfully']);
    }


    public function edit(Video $video)
    {

        $doctors = Doctor::where('status', Statuses::ACTIVE)->listsTranslations('name')->get();
        return view($this->viewsPath.'edit',['form' => $video,'doctors' =>$doctors]);
    }


    public function update(Video $video, VideoUpdateRequest $request) {

        $video->fill($request->request->all());

        if ($request->hasFile('image') ) {
            $video->image = $this->uploaderService->upload($request->file("image"), "videos");
        }

        if ($request->hasFile('video') ) {
            $video->video = $this->uploaderService->upload($request->file("video"), "videos");
        }

        $video->save();

        return redirect()->route('admin.videos.index')->with(['success' => 'Updated Successfully']);
    }

    public function enable(Video $video, Request $request) {
        $video->status = Statuses::ACTIVE;
        $video->save();

        return redirect()->route('admin.videos.index')->with(['success' => 'Updated Successfully']);
    }

    public function disable(Video $video, Request $request) {
        $video->status = Statuses::DISABLED;
        $video->save();

        return redirect()->route('admin.videos.index')->with(['success' => 'Updated Successfully']);
    }

    public function deleted(Video $video, Request $request) {

        if(file_exists(public_path().'/'.$video->image)){
            $image_path = public_path().'/'.$video->image;
                  unlink($image_path);    
        }

        if(file_exists(public_path().'/'.$video->video)){
            $video_path = public_path().'/'.$video->video;
                  unlink($video_path);    
        }

        $video->delete();

        return redirect()->route('admin.videos.index')->with(['success' => 'Deleted Successfully']);
    }
}

