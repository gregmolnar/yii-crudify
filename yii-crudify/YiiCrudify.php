<?php
class YiiCrudify extends CAction
{
	public $action;
	public $layout = 'public';
	public $theme = 'base';
	public $redirect_after_create = array('admin');
	public $createFormFields = array();
	public $updateFormFields = array();

	public function getModelClass()
	{	
		$this->ModelClass = $this->getController()->modelClass;
		if(empty($this->modelClass)){
			$this->ModelClass = ucfirst($this->getController()->getId());
		}
		if(!class_exists($this->ModelClass)){
			throw new CException('The model class must be defined for ' . $this->getController()->getId() . '::' . $this->getId() . ' (' . get_called_class($this) . '::modelClass)');
		}
		return $this->ModelClass;	
	}


	public function getView()
	{
        if(empty($this->View)){
            $this->View = 'ext.yii-crudify.'.$this->theme.'.views.'.$this->action;
        }
        return $this->View;
    }

    public function setView($value)
    {
    	$this->View = $value;
    	return $this->View;
    }

    public function setModelClass($value)
    {
    	$this->ModelClass = $value;
    	return $this->ModelClass;
    }

    public function BeforeRender()
    {

    }

    public function AfterRender()
    {
    	
    }

    protected function render($view, $params = array()) 
    {
        $this->BeforeRender(new CEvent($this));
        $this->getController()->render($view, $params);
        $this->AfterRender(new CEvent($this));
    }

	public function index()
	{
		$dataProvider = new CActiveDataProvider($this->modelClass);
		$this->render($this->View, array('dataProvider' => $dataProvider));
	}

	public function create()
	{
		$model = new $this->modelClass;

		if(isset($_POST[$this->modelClass]))
		{
			$model->attributes=$_POST[$this->modelClass];
			if($model->save())
				$this->redirect($this->redirect_after_create);
		}

		$this->render($this->View, array('model'=>$model ));	
	}

	public function view()
	{
		
	}

	public function delete()
	{
		
	}

	public function admin()
	{
		
	}

	public function run()
	{
		return $this->{$this->action}();
	}
}