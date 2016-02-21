Usage
==

1. Init your class and pass in the dependency container: $my_class = new Some_Class( new ZM_Dependency_Container( null ) );
1. In your `__construct()` pass in the instance: `public function __construct( ZM_Dependency_Container $di )`
1. Within your `__construct()` call the needed class: `$this->_other_class = $di->get_instance( 'other_class', 'Other_Class', null );`

Full example:

```
Class Lamp {
    public function __construct( ZM_Dependency_Container $di ){
        $this->_switch = $di->get_instance( 'switch', 'Switch_Class', null );
    }


    public function turn_on(){
        return $this->_switch->on();
    }
}
$lamp_obj = new Lamp( new ZM_Dependency_Container( null ) );

Class Flash_Light {

    // stuff

    public function turn_on(){
        return $this->_switch->on();
    }
}
$flash_light_obj = new Flash_Light( new ZM_Dependency_Container( null ) );
```

