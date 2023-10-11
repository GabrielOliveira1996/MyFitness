<?php

namespace App\Http\Controllers\Comment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Repository\Comment\ICommentRepository;
use Exception;

class CommentManagementController extends Controller
{
    private $_request;
    private $_commentRepository;

    public function __construct(Request $request, ICommentRepository $commentRepository){
        $this->_request = $request;
        $this->_commentRepository = $commentRepository;
    }

    public function create(){
        try{
            $comment = $this->_request->only('text', 'post_id');
            if(!$comment){
                throw new Exception('Escreva algo em seu comentário.');
            }
            $create = $this->_commentRepository->create(Auth::user(), $comment);
            return redirect()->back();
        }catch(\Exception $e){
            return redirect()->back()->with('status_comment');
        }
    }
    
    public function delete($id){
        try{
            $get = $this->_commentRepository->get($id);
            if($get == null){
                throw new Exception('O comentário escolhido para exclusão não foi encontrado. Por favor, selecione outro.', 422); // Unprocessable Entity.
            }
            if($get['user_id'] != Auth::user()->id){
                throw new Exception('Este comentário não está associado à sua conta. Por favor, escolha o seu próprio comentário.', 401); // Unauthorized.
            }
            $delete = $this->_commentRepository->delete($id);
            return redirect()->back();
        }catch(Exception $e){
            return redirect()->back()->with('status_comment', $e->getMessage());
        }
    }

    public function update(){
        try{
            $data = $this->_request->only(['id', 'text']);
            $get = $this->_commentRepository->get($data['id']);
            if($get == null){
                throw new Exception('O comentário escolhido para editar não foi encontrado. Por favor, selecione outro.', 422); // Unprocessable Entity.
            }
            if($get['user_id'] != Auth::user()->id){
                throw new Exception('Este comentário não está associado à sua conta. Por favor, escolha o seu próprio comentário.', 401); // Unauthorized.
            }
            $get = $this->_commentRepository->update($data['id'], $data);
            return redirect()->back();
        }catch(Exception $e){
            return redirect()->back()->with('status_comment', $e->getMessage());
        }
    }
}
