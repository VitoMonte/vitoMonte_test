<? 

abstract class C_Base 
{
	protected $title;
    protected $content;

	public function __construct(){}
	public function __destruct(){}

    /**
     * Полная обработка HTTP запроса.
     */
    public function Request()
	{
		$this->OnInput();
		$this->OnOutput();
	}

    /**
     * Виртуальный обработчик запроса.
     */
    protected function OnInput()
    {
        $this->title = 'Тестовое задание';
        $this->content = '';
    }

    /**
     * Виртуальный генератор HTML.
     */
    protected function OnOutput()
    {
        $vars = array('title' => $this->title, 'content' => $this->content);
        $page = $this->Template('application/views/main.php', $vars);
        echo $page;
    }

    /**
     * Генерация HTML шаблона в строку.
     */
    protected function Template($fileName, $vars = [])
    {
        // Установка переменных для шаблона.
        foreach ($vars as $k => $v)
        {
            $$k = $v;
        }


        // Генерация HTML в строку.
        ob_start();
        include $fileName;
        return ob_get_clean();
    }
}