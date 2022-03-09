<?php

namespace App\Http\Livewire;

use App\Comment;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic;

class Comments extends Component
{
    use WithPagination;

    public $newComment;
    public $image;
    public $ticketId;

    protected $listeners = [
        'fileUpload' => 'handleFileUpload',
        'ticketSelected',//when you have the same name for the event and the function, you just list one
    ];

    public function ticketSelected($ticketId)
    {
        //$this->ticketId = $ticketId;
        $this->ticketId = $ticketId;
    }

    public function handleFileUpload($imageData)
    {
        $this->image = $imageData;//base64 format
    }

    public function storeImage(): ?string
    {
        if (!$this->image) {
            return null;
        }

        $img = ImageManagerStatic::make($this->image)->encode('jpg');
        $name = Str::random() . '.jpg';
        Storage::disk('public')->put($name, $img);
        return $name;
    }

    //realtime validation
    public function updated($field)
    {
        $this->validateOnly($field, ['newComment' => 'required|max:255']);
    }

    public function addComment()
    {
        $this->validate(['newComment' => 'required|max:255']);

        $image = $this->storeImage();

        $createdComment = Comment::create([
            'body' => $this->newComment,
            'user_id' => 1,
            'image' => $image,
            'support_ticket_id' => $this->ticketId,
        ]);

        $this->newComment = '';//clearing the input field after the comment is added
        $this->image = '';

        session()->flash('message', 'Comment added successfully 😁');
    }



    public function remove($commentId)
    {
        $comment = Comment::find($commentId);

        Storage::disk('public')->delete($comment->image);

        $comment->delete();

        session()->flash('message', 'Comment deleted successfully 😊');
    }

    //called as soon as the component is loaded
    public function mount(){
//        $initialComments = Comment::all();
//        $this->comments = $initialComments;
    }

    public function render()
    {
        return view('livewire.comments', [
            'comments' => Comment::where('support_ticket_id', $this->ticketId)->latest()->paginate(2),
        ]);
    }
}
