<?php
class Users extends Controller{
    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function register(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
           /**
            * formulář
            */
           $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING); 
            $data = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => '' 
            ];

            /**
             * jméno
             */
            if(empty($data['name'])){
                $data['name_err'] = 'Zadejte prosím jméno';
            }

            /**
             * e-mail
             */
            if(empty($data['email'])){
                $data['email_err'] = 'Zadejte prosím e-mail';
            } else {
                /**
                 * potvrzení e-mailu
                 */
                if($this->userModel->findUserByEmail($data['email'])){
                    $data['email_err'] = 'E-mail již existuje';
                }
            }

            /**
             * heslo
             */
            if(empty($data['password'])){
                $data['password_err'] = 'Prosím zadejte své heslo';
            } elseif(strlen($data['password']) < 6) {
                $data['password_err'] = 'Heslo musí mít alespoň šest znaků';
            }

            /**
             * potvrzení hesla
             */
            if(empty($data['confirm_password'])){
                $data['confirm_password_err'] = 'Prosím potvrďte heslo';
            } else {
                if($data['password'] != $data['confirm_password'])
                {
                    $data['confirm_password_err'] = 'Heslo neodpovídá';
                }
            }

            /**
             * zde se ujistí jestli je chyba prázdná
             */
            if(empty($data['name_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['password_confirm_err'])){
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                if($this->userModel->register($data)){
                    flash('register_success', 'jste zaregistrováni, nyní se můžete přihlásit');
                    redirect('users/login');
                }
            } else {
                $this->view('users/register', $data);
            }
        } else {
            /**
             * init data
             */
            $data = [
                'name' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => '' 
            ];
            /**
             * načte pohled
             */
            $this->view('users/register', $data);          
        }
    }

    public function login(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
           /**
            * formulář
            */
           $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING); 
           $data = [
               'email' => trim($_POST['email']),
               'password' => trim($_POST['password']),
               'email_err' => '',
               'password_err' => ''
           ];

            /**
             * e-mail
             */
            if(empty($data['email'])){
                $data['email_err'] = 'Zadejte prosím e-mail';
            } else {
                if($this->userModel->findUserByEmail($data['email'])){
                    /**
                     * uživatel nalezen
                     */
                } else {
                    $data['email_err'] = 'Uživatel nenalezen';
                }
            }

            /**
             * heslo 
             */ 
            if(empty($data['password'])){
                $data['password_err'] = 'Prosím zadejte své heslo';
            }elseif(strlen($data['password']) < 6){
                $data['password_err'] = 'Heslo musí mít alespoň šest znaků';
            }
            
            /**
             * zde se ujistí jestli je chyba prázdná
             */
            if(empty($data['email_err']) && empty($data['password_err'])){
                $loggedInUser = $this->userModel->login($data['email'], $data['password']);
                if($loggedInUser){
                    /**
                     * vytvoří relaci
                     */
                    $this->createUserSession($loggedInUser);
                }else{
                    $data['password_err'] = 'Špatné heslo';
                    $this->view('users/login', $data);
                }
            }else{
                $this->view('users/login', $data);
            }

        }else{
            /**
             * init data
             */
            $data = [
                'email' => '',
                'password' => '',
                'email_err' => '',
                'password_err' => ''
            ];
            /**
             * vytvoří pohled
             */
            $this->view('users/login', $data);          
        }
    }

    /**
     * nastavení proměnné
     */
    public function createUserSession($user){
        $_SESSION['user_id'] = $user->id;
        $_SESSION['name'] = $user->name;
        $_SESSION['email'] = $user->email;
        redirect('posts/index');
    }

    /**
     * odhlásit uživatele
     */
    public function logout(){
        unset($_SESSION['user_id']);
        unset($_SESSION['name']);
        unset($_SESSION['email']);
        session_destroy();
        redirect('users/login');
    }
}