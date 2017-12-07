<?

class C_PostController extends C_Base {
    protected $content='';
    protected $error='';
    protected $template = '';
    Protected $login ='';


    function __construct() {}
    function __destruct() {}

    /**
     *
     */
    protected function onInput()
    {
        parent::OnInput();
        $mPost = M_Posts::Instance();

        //Роутинг по типам Post
        if (!empty($_POST['signUp'])) {
            $this->template = 'signup';
            $this->login = trim($mPost->clearStr($_POST['login']));
            $password = $_POST['password'];
            $day = (int)$_POST['day'];
            $mounth = (int)$_POST['mounth'];
            $year = (int)$_POST['year'];


            $age = $mPost->getUserAge($day, $mounth, $year);

            //Проверяем пользователя на возраст
            if(!checkdate($mounth,$day,$year)){
                $this->error= "Это был не такой длинный месяц!";
            } elseif ($age->y <5) {
                $this->error = 'Too young!';
            } elseif ($age->y >150) {
                $this->error= "Too old!";
            } elseif (empty($this->login) || empty($password)){
                $this->error = 'Пожалуйста, заполните все поля!';
            } else {
                if($mPost->signUp($this->login, $password, $day, $mounth, $year)) {
                    $_SESSION['login'] = $this->login;
                    header('Location: index.php');
                    exit;
                } else {
                    $this->error = "Пользователь с ником {$this->login} уже зарегистрирован!";
                }
            }
            
        } elseif(!empty($_POST['signIn'])) {
            $this->template = 'signin';
            $this->login = trim($mPost->clearStr($_POST['login']));
            $password = $_POST['password'];

            if ($mPost->signIn($this->login, $password)){
                $_SESSION['login'] = $this->login;
                header('Location: index.php');
                exit;
            } else {
                $this->error = "Неверно набран логин или паоль!";
            }

        } elseif (!empty($_POST['count'])) {
            $mPost->countPlus($_SESSION['login']);
            header('Location: index.php');
            exit;

        } elseif (!empty($_POST['logOut'])) {
            session_destroy();
            header('Location: index.php');
            exit;
        }
    }

    protected function OnOutput()
    {

        $vars = array('error' => $this->error, 'login' => $this->login);
        $this->content = $this->Template("application/views/{$this->template}.php", $vars);
        parent::OnOutput();
    }
}