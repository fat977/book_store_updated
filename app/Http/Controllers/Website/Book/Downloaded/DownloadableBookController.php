<?php

namespace App\Http\Controllers\Website\Book\Downloaded;

use App\Http\Controllers\Controller;
use App\Models\Download;
use App\Models\DownloadableBook;
use App\Models\React;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DownloadableBookController extends Controller
{
    //
    public function books(){
        $books = DownloadableBook::query()->where('status',1)->with('author')->paginate(4);
        return view('website.books.downloadable_books.books',compact('books'));
    }

    public function bookDetails($book_id){
        $book = DownloadableBook::query()->where('id',$book_id)->with(['category','author'])->first();
        
         //similar books
         $similarBooks = DownloadableBook::with('author')->where('category_id', $book->category->id)
         ->where('id', '!=', $book_id)->get();
        $downloads_count = Download::query()->where('downloadable_book_id',$book_id)->count();
        return view('website.books.downloadable_books.details',compact('book','similarBooks','downloads_count'));
    }

    public function like(Request $request){
        //if(Auth::check()){
            $like_s = $request->like_s;
            $book_id  = $request->book_id ;
            $change_like =0;
    
            $like = React::query()->where('downloadable_book_id',$book_id )->where('user_id',Auth::user()->id)->first();
    
            if(!$like){
                $new_like = new React();
                $new_like->downloadable_book_id  =$book_id;
                $new_like->user_id =Auth::user()->id;
                $new_like->like = 1;
                $new_like->dislike = 0;
                $new_like->save();
    
                $is_like = 1;
            }
    
            elseif($like->like == 1){
                React::where('downloadable_book_id',$book_id )->where('user_id',Auth::user()->id)->delete();
    
                $is_like = 0;
            }
    
            elseif($like->like == 0){
                React::where('downloadable_book_id',$book_id )->where('user_id',Auth::user()->id)
                ->update(['like'=>1,'dislike'=>0]);
    
                $is_like = 1;
                $change_like=1;
            }
    
            $respone = array(
                'is_like'=> $is_like,
                'change_like'=>$change_like
            );
    
            return response()->json($respone,200);
        /* }else{
            flash()->addError('You need to login first !');
        } */
    }

    public function dislike(Request $request){
        $like_s = $request->like_s;
        $book_id  = $request->book_id ;
        $change_dislike=0;

        $dislike = React::where('downloadable_book_id',$book_id)->where('user_id',Auth::user()->id)->first();

        if(!$dislike){
            $new_like = new React();
            $new_like->downloadable_book_id =$book_id;
            $new_like->user_id =Auth::user()->id;
            $new_like->dislike = 1;
            $new_like->like = 0;
            $new_like->save();

            $is_dislike = 1;
        }

        elseif($dislike->dislike == 1){
            React::where('downloadable_book_id',$book_id)->where('user_id',Auth::user()->id)->delete();

            $is_dislike = 0;
        }

        elseif($dislike->dislike == 0){
            React::where('downloadable_book_id',$book_id)->where('user_id',Auth::user()->id)
            ->update(['dislike'=>1,'like'=>0]);

            $is_dislike = 1;
            $change_dislike=1;
        }

        $respone = array(
            'is_dislike'=> $is_dislike,
            'change_dislike' => $change_dislike,
        );

        return response()->json($respone,200);

    }

    public function download($file){
      
        return response()->download(public_path('storage/downloadedBook/files/'.$file));
    }

   
    public function addToDownload(Request $request){
        $book_id = $request->input('book_id');          

        //if(Auth::check()){
            $book_exist = Download::where('downloadable_book_id',$book_id)->where('user_id',Auth::id())->exists();
            if($book_exist){
                Download::where('downloadable_book_id',$book_id)->where('user_id',Auth::id())
                ->update(['updated_at'=>date('Y-m-d H:i:s')]);  
                return response()->json(['type'=>'success','message'=>'Get the link in seconds']);   
            }else{
                $downloadItem = new Download();
                    $downloadItem->downloadable_book_id =$book_id;
                    $downloadItem->user_id =Auth::id();
                    $downloadItem->save();
                    return response()->json(['type'=>'success','message'=>'Get the link in seconds']);
            }
        /* }else{
            flash()->addError('You need to login first !');
        } */

    }

    public function bookList(){
        $books = DownloadableBook::select('name')->where('status',1)->get();
        $data = [];
        foreach($books as $book){
            $data[]= $book['name'];

        }
        return $data;
    }

    public function search(Request $request){
        $search_book = $request->name;
        if($search_book != " "){
            $book = DownloadableBook::where("name","LIKE","%$search_book%")->first();
            //dd($book);
            if($book){
                return redirect('downloadable_books/details/'.$book['id']);
            }else{
                return redirect()->back()->with('error_message','no book matched your search');
            }
        }else{
            return redirect()->back();
        }
    }

    public function sort(Request $request){

        if($request->sort_by == 'book_oldest'){
            $books= DownloadableBook::with('author')->orderBy('id','asc')->where('status',1)->paginate(4);  
        }
        if($request->sort_by == 'book_newest'){
            $books= DownloadableBook::with('author')->orderBy('id','desc')->where('status',1)->paginate(4);  
            //dd($books);
        }
        if($request->sort_by == 'name_a_z'){
            $books= DownloadableBook::with('author')->orderBy('name','asc')->where('status',1)->paginate(4);  
        }
        if($request->sort_by == 'name_z_a'){
            $books= DownloadableBook::with('author')->orderBy('name','desc')->where('status',1)->paginate(4);  
        }
        return view('website.books.downloadable_books.books',compact('books'));
    }

}
