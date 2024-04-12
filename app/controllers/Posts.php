<?php 
class Posts extends Controller{

    public function __construct()
    {
        if(!isLoggedIn()){
            redirect('users/login');
        }
        // nový model instance
        $this->postModel = $this->model('Post');
        $this->userModel = $this->model('User');
    }

    public function index(){

        $posts = $this->postModel->getPosts();
        $data = [
            'posts' => $posts
        ];

        $this->view('posts/index', $data);
    }

    /**
     *  přidá nový příspěvek
     */ 
    public function add(){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $data = [
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'user_id' => $_SESSION['user_id'],
                'title_err' => '',
                'body_err' => '',
            ];

            if(empty($data['title'])){
                $data['title_err'] = 'Zadejte název příspěvku';
            }
            if(empty($data['body'])){
                $data['body_err'] = 'Zadejte prosím obsah příspěvku';
            }

            /** 
             * ověření chyb
             */
            if(empty($data['title_err']) && empty($data['body_err'])){
                if($this->postModel->addPost($data)){
                    flash('post_message', 'Váš příspěvek byl přidán');
                    redirect('posts');
                }else{
                    die('something went wrong');
                }
               
                /**
                 * načte zobrazení s chybou
                 */
            }else{
                $this->view('posts/add', $data);
            }
        }else{
            $data = [
                'title' => (isset($_POST['title']) ? trim($_POST['title']) : ''),
                'body' =>  (isset($_POST['body'])? trim($_POST['body']) : '')
            ];

            $this->view('posts/add', $data);
        }
    }

    /**
     * zobrazí jeden příspěvek
     */
    public function show($id){
        $post = $this->postModel->getPostById($id);
        $user = $this->userModel->getUserById($post->user_id);

        $data = [
            'post' => $post,
            'user' => $user
        ];

        $this->view('posts/show', $data);
    }

     /**
      * upraví příspěvek
      */
     public function edit($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'id' => $id,
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'user_id' => $_SESSION['user_id'],
                'title_err' => '',
                'body_err' => '',
            ];
            // potvrdí název
            if(empty($data['title'])){
                $data['title_err'] = 'Zadejte název příspěvku';
            }
            // potvrdí obsah
            if(empty($data['body'])){
                $data['body_err'] = 'Zadejte prosím obsah příspěvku';
            }

            // potvrdí ověření chyb
            if(empty($data['title_err']) && empty($data['body_err'])){
                if($this->postModel->updatePost($data)){
                    flash('post_message', 'Váš příspěvek byl aktualizován');
                    redirect('posts');
                }else{
                    die('something went wrong');
                }
               
                // načte zobrazení s chybou
            }else{
                $this->view('posts/edit', $data);
            }
        }else{
            /**
             * zkontroluje vlastníka a metodu volání z příspěvku
             */
            $post = $this->postModel->getPostById($id);
            if($post->user_id != $_SESSION['user_id']){
                redirect('posts');
            }
            $data = [
                'id' => $id,
                'title' => $post->title,
                'body' => $post->body
            ];

            $this->view('posts/edit', $data);
        }
    }
    
    /**
     * Smaže příspěvek
     */
    public function delete($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            
            $post = $this->postModel->getPostById($id);
            if($post->user_id != $_SESSION['user_id']){
                redirect('posts');
            }
            
            // volání metody odstranění z modelu příspěvku
            if($this->postModel->deletePost($id)){
                flash('post_message', 'Příspěvek odstraněn');
                redirect('posts');
            }else{
                die('něco se pokazilo');
            }
        }else{
            redirect('posts');
        }
    }
}                            
                        