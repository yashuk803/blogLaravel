<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /** @var User $user */
        $user = \Auth::user();

        $users = User::all();
       // $status = rand(-1, 3) ? 'danger' : 'success';
     //   $request->session()->flash('message', [
        //    'status' => $status,
       //     'message' => 'Task was successful!'
      //  ]);

        return view('home',
            [
                'user' => $user->getFullName(),
                'users' => $users,
            ]
        );
    }


    public function categoryIndex()
    {
        $categories = Category::all();
        \App::setLocale('en');
        return view('index', [
            'categories' => $categories,
        ]);
    }

    public function categoryDelete($id)
    {
        $category = Category::find($id);
        $category->delete();

        return redirect(route('categories.index'));
    }

    public function category($slug)
    {
        \App::setLocale('ru');

        $category = Category::where(['slug' => $slug])->first();

        return view('welcome', [
            'category' => $category,
        ]);
    }

    public function create(Request $request, $slug = null)
    {
        \App::setLocale('en');
        $category = null;
        if ($slug) {
            $category = Category::where(['slug' => $slug])->first();
        }

        return view('create', [
                'category' => $category
            ]
        );
    }

    public function save(Request $request)
    {

        $name = $request->get('name');
        $slug = $request->get('slug');
        \App::setLocale('ru');
        $validator = \Validator::make($request->all(), [
            'slug'=>'required|unique:categories,slug',
            'name'=>'required',
        ]);
        dd($validator->errors());
        if($validator->fails()) {
            return redirect(route('categories.create'))->withErrors($validator)->withInput();
        }

        $id = $request->get('id');
        if ($id === null) {
            $category = new  Category();
        } else {
            $category = Category::find($id);
        }

        $category->name = $name;
        $category->slug = $slug;
        $category->save();

        return redirect(route('categories.show', ['slug' => $slug]));
    }
    public function contacts ()
    {
        return view('contacts');
    }
    public function sendEmail (Request $request)
    {
        $message = $request->get('message');
        $text = $request->get('text');
        $email = $request->get('email');
//        $result =
//            \Mail::send('email',
//            ['msg' =>$message],
//            function ($message) use ($text) {
//                $message->from('yashuk803@gmail.com')
//                    ->to('yashuk803@gmail.com')
//                    ->subject($text);
//            });
        $result = rand(0,1);
        $data = [];
        $status = 0;
        $message = 'Ошибка отправки Email!';
        if($result) {
            $status = 1;
            $message = 'Email успешно отправлен!';
        }

        return response()->json([
            'status'=>$status,
            'message'=>$message
        ]);
    }


}
