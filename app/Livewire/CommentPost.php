<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Comentario;

class CommentPost extends Component
{
    public $comentario;
    public $post;
    public $user;
    public $comentarios;
    public $commentId;

    public function mount($post)
    {
        $this->post = $post;
        $this->user = auth()->user();
        $this->comentarios = $post->comentarios;

    }

    public function store()
    {
        //validar
        $this->validate([
            'comentario' => 'required|max:255'
        ]);
        //almacenar
        if(!$this->commentId) {
            $newComment = Comentario::create([
                'user_id' => $this->user->id,
                'post_id' => $this->post->id,
                'comentario' => $this->comentario
            ]);    
            $this->comentarios->push($newComment);
        } else {
            $comment = Comentario::find($this->commentId);
            $comment->comentario = $this->comentario;
            $comment->save();
            $this->commentId = null;
        }

        $this->reset('comentario');
    }

    public function edit($commentId)
    {
        $comment = Comentario::find($commentId);

        if ($comment->user_id == $this->user->id) {
            $this->comentario = $comment->comentario;
            $this->commentId = $comment->id;
        }
    }

    public function delete($commentId)
    {
        $comment = Comentario::find($commentId);

        if ($comment->user_id == $this->user->id) {
            $comment->delete();
        }
    }

    public function render()
    {
        return view('livewire.comment-post');
    }
}
