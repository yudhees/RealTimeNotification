<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessFormJob;
use App\Models\FormNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Str;

class FormController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required|min:10',
            'phone' => 'nullable|min:10',
            'subject' => 'required',
            'contactMethod' => 'required',
            'file' => 'nullable|file|mimetypes:application/pdf,image/jpeg,image/png,application/vnd.openxmlformats-officedocument.wordprocessingml.document|max:5000',
            'country' => 'required',
            'termsndCondition' => 'accepted',
            'dob' => 'nullable|date|before_or_equal:' . now()->format('Y-m-d'),
        ]);
        try {
            $data=$request->only(['name','email','message','phone','contactMethod','country','dob','subject']);
            $user=Auth::user();
            $data['termsAndCondtion']=true;
            if($request->file('file')?->isValid()){
                $file=$request->file('file');
                $fileName=date('Ymd').time().Str::random(7).'.'.$file->getClientOriginalExtension();
                $file->storePubliclyAs('form',$fileName,['disk'=>'public']);
                $data['fileName']=$fileName;
            }
            $data['user_id']=$user->id;
            ProcessFormJob::dispatch($user->id,$data);
            return response(['success'=>true,'message'=>'Queue Dispatched Successfully']);
        } catch (\Throwable $th) {
            return response(['success'=>false,'message'=>'SomeThing Went Wrong Please Try Again'],500);
        }
    }
    public function view($formId){
        try {
            $form=FormNotification::where('user_id',Auth::user()->id)->where('id',$formId)->first();
            if(!$form)return response(['success'=>false,'message'=>'Invalid Form']);
            $data=$form->only(['name','email','message','phone','contactMethod','country','dob','subject']);
            $data['url']=$form->getFileUrl();
            $data['created_at']=$form->created_at->toDateTimeString();
            return response(['success'=>true,'data'=>$data]);
        } catch (\Throwable $th) {
            return response(['success'=>false,'message'=>'SomeThing Went Wrong Please Try Again'],500);
        }
    }
}
