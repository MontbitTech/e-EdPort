<?php

namespace App\Http\Controllers;

use App\HelpTicketCategory;
use App\Http\Requests\help_ticket\createRequest;
use Illuminate\Http\Request;

class HelpTicketCategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = HelpTicketCategory::get();

        return $categories;
    }

    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return View
     */
    public function add()
    {
        return view('admin.help.category.add');
    }
    public function show(Request $request, $id)
    {
        return view('admin.category', ['category' => HelpTicketCategory::findOrFail($id)]);
    }

    public function store(createRequest $request)
    {
        $category = new HelpTicketCategory();
        $category->category = $request->category;
        $category->save();

        return back()->with('success', 'successfully Category Created');;
    }
    public function edit($id)
    {
        $sid = decrypt($id);
        return view('admin.help.category.add')
            ->with('category', HelpTicketCategory::findorFail($sid));
    }
    public function update(createRequest $request, $id)
    {
        $sid = decrypt($id);
        $category =  HelpTicketCategory::findorFail($sid);
        $category->category = $request->category;
        $category->save();
        return redirect()->route('admin.helplist')->with('success', 'successfully Category update');
    }
    public function delete(Request $request, $id)
    {
        if ($request->delete == 'Delete' || $request->delete == 'delete') {

            $category = HelpTicketCategory::findorFail($id);
            $category->delete();
            return back();
        } else {
            return back()->with('error', "Type delete to confirm");
        }
    }
}
