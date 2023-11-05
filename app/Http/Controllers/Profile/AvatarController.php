<?php

namespace App\Http\Controllers\Profile;
use App\Http\Requests\updateAvatarRequest;
use App\Http\Controllers\Controller;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use OpenAI\Laravel\Facades\OpenAi;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AvatarController extends Controller
{
    public function update(UpdateAvatarRequest $request){
        // return  response()->redirectTo('/profile.');
        // $request->validate(
        //    [ 'avatar'=>'required|image']
        // );
    //   dd($request->input('avatar'));
    //   dd($request->all());returns all data about the file 
       $path= $request->file('avatar')->store('avatars','public');


       if($oldAvatar=$request->user()->avatar){
        Storage::disk('public')->delete($oldAvatar);
       }

       auth()->user()->update(['avatar'=>$path]);


    //    dd(auth()->user()); 
       // return back()->with('message','Avatar is Changed');
        // return redirect(route('profile.edit'));
        return view('profile.edit',['user'=>$request->user()]);
    }
    public function createAvatar(Request $request) {

        //FOR TEXT BASED VIEW
    
        //    $result=OpenAi::completions()->create([
    
        //     'model'=>'text-davinci-003',
        //     'prompt'=>'PHP is ',
    
        //    ]);
    
        // echo $result['choices'][0]['text'];
        //GENERATING IMAGE
    
        $result = OpenAi::images()->create([
    
            'prompt' => 'create avatar for user with name',
            // .auth()->user()->name
            'n' => 1,
            'size' => "256x256"
        ]);
    
        $contents = file_get_contents($result->data[0]->url);
        $filename = Str::random(25);
           if($oldAvatar=$request->user()->avatar){
            Storage::disk('public')->delete($oldAvatar);
           }
        Storage::disk('public')->put("avatars/$filename.jpg", $contents);
        auth()->user()->update(['avatar'=>"avatars/$filename.jpg"]);
        // return response(['url'=>$result->data[0]->url]);
        return redirect(route('profile.edit'))->with('message', 'Avatar is updated');
    }
}
