yii-crudify
===========

Example of usage:
```php
<?php

class DummyController extends Controller
{
	public $modelClass = 'Dummy';
	
	public function actions()
	{
		return array(
			'index' => array(
				'class' => 'ext.yii-crudify.YiiCrudify',
				'action' => 'index'
			),
	  //.....
		);
	}
```
