<?php

namespace App\Http\Controllers\Post;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Repository\Post\IPostRepository;
use Exception;

class PostManagementController extends Controller
{
    private $_request;
    private $_postRepository;

    public function __construct(Request $request, IPostRepository $postRepository){
        $this->_request = $request;
        $this->_postRepository = $postRepository;
    }

    public function create(){
        $post = $this->_request->only('text');
        $create = $this->_postRepository->create(Auth::user(), $post);
        return redirect()->back();
    }

    public function delete($id){
        try{
            $get = $this->_postRepository->get($id);
            if($get == null){
                throw new Exception('O post escolhido para exclusão não foi encontrado. Por favor, selecione outro.', 422); // Unprocessable Entity.
            }
            if($get['user_id'] != Auth::user()->id){
                throw new Exception('Este post não está associado à sua conta. Por favor, escolha o seu próprio post.', 401); // Unauthorized.
            }
            $get = $this->_postRepository->delete($id);
            return redirect()->back();
        }catch(Exception $e){
            return redirect()->back()->with('status', $e->getMessage());
        }
    }

    public function update(){
        try{
            $data = $this->_request->only(['id', 'text']);
            $get = $this->_postRepository->get($data['id']);
            if($get == null){
                throw new Exception('O post escolhido para editar não foi encontrado. Por favor, selecione outro.', 422); // Unprocessable Entity.
            }
            if($get['user_id'] != Auth::user()->id){
                throw new Exception('Este post não está associado à sua conta. Por favor, escolha o seu próprio post.', 401); // Unauthorized.
            }
            $get = $this->_postRepository->update($data['id'], $data);
            return redirect()->back();
        }catch(Exception $e){
            return redirect()->back()->with('status', $e->getMessage());
        }
    }
}
