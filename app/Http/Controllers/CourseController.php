<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\PurchasedCourse;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    // Method to show detailed course information
    public function show($id)
    {
        $course = Course::findOrFail($id);
        return view('Front.course_details', compact('course'));
    }

    // Method to handle video content display
    public function videoContent($course_id)
    {
        $course = Course::findOrFail($course_id);
        return view('Front.video_content', compact('course'));
    }

    // Method to display form for creating a new course
    public function create()
    {
        return view('Front.uploadPage');
    }

    // Method to store a newly created course
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'thumbnail' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'video' => 'required|mimetypes:video/mp4|max:204800', // max 200MB
        ]);

        // Handle image upload
        $imagePath = $request->file('image')->store('uploads/images', 'public');

        // Handle video upload
        $videoPath = $request->file('video')->store('uploads/videos', 'public');

        // Save course to database
        $course = Course::create([
            'title' => $request->title,
            'thumbnail' => $request->thumbnail,
            'description' => $request->description,
            'price' => $request->price,
            'image_url' => '/storage/' . $imagePath,
            'video_url' => '/storage/' . $videoPath,
            'rating' => 0,
            'user_id' => auth()->user()->id,
        ]);

        return redirect()->back()->with('success', 'Course created successfully!');
    }

    // Method to display form for editing a course
    public function edit($id)
    {
        $course = Course::findOrFail($id);
        return view('Front.edit_course', compact('course'));
    }

    // Method to update an existing course
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string',
            'thumbnail' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'video' => 'nullable|mimetypes:video/mp4|max:204800',
        ]);

        $course = Course::findOrFail($id);

        // Handle image update if new image is provided
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($course->image_url);
            $imagePath = $request->file('image')->store('uploads/images', 'public');
            $course->image_url = '/storage/' . $imagePath;
        }

        // Handle video update if new video is provided
        if ($request->hasFile('video')) {
            Storage::disk('public')->delete($course->video_url);
            $videoPath = $request->file('video')->store('uploads/videos', 'public');
            $course->video_url = '/storage/' . $videoPath;
        }

        // Update other course details
        $course->title = $request->title;
        $course->thumbnail = $request->thumbnail;
        $course->description = $request->description;
        $course->price = $request->price;
        $course->save();

        return redirect()->route('courses.show', $course->id)->with('success', 'Course updated successfully!');
    }

    // Method to delete a course
    public function destroy($id)
    {
        $course = Course::findOrFail($id);

        // Delete associated files
        Storage::disk('public')->delete($course->image_url);
        Storage::disk('public')->delete($course->video_url);

        $course->delete();

        return redirect()->route('profile.show')->with('success', 'Course deleted successfully!');
    }

    // Method to list all courses
    public function index()
    {
        $courses = Course::paginate(10); // Paginate courses
        return view('Front.courses', compact('courses'));
    }

    // Method to handle purchasing a course
    public function buy($id)
    {
        $course = Course::findOrFail($id);

        // Prevent purchasing own course
        if ($course->user_id === auth()->user()->id) {
            return redirect()->route('courses.show', $course->id)->with('error', 'You cannot purchase your own course!');
        }

        // Prevent duplicate purchases
        $alreadyPurchased = PurchasedCourse::where('course_id', $course->id)
            ->where('user_id', auth()->user()->id)
            ->exists();

        if ($alreadyPurchased) {
            return redirect()->route('courses.show', $course->id)->with('error', 'You have already purchased this course!');
        }

        PurchasedCourse::create([
            'course_id' => $course->id,
            'user_id' => auth()->user()->id,
        ]);

        return redirect()->route('courses.show', $course->id)->with('success', 'Course purchased successfully!');
    }

    // Method to display purchased courses for the authenticated user
    public function purchasedCourses()
    {
        $purchasedCourses = PurchasedCourse::where('user_id', auth()->user()->id)
            ->with('course')
            ->paginate(10);

        return view('Front.purchased_course', compact('purchasedCourses'));
    }

    // Method to display courses purchased by the authenticated user
    public function userCourses()
    {
        $courses = Course::whereHas('purchasedCourses', function ($query) {
            $query->where('user_id', auth()->user()->id);
        })->get();

        return view('Front.purchased_course', compact('courses'));
    }
}
