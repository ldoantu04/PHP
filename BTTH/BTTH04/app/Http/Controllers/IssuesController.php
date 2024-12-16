<?php

namespace App\Http\Controllers;

use App\Models\Issues;
use App\Models\Computers;
use Illuminate\Http\Request;

class IssuesController extends Controller
{
    public function index()
    {
        $issues = Issues::with('computer')->get(); 
        return view('issues.index', compact('issues'));
    }

    public function create()
    {
        $computers = Computers::all();
        return view('issues.create', compact('computers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'computer_id' => 'required',
            'reported_by' => 'required|max:255',
            'reported_date' => 'required|date',
            'description' => 'required',
            'urgency' => 'required|max:100',
            'status' => 'required|max:100',
        ]);
        Issues::create($request->all());

        return redirect()->route('issues.index')->with('success', 'Vấn đề mới được thêm thành công!');
    }

    public function edit($id)
    {
        $issue = Issues::findOrFail($id);
        $computers = Computers::all();
        return view('issues.edit', compact('issue', 'computers'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'computer_id' => 'required',
            'reported_by' => 'required|max:255',
            'reported_date' => 'required|date',
            'urgency' => 'required|max:100',
            'status' => 'required|max:100',
        ]);
    
        // Tìm đối tượng Issues cần cập nhật
        $issue = Issues::find($id);
        
        // Cập nhật thông tin
        $issue->update($request->all());
        return redirect()->route('issues.index')->with('success', 'Cập nhật thông tin vấn đề thành công!');
    }
    

    public function destroy($id)
    {
        $issue = Issues::findOrFail($id);
        $issue->delete();
        return redirect()->route('issues.index')->with('success', 'Xóa thành công!');
    }
}
