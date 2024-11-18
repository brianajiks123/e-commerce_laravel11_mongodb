<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CmsPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class CmsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Session::put("page", "cms-pages");

        $cms_pages = CmsPage::get();

        // $cms_pages_json = json_decode(json_encode($cms_pages));
        // echo "<pre>"; print_r($cms_pages_json); die;

        return view("admin.pages.cms_pages")->with(compact("cms_pages"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(CmsPage $cmsPage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id=null)
    {
        if ($id == "") {
            $title = "Add CMS Page";
            $cms_page = new CmsPage;
            $msg = "Success to adding CMS Page.";
        } else {
            $title = "Edit CMS Page";
            $cms_page = CmsPage::find($id);
            $msg = "Success to updating CMS Page.";
        }

        if ($request->isMethod("post")) {
            $data = $request->all();

            // Check title is contains whitespace or not
            if (strpos($data["title"], ' ') !== false) {
                // Generate URL from title
                $url_break = explode(" ", $data["title"]);
                $url = Str::lower(implode("-", $url_break));
            } else {
                $url = Str::lower($data["title"]);
            }

            $rules = [
                "title" => "required",
                "description" => "required",
            ];

            $customMsgs = [
                "title.required" => "Title is required.",
                "description.required" => "Description is required.",
            ];

            $request->validate($rules, $customMsgs);

            $cms_page->title = Str::title($data["title"]);
            $cms_page->url = $url;
            $cms_page->description = $data["description"];
            $cms_page->status = 1;
            $cms_page->save();

            return redirect("admin/cms-pages")->with("success_message", $msg);
        }

        return view("admin.pages.add_edit_cms_page")->with(compact("title", "cms_page"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CmsPage $cmsPage)
    {
        if ($request->ajax()) {
            $data = $request->all();

            if ($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }

            $cmsPage->where("_id", $data["page_id"])->update(["status" => $status]);

            return response()->json(["status" => $status, "page_id" => $data["page_id"]]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CmsPage $cmsPage, $id)
    {
        $cmsPage->where(["_id" => $id])->delete();

        return redirect()->back()->with("success_message", "Success to deleting CMS Page.");
    }
}
